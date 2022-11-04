<?php

class Home extends Controller
{
    public function index(){
        $db = new Database();
        $db->create_tables();

        $this->view('home');
    }
}