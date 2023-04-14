<?php

class Logout extends Controller
{

    public function index(){

        if(isset($_SESSION['cart'])){
            foreach ($_SESSION['cart'] as $key => $value){
                $order_item = new Order_Items();
                $order_item->removeOrderItem($value['OrderID'],$value['ProductID']);
                unset($_SESSION['cart'][$key]);
            }
        }

        Auth::logout();

        $this->redirect('/');
    }
}