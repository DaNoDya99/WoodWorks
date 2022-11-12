<?php
require "../app/models/Employee.php";

class Home extends Controller
{
    public function index(){

        $db = new Database();
        $db->create_tables();
//        $employee = new Employee();//object for the emplyee class
//
//        $post = [
//            'EmployeeID' => 'A002',
//            'Firstname' => 'Gagana',
//            'Lastname' => 'Samarasekara',
//            'Email' => 'gagana@gmail.com',
//            'Password' => password_hash("Admin123",PASSWORD_DEFAULT),//PASSWORD_DEFAULT is hashing algo
//            'Role' => 'Administrator',
//            'Contactno' => '0704522654',
//            'Slug' => 'gagana-samarasekara'
//        ];
//
//        $employee->insert($post);

        $this->view('home');
    }
}