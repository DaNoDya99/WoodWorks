<?php

class Driver_home extends Controller
{
    public function index()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login3');
        }

        $this->view('driver_home');
    }
}
