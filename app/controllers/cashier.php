<?php

ini_set('display_errors', 0);
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT);

require '../vendor/autoload.php';
require_once 'PDF.php';
require_once 'Email.php';
require '../app/services/DistanceMatrixService.php';


class cashier extends Controller
{
    public function index(): void
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        // show($_SESSION);
        $data['row'] = $row = $this->getUser();
        $products = new Furnitures();
        $data['products'] = $products->getInventorywithDiscounts();
        foreach ($data['products'] as $product) {
            $product->image = $products->getDisplayImage($product->ProductID)[0]->Image;
            if (!isset($product->Discount_percentage)) {
                $product->Discount_percentage = 0;
            }
        }
        $customer = new Customer();


        $this->view('cashier/dash', $data);
    }

    private function getUser()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $employee = new Employees();
        $id = Auth::getEmployeeID();
        return $employee->where('EmployeeID', $id);
    }


    //get orders
    public function orders()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $orders = new Orders();
        $data['orders'] = $orders->viewAllOrders();
        $this->view('cashier/orders', $data);
    }


    //load existing customer
    public function oldcust()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

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
                    // show($_SESSION['cart']);
                } else {
                    $_SESSION['cart'] = [];
                }

                $_SESSION['Final_Total'] = 0;
                $_SESSION['shipping'] = 0;
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


    //load new customer
    public function newCust()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //open json stringified data
            $customer = new Customer();


            $folder = "uploads/images/";

            if ($customer->validateCashierSignups($_POST)) {

                $destination = $folder . "user.png";

                if (!file_exists(ROOT . "/assets/images/admin/user.png")) {
                    if (copy(ROOT . "/assets/images/admin/user.png", $destination)) {
                        $this->message = "Image cannot be copied.";
                    } else {
                        $this->message = "Image copied successfully.";
                    }
                }

                $_POST['Image'] = $destination;

                $_POST['Password'] = password_hash(rand(10000000, 99999999), PASSWORD_DEFAULT);
                $customer->insert($_POST);
                $_SESSION['Email'] = $_POST['Email'];

                $data['errors'] = [];
                echo json_encode(['status' => 'success', 'email' => $_POST['Email'], 'success' => 'Customer added successfully.']);
//                $email = new Email();
//                $email->cashiersignup($_SESSION['Email']);

            } else {
                $data['errors'] = $_SESSION['errors'];
                echo json_encode($data);
            }

        }
    }

    //check if customer is set
    public
    function isCustomerSet()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        if (isset($_SESSION['CustomerID']) && isset($_SESSION['CustomerDetails'])) {
            echo json_encode(['status' => 'true', 'success' => 'Customer loaded successfully.']);
        } else {
            echo json_encode(['status' => 'false', 'error' => 'Customer not found. Try Again']);
        }
    }


    //add to cart
    public
    function add_to_cart($id, $cost, $quantity = 1): void
    {

        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

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

        if (empty($order->checkIsPreparingInStore($cus_id))) {
            $orderID = $order->setBillOrder($cus_id);
        } else {
            $orderID = $order->checkIsPreparingInStore($cus_id)[0]->OrderID;
        }


        $_SESSION['OrderID'] = $orderID;


        $item_quantity = $inventory->getProductQuantity($id)[0]->Quantity;

        if ($item_quantity >= $quantity) {
            $q = "Select * from order_item where CartID = :CartID and ProductID = :ProductID and Is_purchased = :Is_purchased";
            $res = $order_items->query($q, ['CartID' => $cart->getCart($cus_id)[0]->CartID, 'ProductID' => $id, 'Is_purchased' => '0']);
            $info = $furniture->getFurniture($id);

            if (!empty($res)) {
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
                        'Image' => $image[0]->Image,
                        'Is_purchased' => '0'
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

                echo json_encode(['status' => 'success', 'success' => 'Item added to cart successfully.', 'orderID' => $orderID]);
            }
        } else {
            echo json_encode(['status' => 'fail', 'error' => 'Item is out of stock.']);
        }
    }

//remove item from cart
    public
    function removeItem($productID, $cost, $quantity)
    {

        if (!Auth::logged_in()) {
            $this->redirect('login');
        }


        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value['ProductID'] == $productID) {
                unset($_SESSION['cart'][$key]);
            }
        }

        $cartID = $_SESSION['CartID'];

        $id = $_SESSION['CustomerID'];

        $cart = new Carts();
        $order_item = new Order_Items();
        $inventory = new Product_Inventory();
        $order = new Orders();
        $orderId = $order->checkIsPreparingInStore($id)[0]->OrderID;

        $inventory->updateQuantityToIncrease($productID, $quantity);
        $order_item->removeOrderItem($orderId, $productID);
        $cart->updateTotalAmountToDecrease($cartID, $cost * $quantity);

        if (empty($order_item->getOrderItems($orderId))) {
            $order->removeIncompletedOrders($orderId);
        }

        echo json_encode(['status' => 'success', 'success' => 'Item removed from cart successfully.']);
    }


    //checkout cash
    public
    function checkoutCash($orderID)
    {

        if (!Auth::logged_in()) {
            $this->redirect('login');
        }


        $order = new Orders();
        $order_items = new Order_Items();
        $cart = new Carts();
        $id = $_SESSION['CustomerID'];
        $inventory = new Product_Inventory();
        $_POST['Payment_type'] = 'Cash';
        $_POST['Total_amount'] = $cart->getTotalAmount($id)[0]->Total_amount;
        $_POST['Shipping_cost'] = $_SESSION['shipping'];
        if (isset($_POST['delivery'])) {
            if ($_POST['delivery'] == 'delivery') {
                $_POST['Delivery_method'] = 'Delivery';
                $_POST['Shipping_cost'] = $_SESSION['shipping'];
                $_POST['Address'] = $_POST['addressLine1'] . ', ' . $_POST['addressLine2'] . ', ' . $_POST['City'];
            } else {
                $_POST['Delivery_method'] = 'Pickup';
                $_POST['Shipping_cost'] = 0;
                $_POST['Address'] = 'N/A';
            }
        }

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

    //reset customer
    public
    function resetCustomer()
    {

        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $_SESSION['CustomerID'] = null;
        $_SESSION['CustomerDetails'] = null;
        $_SESSION['CartID'] = null;
        $_SESSION['cart'] = null;
        $_SESSION['OrderID'] = null;
        $this->redirect('cashier/dash');
    }

    //checkout card
    public
    function checkout_card()
    {

        if (!Auth::logged_in()) {
            $this->redirect('login');
        }


        $orderID = $_SESSION['OrderID'];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $order = new Orders();
            $order_items = new Order_Items();
            $cart = new Carts();
            $id = $_SESSION['CustomerID'];


            $_POST['Payment_type'] = 'Card';
            $_POST['Total_amount'] = $cart->getTotalAmount($id)[0]->Total_amount;
            if (isset($_POST['delivery'])) {
                if ($_POST['delivery'] == 'delivery') {
                    $_POST['Delivery_method'] = 'Delivery';
                    $_POST['Shipping_cost'] = $_SESSION['shipping'];
                    $_POST['Address'] = $_POST['addressLine1'] . ', ' . $_POST['addressLine2'] . ', ' . $_POST['City'];
                } else {
                    $_POST['Delivery_method'] = 'Pickup';
                    $_POST['Shipping_cost'] = 0;
                    $_POST['Address'] = 'N/A';
                }
            }


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


                'shipping_options' => [
                    [
                        'shipping_rate_data' => [
                            'type' => 'fixed_amount',
                            'fixed_amount' => ['amount' => $_POST['Shipping_cost'] * 100, 'currency' => 'lkr'],
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
                    // 'coupon' => $coupon->id,
                ]],

                'success_url' => 'http://localhost/WoodWorks/public/cashier/card_success?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => 'http://localhost/WoodWorks/public/cashier/dash'
            ]);

            $order->updateSessionID($orderID, $checkout_session->id, 'unpaid');

            echo json_encode($checkout_session->url);
        }
    }

    //return cart total amount

    public
    function getCartTotal()
    {

        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

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

    //get cart items of cart

    public
    function getCartItems()
    {

        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

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

    public
    function Profile($id = null)
    {


        if (!Auth::logged_in()) {
            $this->redirect('login1');
        }

        $id = $id ?? Auth::getEmployeeID();
        $employee = new Employees();
        $data['row'] = $row = $employee->where('EmployeeID', $id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $row) {
            $folder = "uploads/images/";
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
                file_put_contents($folder . "index.php", "<?php Access Denied.");
                file_put_contents("uploads/index.php", "<?php Access Denied.");
            }

            if ($employee->edit_validate($_POST, $id)) {
                $allowedFileType = ['image/jpeg', 'image/png'];


                if (!empty($_FILES['Image']['name'])) {
                    if ($_FILES['Image']['error'] == 0) {
                        if (in_array($_FILES['Image']['type'], $allowedFileType)) {
                            $destination = $folder . time() . $_FILES['Image']['name'];
                            move_uploaded_file($_FILES['Image']['tmp_name'], $destination);

                            //                            resize_image($destination);
                            $_POST['Image'] = $destination;
                            if (file_exists($row[0]->Image)) {
                                unlink($row[0]->Image);
                            }
                        } else {
                            $employee->errors['image'] = "This file type is not allowed.";
                        }
                    } else {
                        $employee->errors['image'] = "Could not upload image.";
                    }
                }

                $_POST['EmployeeID'] = $id;
                $employee->update($id, $_POST);
                $this->redirect('cashier/profile/' . $id);
            }
        }
        $this->view('cashier/profile', $data);
    }

    public
    function getDiscount($id)
    {

        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $discounts = new Discounts();
        $discount = $discounts->getDiscount($id);

        if (empty($discount)) {
            return 0;
        }
        return $discount[0]->Discount_percentage;
    }

    public
    function updateFinalTotal()
    {

        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $cart = new Carts();
        $id = $_SESSION['CustomerID'];
        $_SESSION['Final_Total'] = $cart->getTotalAmount($id)[0]->Total_amount + $_SESSION['shipping'];

        $data['total'] = $_SESSION['Final_Total'];
        $data['shipping'] = $_SESSION['shipping'];
        echo json_encode($data);
    }

    public
    function getOrderSummary()
    {

        if (!Auth::logged_in()) {
            $this->redirect('login');
        }


        $id = $_SESSION['CustomerID'];
        $orderitem = new Order_Items();

        $orderCount = $orderitem->getTotalOrderItemCount($id);
        $data["Total"] = $_SESSION['Final_Total'];
        $data["OrderCount"] = $orderCount[0]->Count;
        echo json_encode($data);
    }


    public
    function card_success()
    {

        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $customer = new Customer();
        $order = new Orders();
        $order_items = new Order_items();

        $cart = new Carts();
        $id = $_SESSION['CustomerID'];
        $data['row'] = $customer->where('CustomerID', $id);
        $session_id = $_GET['session_id'];
        $order_id = $order->checkIsPreparing($id)[0]->OrderID;

        $stripe = new \Stripe\StripeClient(
            $_ENV['STRIPE_API_KEY']
        );

        try {
            $session = $stripe->checkout->sessions->retrieve($session_id);


            if (!$session) {
                $this->redirect('_404');

            }

            $customer = $session->customer_details;
            $cus_order = $order->getOrderByTheOrderID($order_id)[0];


            if ($session->id === $cus_order->SessionID) {
                $order->updateSessionID($cus_order->OrderID, $session->id, 'paid');
                $order->updateIsPreparing($cus_order->OrderID);
                $order_items->updateIsPurchased($cus_order->OrderID);
                $cart->resetCartTotal($cart->getCart($id)[0]->CartID);

                unset($_SESSION['cart']);
            } else {
                $this->redirect('_404');
            }

            $data['customer'] = $customer['name'];
            $data['order'] = $cus_order;
            $data['order_items'] = $order_items->getOrderItems($cus_order->OrderID);
            $data['orderId'] = $order_id;

            $this->view('cashier/card_success', $data);
        } catch (Exception $e) {
            $this->redirect('_404');
        }
    }

    public
    function bill($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $pdf = new PDF();
        $pdf->generateBill($id);
    }

    public
    function getOrderByID($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $order = new Orders();
        $order_items = new Order_Items();
        $data['order'] = $order->getOrderByID($id);
        $data['order_items'] = $order_items->getOrderItems($id);
        echo json_encode($data);
    }

    public
    function getShipping()
    {

        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        if ($_POST['delivery'] == 'delivery') {
            $deliveries = new Deliveries();
            $distanceMatrix = new DistanceMatrixService();
            $distance = $distanceMatrix->calculateDistance('Colombo', $_POST['City']);
            $deliveryCost = $deliveries->getDeliveryRate(explode(' ', $distance['distance'])[0])[0]->Cost_per_km * explode(' ', $distance['distance'])[0];

        } else {
            $deliveryCost = 0;
        }

        $_SESSION['shipping'] = $deliveryCost;

        echo json_encode($deliveryCost);

    }
}
