<?php

require '../vendor/autoload.php';

class cashier extends Controller
{
    public function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        show($_SESSION);
        $data['row'] = $row = $this->getUser();
        $products = new Furnitures();
        $data['products'] = $products->getInventory();
        foreach ($data['products'] as $product) {
            $product->image = $products->getDisplayImage($product->ProductID)[0]->Image;
        }

        $cart = new Carts();

        if (!empty($_SESSION['CustomerID'])) {
            $cart_id = $cart->getCart($_SESSION['CustomerID'])[0]->CartID;
            $order_item = new Order_Items();


            if (empty($cart->getCart($_SESSION['CustomerID']))) {
                $cart->setCart($_SESSION['CustomerID']);
            }

            $data['cart'] = $order_item->getCustomerCartDetails($cart_id);

            if (empty($data['cart'])) {
                $data['error'] = "The cart is empty.";
            }
        }
        $customer = new Customer();

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['type'])) {
            if ($_POST['type'] = "newcust") {
                $folder = "uploads/images/";
                $_POST['Password'] = password_hash('testpass', PASSWORD_DEFAULT);
                $_POST['Password2'] = $_POST['Password'];
                $_POST['Role'] = 'Customer';
                $_POST['Mobileno'] = $_POST['contact'];
                $_POST['Gender'] = "Male";
                show($_POST);
                if ($customer->validate($_POST)) {
                    show($_POST);
                    $customer->insert($_POST);

                    echo json_encode(['success' => 'Customer added successfully.']);
                } else {
                    echo json_encode($customer->errors);
                }

                $_SESSION['CustomerID'] = $customer->where('Email', $_POST['Email'])[0]->CustomerID;
                $_SESSION['CustomerDetails'] = $customer->where('CustomerID', $_SESSION['CustomerID']);

            } else if ($_POST['type'] = "oldcust") {
                $_SESSION['CustomerID'] = $customer->where('Email', $_POST['Email'])[0]->CustomerID;
                $_SESSION['CustomerDetails'] = $customer->where('CustomerID', $_SESSION['CustomerID']);
            }

            $this->redirect('cashier');
        }

        $this->view('cashier/dash', $data);
    }

    private function getUser()
    {
//        $employee = new Employees();
//        $id = Auth::getEmployeeID();
//        return $employee->where('EmployeeID', $id);
    }

    //    public function newBill()
    //    {
    //        $bill = new Bills();
    //        $bill->createBill();
    //        $this->redirect('cashier');
    //    }

    //    public function newcustomer()
    //    {
    //        $customer = new Customer();
    //        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //            $folder = "uploads/images/";
    //            $_POST['Password'] = password_hash('testpass', PASSWORD_DEFAULT);
    //            $_POST['Password2'] = $_POST['Password'];
    //            $_POST['Role'] = 'Customer';
    //            $_POST['Mobileno'] = $_POST['contact'];
    //            $_POST['Gender'] = "Male";
    //            if ($customer->validate($_POST)) {
    //                $customer->insert($_POST);
    //                echo json_encode(['success' => 'Customer added successfully.']);
    //            } else {
    //                echo json_encode($customer->errors);
    //            }
    //
    //            $_SESSION['CustomerID'] = $customer->where('Email', $_POST['Email'])[0]->CustomerID;
    //            $_SESSION['CustomerDetails'] = $customer->where('CustomerID', $_SESSION['CustomerID']);
    //
    //        }
    ////        $this->setupBillOrder();
    //    }

    //    public function loadCustomer()
    //    {
    //        $customer = new Customer();
    //        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //            show($_POST);
    //
    //            $_SESSION['CustomerID'] = $customer->where('Email', $_POST['Email'])[0]->CustomerID;
    //            $_SESSION['CustomerDetails'] = $customer->where('CustomerID', $_SESSION['CustomerID']);
    //        }
    //
    //        $this->view('cashier');
    //
    //    }

    public function add_to_cart($id, $cost)
    {

//        if (!Auth::logged_in()) {
//            $this->redirect('login');
//        }

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

        $item_quantity = $inventory->getProductQuantity($id)[0]->Quantity;
        //if greater than 0 then add to cart


        if ($item_quantity > 0) {
            $q = "Select * from order_item where CartID = :CartID and ProductID = :ProductID";
            $res = $order_items->query($q, ['CartID' => $cart->getCart($cus_id)[0]->CartID, 'ProductID' => $id]);
//

            $info = $furniture->getFurniture($id);

            if (!empty($res)) {

                $order_items->updateQuantity($orderID, $id, $res[0]->Quantity + 1);
                $cart->updateTotalAmountToIncrease($cart->getCart($cus_id)[0]->CartID, $info[0]->Cost);
                $inventory->updateQuantityToDecrease($id, 1);

                $this->redirect("cashier/dash");
            }


            $info = $furniture->getFurniture($id);
            $image = $furniture->getDisplayImage($id);

            if (empty($order_items->getOrderItem($orderID, $id))) {
                $data = [
                    'ProductID' => $id,
                    'Name' => $info[0]->Name,
                    'Quantity' => 1,
                    'Cost' => $cost,
                    'OrderID' => $orderID,
                    'CartID' => $cart->getCart($cus_id)[0]->CartID,
                    'Image' => $image[0]->Image
                ];

                $cart->updateTotalAmountToIncrease($data['CartID'], $data['Cost']);

                $order_items->insert($data);
                $inventory->updateQuantityToDecrease($id, 1);
            } else {
                //no stock
                $this->redirect('cashier/dash');
            }
            $this->redirect('cashier/dash');
        } else {
            $this->redirect('cashier/dash');
        }
    }


    //    public function setupBillOrder()
    //    {
    //        $bill = new Bills;
    //        $order = new Orders;
    //        $cart = new Carts;
    //        $cart->setCart($_SESSION['CustomerID']);
    //        $_SESSION['CartID'] = $cart->getCart($_SESSION['CustomerID'])[0]->CartID;
    //        $_SESSION['OrderID']  = $order-> setBillOrder();
    //
    //        $bill->createBill($_SESSION['CustomerID']);
    //    }

    public function removeItem($cartID, $productID, $cost, $quantity)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $cart = new Carts();
        $order_item = new Order_Items();
        $inventory = new Product_Inventory();


        $inventory->updateQuantityToIncrease($productID, $quantity);
        $order_item->deleteItem($cartID, $productID);
        $cart->updateTotalAmountToDecrease($cartID, $cost * $quantity);


        $this->redirect('cashier/dash');
    }

    public
    function checkoutCash($orderID)
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

    public
    function resetCustomer()
    {
        $_SESSION['CustomerID'] = null;
        $_SESSION['CustomerDetails'] = null;
        $_SESSION['CartID'] = null;
        $_SESSION['OrderID'] = null;
        $this->redirect('cashier/dash');
    }

    public function checkout($orderID)
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

}
