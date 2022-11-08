<?php

class Designer_home extends Controller
{
    public function index()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login3');
        }

        $this->view('designer_home');
    }
}
