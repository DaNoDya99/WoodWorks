<?php
require "../app/models/Customer.php";

class Signup extends Controller
{
    public function index(){

        $data['errors'] = [];
        $customer = new Customer();
//        $driver = new Employee();

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if($customer->validate($_POST))
            {
                $customer->insert($_POST);
            }

        }

//        $post = [
//            'EmployeeID' => 'M001',
//            'Firstname' => 'Balakrishnan',
//            'Lastname'	=> 'vishnugan',
//            'Email' => 'vishnuganb@gmail.com',
//            'Password' => password_hash('123',PASSWORD_DEFAULT),
//            'Role'	=> 'Driver',
//            'Contactno'=> '0760866820',
//        ];

        //$driver ->insert($post);

        //$data['errors'] = $driver->errors;

        $data['errors'] = $customer->errors;

        $this->view('signup',$data);
    }
}