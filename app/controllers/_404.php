<?php

class _404 extends Controller
{
    public function index(){

        $data['var'] = "Hi";

        $this->view('_404',$data);
    }
}