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
}