<?php

class Home extends Controller
{
    public function index(){

        $data['var'] = "Hi";

        $this->view('home',$data);
    }
}