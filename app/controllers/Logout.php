<?php

class Logout extends Controller
{

    public function index(){

        if(isset($_SESSION['cart'])){
            foreach ($_SESSION['cart'] as $key => $value){
                $order_item = new Order_Items();
                $inventory = new Product_Inventory();
                $cart = new Carts();
                $cart->updateTotalAmountToDecrease($value['CartID'],$value['Quantity'] * $value['Cost']);
                $inventory->updateQuantityToIncrease($value['ProductID'],$value['Quantity']);
                $order_item->removeOrderItem($value['OrderID'],$value['ProductID']);
                unset($_SESSION['cart'][$key]);
            }
        }

        Auth::logout();

        $this->redirect('/');
    }
}