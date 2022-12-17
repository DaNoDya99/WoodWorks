<?php

class Logout4 extends Controller
{
    public function index(){
        Auth::logout();

        $this->redirect('/');
    }
}