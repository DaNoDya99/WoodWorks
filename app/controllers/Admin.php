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

        $this->view('admin');
    }
}