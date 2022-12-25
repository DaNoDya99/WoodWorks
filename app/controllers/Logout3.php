<?php

class Logout3 extends Controller
{
    public function index(){
        Auth::logout();

        $this->redirect('/');
    }
}