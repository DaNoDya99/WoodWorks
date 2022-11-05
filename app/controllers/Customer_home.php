<?php
require "../app/models/Auth.php";

class Customer_home extends Controller
{
    public function index()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login1');
        }

        $this->view('customer_home');
    }
}