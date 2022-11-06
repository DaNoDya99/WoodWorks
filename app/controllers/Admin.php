<?php
require "../app/models/Auth.php";

class Admin extends Controller
{
    public function index()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login1');
        }

        $data['title'] = "DASHBOARD";

        $this->view('admin/dashboard',$data);
    }

    public function profile()
    {
        $data['title'] = "PROFILE";

        $this->view('admin/profile',$data);
    }
}