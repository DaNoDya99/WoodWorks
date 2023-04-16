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
            $this->redirect('login1');
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

    public function increaseQuantity($cartID,$orderID,$productID,$quantity,$cost)
    {
        echo json_encode($cartID);


        if(!Auth::logged_in())
        {
            $this->redirect('login1');
        }

        $data = [];

        foreach ($_SESSION['cart'] as $key => $value){
            if($value['ProductID'] == $productID){
                $data['OrderID'] = $value['OrderID'];
                $data['ProductID'] = $value['ProductID'];
                $data['Quantity'] = $value['Quantity'] + 1;
                $data['OrderDate'] = $value['OrderDate'];
                $data['CustomerID'] = $value['CustomerID'];
                $data['Cost'] = $value['Cost'];
                $data['CartID'] = $value['CartID'];
                unset($_SESSION['cart'][$key]);
                $_SESSION['cart'][] = $data;
            }
        }

        $cart = new Carts();
        $order_item = new Order_Items();
        $inventory = new Product_Inventory();
        $inventory->updateQuantityToDecrease($productID,1);
        $order_item->updateQuantity($orderID,$productID,(int)$quantity + 1);
        $cart->updateTotalAmountToIncrease($cartID,$cost);

        $this->redirect('cart');
    }

    public function decreaseQuantity($cartID,$orderID,$productID,$quantity,$cost)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login1');
        }

        $cart = new Carts();
        $order_item = new Order_Items();
        $inventory = new Product_Inventory();
        if($quantity > 1){

            $data = [];

            foreach ($_SESSION['cart'] as $key => $value){

                if($value['ProductID'] == $productID){
                    $data['OrderID'] = $value['OrderID'];
                    $data['ProductID'] = $value['ProductID'];
                    $data['Quantity'] = $value['Quantity'] - 1;
                    $data['OrderDate'] = $value['OrderDate'];
                    $data['CustomerID'] = $value['CustomerID'];
                    $data['Cost'] = $value['Cost'];
                    $data['CartID'] = $value['CartID'];
                    unset($_SESSION['cart'][$key]);
                    $_SESSION['cart'][] = $data;
                }

            }

            $inventory->updateQuantityToIncrease($productID,1);
            $order_item->updateQuantity($orderID,$productID,(int)$quantity-1);
            $cart->updateTotalAmountToDecrease($cartID,$cost);
        }


        $this->redirect('cart');
    }
}