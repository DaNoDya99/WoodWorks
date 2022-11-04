<?php
require "../app/models/Employee.php";

class Login1 extends Controller
{
    public function index(){

        $employee = new Employee();
        $data['error'] = [];

        $result = $employee->where('email','viharsha@yahoo.com');
        show($result[0]->Password);

        $this->view('login1',$data);
    }
}