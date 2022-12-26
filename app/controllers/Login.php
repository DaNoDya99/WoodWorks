<?php

class Login extends Controller
{
    public function index(){

        $employee = new Employees();
        $customer = new Customer();
        $supplier = new Suppliers();

        $data['error'] = [];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result_emp = $employee->where('Email',$_POST['Email']);
            $result_cus = $customer->where('Email',$_POST['Email']);
            $result_sup =  $supplier->where('Email',$_POST['Email']);

            if($result_emp && $result_cus){
                if(password_verify($_POST['Password'],$result_emp[0]->Password))
                {
                    if(strtolower($result_emp[0]->Role) == 'administrator'){
                        Auth::authenticate($result_emp[0]);
                        $this->redirect('admin');
                    }
                    if(strtolower($result_emp[0]->Role) == 'manager'){
                        Auth::authenticate($result_emp[0]);
                        $this->redirect('manager');
                    }
                    if(strtolower($result_emp[0]->Role) == 'driver'){
                        Auth::authenticate($result_emp[0]);
                        $this->redirect('driver_home');
                    }
                    if(strtolower($result_emp[0]->Role) == 'designer'){
                        Auth::authenticate($result_emp[0]);
                        $this->redirect('designer');
                    }
                     if(strtolower($result_emp[0]->Role) == 'cashier'){
                        Auth::authenticate($result_emp[0]);
                        $this->redirect('cashier');
                    }

                }elseif ($result_cus) {
                    if (password_verify($_POST['Password'], $result_cus[0]->Password)) {
                        Auth::authenticate($result_cus[0]);
                        $this->redirect('/customer_home');
                    }
                }
            }
            elseif($result_sup){
                if(password_verify($_POST['Password'],$result_sup[0]->Password))
                {
                    Auth::authenticate($result_sup[0]);
                    $this->redirect('supplier');
                }
            }
            elseif($result_emp)
            {
                if(password_verify($_POST['Password'],$result_emp[0]->Password))
                {
                    if(strtolower($result_emp[0]->Role) == 'administrator'){
                        Auth::authenticate($result_emp[0]);
                        $this->redirect('admin');
                    }
                    if(strtolower($result_emp[0]->Role) == 'manager'){
                        Auth::authenticate($result_emp[0]);
                        $this->redirect('manager');
                    }
                    if(strtolower($result_emp[0]->Role) == 'driver'){
                        Auth::authenticate($result_emp[0]);
                        $this->redirect('driver_home');
                    }
                    if(strtolower($result_emp[0]->Role) == 'designer'){
                        Auth::authenticate($result_emp[0]);
                        $this->redirect('designer');
                    }
                    if(strtolower($result_emp[0]->Role) == 'cashier'){
                        Auth::authenticate($result_emp[0]);
                        $this->redirect('cashier');
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

        $this->view('login',$data);
    }
}