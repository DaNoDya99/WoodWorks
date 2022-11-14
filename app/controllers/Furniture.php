<?php

class Furniture extends Controller
{
    public function index(){

        if(!Auth::logged_in())
        {
            $this->redirect('login1');
        }

    }

    public function view_product($id = null){

        if(!Auth::logged_in())
        {
            $this->redirect('login1');
        }

        $furniture = new Furnitures();
        $data['row'] = $furniture->viewFurniture($id);


        $this->view("reg_customer/product", $data);
    }
}