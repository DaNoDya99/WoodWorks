<?php

class Cart extends Controller
{
    private function getUser()
    {
        $customer = new Customer();
        $id = Auth::getCustomerID();
        return $customer->where('CustomerID', $id);
    }

    public function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login1');
        }

        $data['row'] = $row = $this->getUser();
        $cart = new Carts();
        $cart_id = $cart->getCart($row[0]->CustomerID)[0]->CartID;
        $order_item = new Order_Items();

        if (empty($cart->getCart($row[0]->CustomerID))) {
            $cart->setCart($row[0]->CustomerID);
        }

        $data['cart'] = $order_item->getCustomerCartDetails($cart_id);

        if (empty($data['cart'])) {
            $data['error'] = "The cart is empty.";
        }

        $this->view('reg_customer/cart', $data);
    }

    public function increaseQuantity($cartID, $orderID, $productID, $quantity, $cost)
    {


        if (!Auth::logged_in()) {
            $this->redirect('login1');
        }

        $cart = new Carts();
        $order_item = new Order_Items();
        $inventory = new Product_Inventory();

        $item_quantity = $inventory->getProductQuantity($productID)[0]->Quantity;

        if ($item_quantity > 0) {
            $data = [];

            foreach ($_SESSION['cart'] as $key => $value) {
                if ($value['ProductID'] == $productID) {
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


            $inventory->updateQuantityToDecrease($productID, 1);
            $order_item->updateQuantity($orderID, $productID, (int)$quantity + 1);
            $cart->updateTotalAmountToIncrease($cartID, $cost);

//            $this->redirect('cart');

        } else {

            echo "<div class='cat-success cat-deletion'>
                    <h2>The quantity is not available.</h2>
                </div>";

        }
    }

    public function decreaseQuantity($cartID, $orderID, $productID, $quantity, $cost)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login1');
        }

        $cart = new Carts();
        $order_item = new Order_Items();
        $inventory = new Product_Inventory();
        if ($quantity > 1) {

            $data = [];

            foreach ($_SESSION['cart'] as $key => $value) {

                if ($value['ProductID'] == $productID) {
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

            $inventory->updateQuantityToIncrease($productID, 1);
            $order_item->updateQuantity($orderID, $productID, (int)$quantity - 1);
            $cart->updateTotalAmountToDecrease($cartID, $cost);

        } else {
            echo "<div class='cat-success cat-deletion'>
                    <h2>Minimum quantity reached.</h2>
                </div>";
        }
    }

    public function addToCart($id, $cost)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $order = new Orders();
        $advertisement = new Advertisements();
        $cart = new Carts();
        $order_items = new Order_Items();
        $cus_id = Auth::getCustomerID();

        $ad = $advertisement->getRefurnishedFurnityreById($id)[0];

        if ($ad->Quantity < 1) {
            echo "<div class='cat-success cat-deletion'>
                    <h2>Product is out of stock.</h2>
                </div>";
            return;
        }

        if (empty($cart->getCart($cus_id))) {
            $cart->setCart($cus_id);
        }

        if (empty($order->checkIsPreparing($cus_id))) {
            $orderID = $order->setOrder($cus_id);
        } else {
            $orderID = $order->checkIsPreparing($cus_id)[0]->OrderID;
        }

        $image = $advertisement->getDisplayImage($id)[0]->Image;

        if (empty($order_items->getOrderItem($orderID, $id))) {
            $data = [
                'ProductID' => $id,
                'Name' => $ad->Product_name,
                'Quantity' => 1,
                'Cost' => $cost,
                'OrderID' => $orderID,
                'CartID' => $cart->getCart($cus_id)[0]->CartID,
                'Image' => $image
            ];

            $advertisement->updateQuantityToDecrese($id, 1);

            $order_items->insert($data);

            $details = [
                'OrderID' => $orderID,
                'ProductID' => $id,
                'Quantity' => 1,
                'OrderDate' => date("Y-m-d H:i:s"),
                'CustomerID' => $cus_id,
                'Cost' => $cost,
                'CartID' => $cart->getCart($cus_id)[0]->CartID
            ];

            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'][] = $data;
            }

            $_SESSION['cart'][] = $details;

            echo "<div class='cat-success'>
                        <h2>Product added to the cart.</h2>
                    </div>";
        } else {
            echo "<div class='cat-success cat-deletion'>
                      <h2>Product already in the cart.</h2>
                  </div>";
        }
    }

}