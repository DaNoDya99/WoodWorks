<?php

class Admin extends Controller
{
    protected $message = '';

    public function index()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $id = $id ?? Auth::getEmployeeID();
        $employee = new Employees();
        $furniture = new Furnitures();
        $supplier = new Suppliers();

        $data['furniture'] = $rows = $furniture->getOutOfStockFurniture();
        foreach ($rows as $row)
        {
            $row->Image = $furniture->getDisplayImage($row->ProductID)[0]->Image;
        }

        $data['row'] = $employee->where('EmployeeID',$id);
        $data['title'] = "DASHBOARD";
        $data['emp_cnt'] = $employee->getEmployeeCount();
        $data['sup_cnt'] = $supplier->getSupplierCount();
        $data['fur_cnt'] = $furniture->getFurnitureCount();
        $data['ots_fur_cnt'] = $furniture->getOTSCount();


        $this->view('admin/dashboard',$data);
    }

    public function profile($id = null)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $id = $id ?? Auth::getEmployeeID();
        $employee = new Employees();
        $data['row'] = $row = $employee->where('EmployeeID',$id);


        if($_SERVER['REQUEST_METHOD'] == 'POST' && $row)
        {
            $folder = "uploads/images/";
            if(!file_exists($folder)){
                mkdir($folder,0777,true);
                file_put_contents($folder."index.php","<?php Access Denied.");
                file_put_contents("uploads/index.php","<?php Access Denied.");
            }

            if($employee->edit_validate($_POST,$id)){
                $allowedFileType = ['image/jpeg','image/png'];


                if(!empty($_FILES['Image']['name']))
                {
                    if($_FILES['Image']['error'] == 0)
                    {
                        if(in_array($_FILES['Image']['type'],$allowedFileType))
                        {
                            $destination = $folder.time().$_FILES['Image']['name'];
                            move_uploaded_file($_FILES['Image']['tmp_name'],$destination);

//                            resize_image($destination);
                            $_POST['Image'] = $destination;
                            if(file_exists($row[0]->Image))
                            {
                                unlink($row[0]->Image);
                            }
                        }else{
                            $employee->errors['image'] = "This file type is not allowed.";
                        }
                    }else{
                        $employee->errors['image'] = "Could not upload image.";
                    }
                }

                $_POST['EmployeeID'] = $id;
                $employee->update($id,$_POST);
                $this->redirect('admin/profile/'.$id);
            }
        }

        $data['title'] = "PROFILE";
        $data['errors'] = $employee->errors;

        $this->view('admin/profile',$data);
    }

    public function employees($id=null)
    {
        if(!Auth::logged_in()){
            $this->redirect('login');
        }

        $employee = new Employees();
        $id = $id ?? Auth::getEmployeeID();
        $data['row'] = $employee->where('EmployeeID',$id);
        $rows = $employee->findAll();
        $data['rows'] = array();

        for($i = 0;$i < count($rows); $i++)
        {
            if($rows[$i]->Role != "Administrator")
            {
                $data['rows'][] = $rows[$i];
            }
        }

        foreach ($rows as $row)
        {
            $row->Date = explode(' ',$row->Date)[0];
        }

        $data['title'] = "EMPLOYEES";

        $this->view('admin/employees',$data);
    }

    public function add_employee($id=null)
    {
        if(!Auth::logged_in()){
            $this->redirect('login');
        }

        $folder = "uploads/images/";
        $id = $id ?? Auth::getEmployeeID();
        $employee = new Employees();
        $data['row'] = $row = $employee->where('EmployeeID',$id);

        if($_SERVER['REQUEST_METHOD'] == 'POST' && $row){

            if($employee->validate($_POST)) {
                $destination = $folder."user.png";

                copy(ROOT."assets/images/admin/user.png",$destination);

                if(!file_exists(ROOT."/assets/images/admin/user.png"))
                {
                    if(copy(ROOT."/assets/images/admin/user.png",$destination))
                    {
                        $this->message = "Image cannot be copied.";
                    }else{
                        $this->message = "Image copied successfully.";
                    }
                }

                $_POST['Image'] = $destination;

                $employee->insert($_POST);
                $this->redirect('admin/employees');
            }
        }


        $data['message'] = $this->message;
        $data['errors'] = $employee->errors;
        $data['title'] = "ADD EMPLOYEE";

        $this->view('admin/add_employee',$data);
    }

    public function inventory($id = null)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $id = $id ?? Auth::getEmployeeID();
        $employee = new Employees();
        $furniture = new Furnitures();
        $categories = new Categories();

        $data['categories'] = $categories->getCategories();
        $data['row'] = $employee->where('EmployeeID', $id);
        $data['title'] = "INVENTORY";

        $data['furniture'] = $rows = $furniture->getInventory();

        foreach ($rows as $row)
        {
            $row->Image = $furniture->getDisplayImage($row->ProductID)[0]->Image;
        }

        $this->view('admin/inventory',$data);
    }

    public function add_furniture()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $id = $id ?? Auth::getEmployeeID();
        $employee = new Employees();
        $category = new Categories();
        $furniture = new Furnitures();
        $sub_category = new Sub_Categories();

        $data['row'] = $employee->where('EmployeeID', $id);
        $data['title'] = "ADD FURNITURE";
        $data['categories'] = $category->getCategories();
        $data['sub_categories'] = $sub_category->getSubcategoryName();

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            if ($furniture->validate($_POST)) {

                $furniture->insert($_POST);

                $folder = "uploads/images/";
                $allowedFileType = ['image/jpeg', 'image/png'];
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                    file_put_contents($folder . "index.php", "<?php Access Denied.");
                    file_put_contents("uploads/index.php", "<?php Access Denied.");
                }
                $images = array();

                if (!empty($_FILES['Images']['name']) && !empty($_FILES['PrimaryImage']['name'])) {

                    if (count(array_unique($_FILES['Images']['error'])) === 1 && end($_FILES['Images']['error']) === 0 && $_FILES['PrimaryImage']['error'] === 0) {

                        $flag = true;

                        foreach ($_FILES['Images']['type'] as $type) {
                            if (!in_array($type, $allowedFileType)) {
                                $flag = false;
                            }
                        }

                        if (!in_array($_FILES['PrimaryImage']['type'], $allowedFileType)) {
                            $flag = false;
                        }

                        if ($flag) {
                            for ($i = 0; $i < 2; $i++) {
                                $destination = $folder . time() . $_FILES['Images']['name'][$i];
                                $images[$i] = $destination;
                                move_uploaded_file($_FILES['Images']['tmp_name'][$i], $destination);
                            }
                            $destination = $folder . time() . 'primary' . $_FILES['PrimaryImage']['name'];
                            $images[2] = $destination;
                            move_uploaded_file($_FILES['PrimaryImage']['tmp_name'], $destination);

                            $furniture->insertImages($_POST['ProductID'], $images);
                        } else{
                            $furniture->errors['Image'] = "File type must be jpeg or png.";
                        }
                    }else{
                        $furniture->errors['Image'] = "Error occurred in images.";
                    }
                }else{
                    $furniture->errors['Image'] = "Select primary and secondary images.";
                }
            }

        }

        $data['errors'] = $furniture->errors;
        $this->view('admin/add_furniture',$data);
    }

    public function suppliers()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $id = $id ?? Auth::getEmployeeID();
        $employee = new Employees();
        $supplier = new Suppliers();

        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            if($supplier->validate($_POST))
            {

            }
        }

        $data['row'] = $employee->where('EmployeeID',$id);
        $data['suppliers'] = $supplier->findAll();
        $data['title'] = "SUPPLIERS";
        $data['errors'] = $supplier->errors;

        $this->view('admin/supplier',$data);
    }

    public function categories(){

        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $id = $id ?? Auth::getEmployeeID();
        $employee = new Employees();


        $data['row'] = $employee->where('EmployeeID',$id);
        $data['title'] = "SUPPLIERS";

        $category = new Categories();
        $sub_category = new Sub_Categories();

        $rows = $category->getCategories();

        foreach ($rows as $row)
        {
            $row->sub_categories = $sub_category->getSubCategoriesByCatID($row->CategoryID);
        }

        $data['categories'] = $rows;

        $this->view('admin/categories',$data);
    }

    public function delivery()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $id = $id ?? Auth::getEmployeeID();
        $employee = new Employees();

        $data['row'] = $employee->where('EmployeeID',$id);
        $data['title'] = "DELIVERY";

        $orders = new Orders();
        $rows = $orders->getNewOrders();

        foreach ($rows as $row)
        {
            $row->Date = explode(" ",$row->Date)[0];
        }

        $data['orders'] = $rows;

        $this->view('admin/delivery',$data);
    }


}