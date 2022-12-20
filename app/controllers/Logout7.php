<?php

class Logout7 extends Controller
{
    public function index(){
        Auth::logout();

        $this->redirect('/');
    }
}