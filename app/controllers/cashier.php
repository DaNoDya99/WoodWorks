<?php

require '../vendor/autoload.php';

class cashier extends Controller
{
    public function index(): void
    {
        show($_SESSION);
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        // show($_SESSION);

        // unset($_SESSION['CustomerID']);
        // unset($_SESSION['CustomerDetails']);


        $data['row'] = $row = $this->getUser();
        $products = new Furnitures();
        $data['products'] = $products->getInventory();
        foreach ($data['products'] as $product) {
            $product->image = $products->getDisplayImage($product->ProductID)[0]->Image;
        }


        $customer = new Customer();


        $this->view('cashier/dash', $data);
    }

    private function getUser()
    {
        $employee = new Employees();
        $id = Auth::getEmployeeID();
        return $employee->where('EmployeeID', $id);
    }

    public function oldcust()
    {

        $customer = new Customer();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $cart = new Carts();
            if (!empty($customer->where('Email', $_POST['Email'])[0]->CustomerID)) {
                $_SESSION['CustomerID'] = $customer->where('Email', $_POST['Email'])[0]->CustomerID;
                $_SESSION['CustomerDetails'] = $customer->where('CustomerID', $_SESSION['CustomerID']);
                if (empty($cart->getCart($_SESSION['CustomerID']))) {
                    $cart->setCart($_SESSION['CustomerID']);
                }

                $order_item = new Order_Items();
                $_SESSION['CartID'] = $cart->getCart($_SESSION['CustomerID'])[0]->CartID;

                if (!empty($order_item->getCustomerCartDetails($_SESSION['CartID']))) {
                    $_SESSION['cart'] = $order_item->getCustomerCartDetails($_SESSION['CartID']);
                    //convert objects in cart to array
                    $_SESSION['cart'] = json_decode(json_encode($_SESSION['cart']), true);
                    show($_SESSION['cart']);
                } else {
                    $_SESSION['cart'] = [];
                }


                if (empty($data['cart'])) {
                    $data['error'] = "The cart is empty.";
                }
                echo json_encode(['status' => 'success', 'success' => 'Customer loaded successfully.']);
//            unset($_SESSION['cart']);
            } else {
                echo json_encode(['status' => 'fail', 'error' => 'Customer not found. Try Again']);
//            unset($_SESSION['cart']);
            }
        }
    }

    public function isCustomerSet()
    {
        if (isset($_SESSION['CustomerID']) && isset($_SESSION['CustomerDetails'])) {
            echo json_encode(['status' => 'true', 'success' => 'Customer loaded successfully.']);
        } else {
            echo json_encode(['status' => 'false', 'error' => 'Customer not found. Try Again']);
        }
    }

//    public function add_to_cart($id, $cost)
//    {
//
//        //        if (!Auth::logged_in()) {
//        //            $this->redirect('login');
//        //        }
//
//        $order = new Orders();
//        $furniture = new Furnitures();
//        $cart = new Carts();
//        $order_items = new Order_Items();
//        $inventory = new Product_Inventory();
//        $cus_id = $_SESSION['CustomerID'];
//        $orderID = '';
//        if (empty($cart->getCart($cus_id))) {
//            $cart->setCart($cus_id);
//        }
//        $_SESSION['CartID'] = $cart->getCart($cus_id)[0]->CartID;
//
//        if (empty($order->checkIsPreparing($cus_id))) {
//            $orderID = $order->setBillOrder($cus_id);
//        } else {
//            $orderID = $order->checkIsPreparingInStore($cus_id)[0]->OrderID;
//        }
//        $_SESSION['OrderID'] = $orderID;
//
//        $item_quantity = $inventory->getProductQuantity($id)[0]->Quantity;
//        //if greater than 0 then add to cart
//
//
//        if ($item_quantity > 0) {
//            $q = "Select * from order_item where CartID = :CartID and ProductID = :ProductID";
//            $res = $order_items->query($q, ['CartID' => $cart->getCart($cus_id)[0]->CartID, 'ProductID' => $id]);
//            $info = $furniture->getFurniture($id);
//
//            if (!empty($res)) {
//
//                $order_items->updateQuantity($orderID, $id, $res[0]->Quantity + 1);
//                $cart->updateTotalAmountToIncrease($cart->getCart($cus_id)[0]->CartID, $info[0]->Cost);
//                $inventory->updateQuantityToDecrease($id, 1);
//
//                echo json_encode(['status' => 'success', 'success' => 'Item added to cart successfully.']);
//                // die;
//            }
//
//
//            $info = $furniture->getFurniture($id);
//            $image = $furniture->getDisplayImage($id);
//
//            if (empty($order_items->getOrderItem($orderID, $id))) {
//                $data = [
//                    'ProductID' => $id,
//                    'Name' => $info[0]->Name,
//                    'Quantity' => 1,
//                    'Cost' => $cost,
//                    'OrderID' => $orderID,
//                    'CartID' => $cart->getCart($cus_id)[0]->CartID,
//                    'Image' => $image[0]->Image
//                ];
//
//                $cart->updateTotalAmountToIncrease($data['CartID'], $data['Cost']);
//
//                $order_items->insert($data);
//                $inventory->updateQuantityToDecrease($id, 1);
//            }
//
//            echo json_encode(['status' => 'success', 'success' => 'Item added to cart successfully.']);
//        } else {
//            echo json_encode(['status' => 'fail', 'error' => 'Item is out of stock.']);
//        }
//    }

//    public function updateQuantity($cartID, $orderID, $productID, $newQuantity, $cost)
//    {
//        // if (!Auth::logged_in()) {
//        //     $this->redirect('login1');
//        // }
//
//        $cart = new Carts();
//        $order_item = new Order_Items();
//        $inventory = new Product_Inventory();
//        $item_quantity = $inventory->getProductQuantity($productID)[0]->Quantity;
//
//        if ($item_quantity >= $newQuantity) {
//            $data = [];
//            show($_SESSION);
//            foreach ($_SESSION['cart'] as $key => $value) {
//                if ($value['ProductID'] == $productID) {
//                    $oldQuantity = $value['Quantity'];
//                    $data['OrderID'] = $value['OrderID'];
//                    $data['ProductID'] = $value['ProductID'];
//                    $data['Quantity'] = $newQuantity;
//                    $data['OrderDate'] = $value['OrderDate'];
//                    $data['CustomerID'] = $value['CustomerID'];
//                    $data['Cost'] = $value['Cost'];
//                    $data['CartID'] = $value['CartID'];
//                    unset($_SESSION['cart'][$key]);
//                    $_SESSION['cart'][] = $data;
//                }
//            }
//
//            $quantityDifference = $newQuantity - $oldQuantity;
//            $inventory->updateQuantityToDecrease($productID, $quantityDifference);
//            $order_item->updateQuantity($orderID, $productID, $newQuantity);
//            $cart->updateTotalAmountToIncrease($cartID, $cost * $quantityDifference);
//
//            echo "<h1>New One</h1>";
//        } else {
//            echo "<div class='cat-success cat-deletion'>
//                <h2>The requested quantity is not available.</h2>
//              </div>";
//        }
//    }

    public function add_to_cart($id, $cost, $quantity = 1): void
    {
        $order = new Orders();
        $furniture = new Furnitures();
        $cart = new Carts();
        $order_items = new Order_Items();
        $inventory = new Product_Inventory();
        $cus_id = $_SESSION['CustomerID'];
        $orderID = '';

        if (empty($cart->getCart($cus_id))) {
            $cart->setCart($cus_id);
        }
        $_SESSION['CartID'] = $cart->getCart($cus_id)[0]->CartID;

        if (empty($order->checkIsPreparing($cus_id))) {
            $orderID = $order->setBillOrder($cus_id);
        } else {
            $orderID = $order->checkIsPreparingInStore($cus_id)[0]->OrderID;
        }
        $_SESSION['OrderID'] = $orderID;
//        show($_SESSION['OrderID']);
//        show($_SESSION['CartID']);

        $item_quantity = $inventory->getProductQuantity($id)[0]->Quantity;

        if ($item_quantity >= $quantity) {
            $q = "Select * from order_item where CartID = :CartID and ProductID = :ProductID and Is_purchased = :Is_purchased";
            $res = $order_items->query($q, ['CartID' => $cart->getCart($cus_id)[0]->CartID, 'ProductID' => $id, 'Is_purchased' => '0']);
            $info = $furniture->getFurniture($id);

            if (!empty($res)) {
//                show($res);
                $order_items->updateQuantity($orderID, $id, $res[0]->Quantity + $quantity);
                $cart->updateTotalAmountToIncrease($cart->getCart($cus_id)[0]->CartID, $info[0]->Cost * $quantity);
                $inventory->updateQuantityToDecrease($id, $quantity);

                echo json_encode(['status' => 'success', 'success' => 'Item added to cart successfully.']);
            } else {
                $info = $furniture->getFurniture($id);
                $image = $furniture->getDisplayImage($id);

                if (empty($order_items->getOrderItem($orderID, $id))) {
                    $data = [
                        'ProductID' => $id,
                        'Name' => $info[0]->Name,
                        'Quantity' => $quantity,
                        'Cost' => $cost,
                        'OrderID' => $orderID,
                        'CartID' => $cart->getCart($cus_id)[0]->CartID,
                        'Image' => $image[0]->Image
                    ];

                    $cart->updateTotalAmountToIncrease($data['CartID'], $data['Cost'] * $quantity);

                    $order_items->insert($data);
                    $inventory->updateQuantityToDecrease($id, $quantity);
                }

                $current_date_time = time();

                $details = [
                    'OrderID' => $orderID,
                    'OrderDate' => $current_date_time,
                    'CustomerID' => $cus_id,
                    'ProductID' => $id,
                    'Quantity' => $quantity,
                    'CartID' => $cart->getCart($cus_id)[0]->CartID,
                    'Cost' => $cost,
                ];

                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = array();
                }

                $_SESSION['cart'][] = $details;

                echo json_encode(['status' => 'success', 'success' => 'Item added to cart successfully.']);
            }
        } else {
            echo json_encode(['status' => 'fail', 'error' => 'Item is out of stock.']);
        }
    }

    public function removeItem($productID, $cost, $quantity)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $cartID = $_SESSION['CartID'];
        $cart = new Carts();
        $order_item = new Order_Items();
        $inventory = new Product_Inventory();


        $inventory->updateQuantityToIncrease($productID, $quantity);
        $order_item->deleteItem($cartID, $productID);
        $cart->updateTotalAmountToDecrease($cartID, $cost * $quantity);

        echo json_encode(['status' => 'success', 'success' => 'Item removed from cart successfully.']);
    }

    public function checkoutCash($orderID)
    {
        $order = new Orders();
        $order_items = new Order_Items();
        $cart = new Carts();
        $id = $_SESSION['CustomerID'];
        $inventory = new Product_Inventory();
        $_POST['Payment_type'] = 'Cash';
        $_POST['Total_amount'] = $cart->getTotalAmount($id)[0]->Total_amount;
        $_POST['Delivery_method'] = 'Home Delivery';
        $order_items->updateIsPurchased($orderID);
        $cus_order_items = $order_items->getOrderItems($orderID);

        foreach ($cus_order_items as $item) {
            $inventory->updateQuantityToDecrease($item->ProductID, $item->Quantity);
        }
        $order->update_status($orderID, $_POST);
        $order->updateIsPreparing($orderID);
        $cart->resetCartTotal($cart->getCart($id)[0]->CartID);
        $this->resetCustomer();
        $this->redirect('cashier/dash');
    }

    public function resetCustomer()
    {
        $_SESSION['CustomerID'] = null;
        $_SESSION['CustomerDetails'] = null;
        $_SESSION['CartID'] = null;
        $_SESSION['OrderID'] = null;
        $this->redirect('cashier/dash');
    }

    //return cart total amount

    public function checkout_card($orderID)
    {
        // if(!Auth::logged_in())
        // {
        //     $this->redirect('login');
        // }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $order = new Orders();
            $order_items = new Order_Items();
            $cart = new Carts();
            $id = '7WbGWsH1tZvFePZqm4b7nq6pQRhth4mpq7xACB2AFwFIAoDEFk0D46nDtzUu';


            $_POST['Payment_type'] = 'Card';
            $_POST['Total_amount'] = $cart->getTotalAmount($id)[0]->Total_amount;
            $_POST['Delivery_method'] = 'Home Delivery';

            $order->update_status($orderID, $_POST);

            $stripe = new \Stripe\StripeClient(
                'sk_test_51Mx3NxCIse71JEne0LK7axCWj4nwwxotGp7kDjehW2wfmvhSLgPMPkld8L6WdaAwj8CzkT4vhr801oJQ8s39YQ3100hKfDfWLG'
            );

            $coupon = $stripe->coupons->create(['percent_off' => 10, 'duration' => 'once', 'currency' => 'lkr']);

            $items = $order_items->getOrderItems($orderID);
            // show($items);
            // die;

            $line_items = [];

            foreach ($items as $item) {
                $line_items[] = [
                    'price_data' => [
                        'currency' => 'lkr',
                        'product_data' => [
                            'name' => $item->Name,
                        ],
                        'unit_amount' => $item->Cost * 100,
                    ],
                    'quantity' => $item->Quantity,
                ];
            }

            $checkout_session = $stripe->checkout->sessions->create([

                'shipping_address_collection' => ['allowed_countries' => ['LK']],

                'shipping_options' => [
                    [
                        'shipping_rate_data' => [
                            'type' => 'fixed_amount',
                            'fixed_amount' => ['amount' => 1500, 'currency' => 'lkr'],
                            'display_name' => 'Next day air',
                            'delivery_estimate' => [
                                'minimum' => ['unit' => 'business_day', 'value' => 1],
                                'maximum' => ['unit' => 'business_day', 'value' => 1],
                            ],
                        ],
                    ],
                ],

                'line_items' => $line_items,
                'mode' => 'payment',

                'discounts' => [[
                    'coupon' => $coupon->id,
                ]],

                'success_url' => 'http://localhost/WoodWorks/public/checkout/success?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => 'http://localhost:4242/cancel',
            ]);

            $order->updateSessionID($orderID, $checkout_session->id, 'unpaid');

            echo json_encode($checkout_session->url);
        }
    }

    //get cart items of cart

    public function getCartTotal()
    {
        $cart = new Carts();
        if (isset($_SESSION['CustomerID'])) {
            $id = $_SESSION['CustomerID'];
            $data['total'] = $cart->getTotalAmount($id)[0]->Total_amount;
            echo json_encode($data);
        } else {
            $data['total'] = 0;
            echo json_encode($data);
        }

    }

    public function getCartItems()
    {
        $cart_id = $_SESSION['CartID'];
        $cart = new Carts();

        if (!empty($_SESSION['CustomerID'])) {
            $cart_id = $cart->getCart($_SESSION['CustomerID'])[0]->CartID;
            $order_item = new Order_Items();


            if (empty($cart->getCart($_SESSION['CustomerID']))) {
                $cart->setCart($_SESSION['CustomerID']);
            }

            $data['cart'] = $order_item->getCustomerCartDetails($cart_id);

            echo json_encode($data);
        } else {
            $data['cart'] = [];
            echo json_encode($data);
        }
    }
}
