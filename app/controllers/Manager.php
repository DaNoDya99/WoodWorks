<?php
require "../app/models/Auth.php";
require "../app/models/Employee.php";

class Manager extends Controller
{
    protected $message = '';

    public function index()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login4');
        }

        $data['title'] = "DASHBOARD";

        $this->view('manager/dashboard',$data);
    }


    public function posts()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login4');
        }

        $data['title']="POSTS";
        $this->view('manager/issues',$data);
    }

}