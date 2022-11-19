<?php
require "../app/models/Auth.php";
require "../app/models/Customer.php";

class Customer_home extends Controller
{
    public function index()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login1');
        }

        $furniture = new Furnitures();
        $customer = new Customer();
        $id = Auth::getCustomerID();
        $data['row'] = $customer->where('CustomerID',$id);
        $data['furnitures'] = $furniture->getNewFurniture(['ProductID','Name','Cost']);

        $this->view('reg_customer/customer_home',$data);
    }

    public function profile($id = null){

        if(!Auth::logged_in()){
            $this->redirect('login1');
        }

        $customer = new Customer();
        $id = Auth::getCustomerID();
        $data['row'] = $row = $customer->where('CustomerID',$id);

        if($_SERVER['REQUEST_METHOD'] == 'POST' && $row)
        {
            $folder = "uploads/images/";
            if(!file_exists($folder)){
                mkdir($folder,0777,true);
                file_put_contents($folder."index.php","<?php Access Denied.");
                file_put_contents("uploads/index.php","<?php Access Denied.");
            }

            if($customer->edit_validate($_POST))
            {
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
                            $customer->errors['image'] = "This file type is not allowed.";
                        }
                    }else{
                        $customer->errors['image'] = "Could not upload image.";
                    }
                }

                $_POST['CustomerID'] = $id;

                $customer->update($id,$_POST);
                $this->redirect('customer_home/profile/'.$id);
            }
        }

        $data['errors'] = $customer->errors;

        $this->view('reg_customer/profile',$data);
    }
}