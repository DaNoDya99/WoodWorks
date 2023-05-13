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
        if(!empty($rows)){
            foreach ($rows as $row)
            {
                $row->Image = $furniture->getDisplayImage($row->ProductID)[0]->Image;
            }
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

//                copy(ROOT."assets/images/admin/user.png",$destination);

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
                echo "success";
                exit();
            }
        }


        $errors = $employee->errors;

        if(empty($errors))
        {
           echo "success";
        }else{
            echo json_encode($errors);
        }

    }

    public function furniture($id = null)
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

        $this->view('admin/furniture',$data);
    }

    public function inventory()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $inventory = new Product_Inventory();
        $data['inventory'] = $inventory->getAllFromInventory();

        $category = new Categories();
        $sub_category = new Sub_Categories();
        $supplier = new Suppliers();

        $data['categories'] = $category->getCategories();
        $data['sub_categories'] = $sub_category->getSubcategoryName();
        $data['suppliers'] = $supplier->getSuppliersWithComanyName();


        $this->view('admin/inventory',$data);
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
        $data = array();

        if(!empty($rows))
        {
            foreach ($rows as $row)
            {
                $row->Date = explode(" ",$row->Date)[0];
            }

            $data['orders'] = $rows;
        }


        $this->view('admin/delivery',$data);
    }

    public function getWeeklySalesOfProducts()
    {
        if(!Auth::logged_in()){
            $this->redirect('login');
        }

        $items = new Order_Items();

        $rows = $items->getSoldProductsLastWeek();

        if(!empty($rows)) {
            echo json_encode($rows);
        }else {
            echo json_encode("error");
        }
    }

    public function getProductsReachedReorderLevel()
    {
        if(!Auth::logged_in()){
            $this->redirect('login');
        }

        $inventory = new Product_Inventory();
        $rows = $inventory->getItemsReachedReorderLevel();

        if(!empty($rows)) {
            echo json_encode($rows);
        }else {
            echo json_encode("error");
        }
    }

    public function getOrderStatus()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $orders = new Orders();
        $rows = $orders->pieGraph();

        if(!empty($rows)) {
            echo json_encode($rows);
        }else {
            echo json_encode("error");
        }
    }

    public function getTop5Products()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $reviews = new Reviews();
        $rows = $reviews->getTop5RatedProducts();

        if(!empty($rows)) {
            echo json_encode($rows);
        }else {
            echo json_encode("error");
        }
    }

}