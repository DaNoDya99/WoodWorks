<?php
require "../app/models/Customer.php";

class Signup extends Controller
{
    protected $message = '';

    public function index(){

        $customer = new Customer();

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $folder = "uploads/images/";

            if($customer->validate($_POST))
            {
                $destination = $folder."user.png";

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
                $customer->insert($_POST);
                $this->redirect('login1');
            }
        }

        $data['errors'] = $customer->errors;

        $this->view('signup',$data);
    }
}