<?php

class Login3 extends Controller
{
    public function index(){

        $driver = new Employee();
        $designer = new Employee();

        $data['error'] = [];
        $data['title'] = "Login"; // ?
        //show($driver);

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $result_dri = $driver->where('email',$_POST['Email']);
            $result_des = $designer->where('email',$_POST['Email']);

            if($result_dri)
            {
                if(password_verify($_POST['Password'],$result_dri[0]->Password))
                {

                    if(strtolower($result_dri[0]->Role) == 'driver'){
                        Auth::authenticate($result_dri[0]);
                        $this->redirect('driver_home');
                    }
                }
            }
            else if ($result_des){
                if(password_verify($_POST['Password'],$result_des[0]->Password))
                {
                    Auth::authenticate($result_des[0]);
                    $this->redirect('designer_home');
                }
            }

            $data['errors']['email'] = "Wrong email or password";
        }


        $this->view('login3',$data);
    }
}