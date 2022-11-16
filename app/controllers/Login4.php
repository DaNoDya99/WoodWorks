<?php
require "../app/models/Employee.php";
require "../app/models/Auth.php";


class Login4 extends Controller
{
    public function index(){

        $employee = new Employee();
        
        $data['error'] = [];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result_emp = $employee->where('email',$_POST['Email']);
            

            
            if($result_emp)
            {
                if(password_verify($_POST['Password'],$result_emp[0]->Password))
                {
                    if(strtolower($result_emp[0]->Role) == 'manager'){
                        Auth::authenticate($result_emp[0]);
                        $this->redirect('manager');
                    }
                }
            } 

            $data['errors']['email'] = "Wrong email or password";
        }


        $this->view('login4',$data);
    }
}