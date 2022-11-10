<?php
require "../app/models/Employee.php";

class Home extends Controller
{
    public function index(){
//        $employee = new Employee();//object for the emplyee class
//
//        $post = [
//            'EmployeeID' => 'D002',
//            'Firstname' => 'Buddhi',
//            'Lastname' => 'Praboda',
//            'Email' => 'buddhi@gmail.com',
//            'Password' => password_hash('Designer2@123',PASSWORD_DEFAULT),//PASSWORD_DEFAULT is hashing algo
//            'Role' => 'Designer',
//            'Contactno' => '0774522654',
//            'Slug' => 'buddhi-praboda'
//        ];
//
//        $employee->insert($post);

        $this->view('home');
    }
}