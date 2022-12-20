<?php

class Logout2 extends Controller
{
    public function index(){
        Auth::logout();

        $this->redirect('/');
    }
}