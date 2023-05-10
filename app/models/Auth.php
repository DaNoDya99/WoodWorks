<?php

class Auth
{
    public static function authenticate($row)
    {
        if (is_object($row)) {
            $_SESSION['USER_DATA'] = $row;
        }
    }

    public static function logout()
    {
        if (!empty($_SESSION['USER_DATA'])) {
            session_destroy();
        }
    }

    public static function logged_in()
    {
        if (!empty($_SESSION['USER_DATA'])) {
            return true;
        }

        return false;
    }

    public static function email_verified()
    {
        //check if status in customer table is 1

        if (!empty($_SESSION['USER_DATA']->status)) {
            if ($_SESSION['USER_DATA']->status == 1) {
                return true;
            }
        }

        return false;
    }

    public static function checkPerson($role)
    {
        if (strtolower($_SESSION['USER_DATA']->Role) == $role) {
            return true;
        }
        return false;
    }

    public static function __callStatic($name, $arguments)
    {
        $key = str_replace("get", "", $name);
        //print_r($key);

        if (!empty($_SESSION['USER_DATA']->$key)) {
            return $_SESSION['USER_DATA']->$key;
        }

        return '';
    }

    public static function cartTimer($timer): void
    {
        if(isset($_SESSION['cart'])){
            foreach ($_SESSION['cart'] as $key => $value){
                if(time() - $value['OrderDate'] > $timer){
                    $order_item = new Order_Items();
                    $inventory = new Product_Inventory();
                    $cart = new Carts();

                    $inventory->updateQuantityToIncrease($value['ProductID'],$value['Quantity']);
                    $order_item->removeOrderItem($value['OrderID'],$value['ProductID']);
                    $cart->updateTotalAmountToDecrease($value['CartID'],$value['Quantity'] * $value['Cost']);
                    unset($_SESSION['cart'][$key]);
                }
            }
        }
    }

    public static function deleteIncompleteOrders($id): void
    {
        $orders = new Orders();
        $orderItems = new Order_Items();
        if(!empty($orderID = $orders->checkIsPreparing($id))){
            if(empty($orderItems->getOrderItems($orderID[0]->OrderID)))
            {
                $orders->removeIncompletedOrders($id);
            }
        }
    }

}
