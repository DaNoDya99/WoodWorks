<?php
require "../app/models/Auth.php";
require "../app/models/Employee.php";

class Admin extends Controller
{
    protected $message = '';

    public function index()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login1');
        }

        $data['title'] = "DASHBOARD";

        $this->view('admin/dashboard',$data);
    }

    public function profile($id = null)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login1');
        }

        $id = $id ?? Auth::getEmployeeID();
        $employee = new Employee();
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
            $this->redirect('login1');
        }

        $employee = new Employee();

        $data['rows'] = $employee->findAll();
        $data['no_of_emp'] = count($data['rows']);
        $data['title'] = "EMPLOYEES";

        $this->view('admin/employees',$data);
    }

    public function add_employee($id=null)
    {
        if(!Auth::logged_in()){
            $this->redirect('login1');
        }

        $folder = "uploads/images/";
        $id = $id ?? Auth::getEmployeeID();
        $employee = new Employee();
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
        if(!Auth::logged_in()){
            $this->redirect('login1');
        }


        $data['title'] = "INVENTORY";

        $this->view('admin/inventory',$data);
    }

}