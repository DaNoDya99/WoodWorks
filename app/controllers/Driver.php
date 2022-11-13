<?php

class Driver extends Controller
{
    public function index()
    {

//        if(Auth::logged_in() && Auth::checkPerson('driver'))
//        {
//            $data['title'] = "DASHBOARD";
//            $this->view('driver/profile',$data);
//            die;
//
//        }
//        $this->redirect('login3');
        if(!Auth::logged_in())
        {
            $this->redirect('login3');
        }

        $data['title'] = "DASHBOARD";

        $this->view('driver/dashboard',$data);

    }
    public function profile($id = null)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login3');
        }

        $id = $id ?? Auth::getEmployeeID();
        $employee = new Employee();
        $data['row'] = $row = $employee->where('EmployeeID',$id);
//        show($id);

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
                $this->redirect('driver/profile/'.$id);
            }
        }

        $data['title'] = "PROFILE";
        $data['errors'] = $employee->errors;

        $this->view('driver/profile',$data);
    }
    public function order($id = null)
    {
        if(!Auth::logged_in()) {
            $this->redirect('login3');
        }
        $id = $id ?? Auth::getCustomerID();
        $customer = new Customer();
        $data['row'] = $row = $customer->where('CustomerID',$id);
//        show($_SESSION['USER_DATA']);
        if(!empty($data['row'] ))
        {
            $i=0;
            while($r = $row->fetch_assoc())
            {

                $i++;

                echo "<tr>
                             <td>{$i}</td>
                             <td>{$r->CustomerID}</td>
                      </tr>";

            }
        }
        else
        {
            $customer->errors['order'] = "No orders Found.";
        }

        $data['errors'] = $customer->errors;
        $data['title'] = "ORDERS";
        $this->view('driver/order',$data);
    }
}
