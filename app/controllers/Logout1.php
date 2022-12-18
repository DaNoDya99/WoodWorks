<?php

class Logout1 extends Controller
{
    public function index(){
        Auth::logout();

        $this->redirect('/');
    }
}