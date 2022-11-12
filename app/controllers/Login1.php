<?php
require "../app/models/Employee.php";
require "../app/models/Auth.php";
require "../app/models/Customer.php";

class Login1 extends Controller
{
    public function index(){

        $employee = new Employee();
        $customer = new Customer();

        $data['error'] = [];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result_emp = $employee->where('email',$_POST['Email']);
            $result_cus = $customer->where('email',$_POST['Email']);

            if($result_emp)
            {
                if(password_verify($_POST['Password'],$result_emp[0]->Password))
                {
                    if(strtolower($result_emp[0]->Role) == 'administrator'){
                        Auth::authenticate($result_emp[0]);
                        $this->redirect('admin');
                    }
                }
            } elseif ($result_cus){
                if(password_verify($_POST['Password'],$result_cus[0]->Password))
                {
                    Auth::authenticate($result_cus[0]);
                    $this->redirect('/customer_home');
                }
            }

            $data['errors']['email'] = "Wrong email or password";
        }


        $this->view('login1',$data);
    }
}