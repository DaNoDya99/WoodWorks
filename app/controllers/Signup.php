<?php
require "../app/models/Customer.php";

class Signup extends Controller
{
    public function index(){

        $data['errors'] = [];
        $customer = new Customer();
//        $designer = new Employee();

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if($customer->validate($_POST))
            {
                $customer->insert($_POST);
            }

        }

//        $post = [
//            'EmployeeID' => 'M002',
//            'Firstname' => 'Balakrishnan',
//            'Lastname'	=> 'pirashanthy',
//            'Email' => 'pirashanthy@gmail.com',
//            'Password' => password_hash('123',PASSWORD_DEFAULT),
//            'Role'	=> 'Designer',
//            'Contactno'=> '0771234567',
//        ];

//        $designer ->insert($post);

//        $data['errors'] = $designer->errors;

        $data['errors'] = $customer->errors;

        $this->view('signup',$data);
    }
}