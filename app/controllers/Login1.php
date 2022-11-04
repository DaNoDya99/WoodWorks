<?php

class Login1 extends Controller
{
    public function index(){

        $data['error'] = ["Username or password incorrect"];

        $this->view('login1',$data);
    }
}