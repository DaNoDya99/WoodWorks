<?php

class Cart extends Controller
{
    private function getUser()
    {
        $customer = new Customer();
        $id = Auth::getCustomerID();
        return $customer->where('CustomerID',$id);
    }

    public function index()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $data['row'] = $row = $this->getUser();
        $cart = new Carts();
        $cart_id = $cart->getCart($row[0]->CustomerID)[0]->CartID;
        $order_item = new Order_Items();

        if(empty($cart->getCart($row[0]->CustomerID)))
        {
            $cart->setCart($row[0]->CustomerID);
        }

        $data['cart'] = $order_item->getCustomerCartDetails($cart_id);

        if(empty($data['cart']))
        {
            $data['error'] = "The cart is empty.";
        }

        $this->view('reg_customer/cart',$data);
    }

    public function increaseQuantity($cartID,$productID,$quantity,$cost)
    {
        $cart = new Carts();
        $order_item = new Order_Items();
        $order_item->updateQuantity($cartID,$productID,(int)$quantity + 1);
        $cart->updateTotalAmountToIncrease($cartID,$cost);

        $this->redirect('cart');
    }

    public function decreaseQuantity($cartID,$productID,$quantity,$cost)
    {
        $cart = new Carts();
        $order_item = new Order_Items();
        if($quantity > 1){
            $order_item->updateQuantity($cartID,$productID,(int)$quantity-1);
            $cart->updateTotalAmountToDecrease($cartID,$cost);
        }


        $this->redirect('cart');
    }
}