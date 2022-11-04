<?php
require "../app/models/Employee.php";
require "../app/models/Auth.php";

class Login1 extends Controller
{
    public function index(){

        $employee = new Employee();
        $data['error'] = [];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = $employee->where('email',$_POST['email']);

            if($result)
            {
                if(password_verify($_POST['password'],$result[0]->Password))
                {
                    if(strtolower($result[0]->Role) == 'admin'){
                        Auth::authenticate($result[0]);
                        $this->redirect('admin');
                    }
                }
            }

            $data['errors']['email'] = "Wrong email or password";
        }


        $this->view('login1',$data);
    }
}