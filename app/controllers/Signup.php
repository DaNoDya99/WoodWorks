<?php
require "../app/models/Customer.php";

class Signup extends Controller
{
    public function index(){

        $customer = new Customer();

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if($customer->validate($_POST))
            {
                $customer->insert($_POST);
            }
        }

        $data['errors'] = $customer->errors;

        $this->view('signup',$data);
    }
}