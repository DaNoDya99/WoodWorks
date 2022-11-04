<?php
require "../app/models/Employee.php";

class Signup extends Controller
{
    public function index(){

        $employee = new Employee();

//        $post = [
//            'EmployeeId' => 'M001',
//            'Firstname' => 'Viharsha',
//            'Lastname' => 'Jayathilake',
//            'Email' => 'viharsha@yahoo.com',
//            'Password' => password_hash('Manager@123',PASSWORD_DEFAULT),
//            'Role' => 'Manager',
//            'Contactno' => '0771542654'
//        ];
//
//        $employee->insert($post);

        $this->view('signup');
    }
}