<?php

class Designer_home extends Controller
{
    public function index()
    {
        if(Auth::logged_in() && Auth::checkPerson('designer') )
        {
            $this->view('designer_home');
            die;
        }
        $this->redirect('login3');

    }
}
