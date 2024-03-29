<?php


require '../vendor/autoload.php';
require '../app/services/DistanceMatrixService.php';

class Customer_home extends Controller
{
    public function index()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login1');
        }

        $furniture = new Furnitures();
        $customer = new Customer();
        $review = new Reviews();
        $id = Auth::getCustomerID();
        $data['row'] = $customer->where('CustomerID',$id);
        $data['furnitures'] =$rows= $furniture->getNewFurniture(['ProductID','Name','Cost','Sub_category_name']);

        foreach ($rows as $row)
        {
            if(!empty($furniture->getDisplayImage($row->ProductID)[0]->Image))
            {
                $row->Image = $furniture->getDisplayImage($row->ProductID)[0]->Image;
                $row->Rate = round($review->getProductRating($row->ProductID)[0]->Average,1);
                $row->Rating = (($row->Rate/5)*100).'%';
            }
        }
        
        $this->view('reg_customer/customer_home',$data);
    }

    public function profile($id = null){

        if(!Auth::logged_in()){
            $this->redirect('login1');
        }

        $customer = new Customer();
        $id = Auth::getCustomerID();
        $data['row'] = $row = $customer->where('CustomerID',$id);

        if($_SERVER['REQUEST_METHOD'] == 'POST' && $row)
        {
            $folder = "uploads/images/";
            if(!file_exists($folder)){
                mkdir($folder,0777,true);
                file_put_contents($folder."index.php","<?php Access Denied.");
                file_put_contents("uploads/index.php","<?php Access Denied.");
            }

            if($customer->edit_validate($_POST))
            {
                $allowedFileType = ['image/jpeg','image/png'];


                if(!empty($_FILES['Image']['name']))
                {
                    if($_FILES['Image']['error'] == 0)
                    {
                        if(in_array($_FILES['Image']['type'],$allowedFileType))
                        {
                            $destination = $folder.time().$_FILES['Image']['name'];
                            move_uploaded_file($_FILES['Image']['tmp_name'],$destination);

//                            resize_image($destination);
                            $_POST['Image'] = $destination;
                            if(file_exists($row[0]->Image))
                            {
                                unlink($row[0]->Image);
                            }
                        }else{
                            $customer->errors['image'] = "This file type is not allowed.";
                        }
                    }else{
                        $customer->errors['image'] = "Could not upload image.";
                    }
                }

                $_POST['CustomerID'] = $id;

                $customer->update($id,$_POST);
                $this->redirect('customer_home/profile/'.$id);
            }
        }

        $data['errors'] = $customer->errors;

        $this->view('reg_customer/profile',$data);
    }

    public function add_to_cart($id,$cost){

        if(!Auth::logged_in()){
            $this->redirect('login');
        }

        $order = new Orders();
        $furniture = new Furnitures();
        $cart = new Carts();
        $order_items = new Order_Items();
        $inventory = new Product_Inventory();
        $cus_id = Auth::getCustomerID();
        $orderID = '';

        $fur = $furniture->searchFurnitureByID($id)[0];
        if($fur->Quantity < 1){
            echo "<div class='cat-success cat-deletion'>
                    <h2>Product is out of stock.</h2>
                </div>";
            return;
        }

        if(empty($cart->getCart($cus_id)))
        {
            $cart->setCart($cus_id);
        }

        if(empty($order->checkIsPreparing($cus_id)))
        {
            $orderID = $order->setOrder($cus_id);
        }else
        {
            $orderID = $order->checkIsPreparing($cus_id)[0]->OrderID;
        }

        $info = $furniture->getFurniture($id);
        $image = $furniture->getDisplayImage($id);

        if(empty($order_items->getOrderItem($orderID,$id)))
        {
            $data = [
                'ProductID' => $id,
                'Name' => $info[0]->Name,
                'Quantity' => 1,
                'Cost' => $cost,
                'OrderID' => $orderID,
                'CartID' => $cart->getCart($cus_id)[0]->CartID,
                'Image' => $image[0]->Image
            ];

            $cart->updateTotalAmountToIncrease($data['CartID'],$data['Cost']);

            $order_items->insert($data);
            $inventory->updateQuantityToDecrease($id,1);
            $current_date_time = time();

            $details = [
                'OrderID' => $orderID,
                'OrderDate' => $current_date_time,
                'CustomerID' => $cus_id,
                'ProductID' => $id,
                'Quantity' => 1,
                'CartID' => $cart->getCart($cus_id)[0]->CartID,
                'Cost' => $cost,
            ];

            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = array();
            }

            $_SESSION['cart'][] = $details;

            echo "<div class='cat-success'>
                    <h2>Product added to the cart.</h2>
                </div>";
        }else{
            echo "<div class='cat-success cat-deletion'>
                    <h2>Product already in the cart.</h2>
                </div>";
        }

    }


    public function removeItem($cartID,$productID,$cost,$quantity)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        foreach ($_SESSION['cart'] as $key => $value)
        {
            if($value['ProductID'] == $productID)
            {
                unset($_SESSION['cart'][$key]);
            }
        }

        $id = Auth::getCustomerID();
        
        $cart = new Carts();
        $order_item = new Order_Items();
        $inventory = new Product_Inventory();
        $order = new Orders();
        $orderId = $order->checkIsPreparing($id)[0]->OrderID;

        $inventory->updateQuantityToIncrease($productID,$quantity);
        $order_item->removeOrderItem($orderId,$productID);
        $cart->updateTotalAmountToDecrease($cartID,$cost*$quantity);

        if(empty($order_item->getOrderItems($orderId)))
        {
            $order->removeIncompletedOrders($orderId);
        }

        $this->redirect('cart');
    }

    public function about()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $customer = new Customer();
        $id = Auth::getCustomerID();
        $data['row'] = $row = $customer->where('CustomerID',$id);

        $this->view('about',$data);
    }

    public function  contact()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $customer = new Customer();
        $id = Auth::getCustomerID();
        $data['row'] = $row = $customer->where('CustomerID',$id);

        $this->view('contact',$data);
    }

    public function payment($cartid = null)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $customer = new Customer();
        $id = Auth::getCustomerID();
        $data['row'] = $row = $customer->where('CustomerID',$id);

        $order_items = new Order_Items();
        $data['items'] = $order_items->getCustomerCartDetails($cartid);

        $this->view('reg_customer/payment',$data);
    }

    public function checkout($orderID)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $deliveries = new Deliveries();

        $distanceMatrix = new DistanceMatrixService();
        $distance = $distanceMatrix->calculateDistance('Colombo',$_POST['City']);
        $deliveryCost = $deliveries->getDeliveryRate(explode(' ',$distance['distance'])[0])[0]->Cost_per_km*explode(' ',$distance['distance'])[0];

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $order = new Orders();
            $order_items = new Order_Items();
            $furniture = new Furnitures();
            $cart = new Carts();
            $id = Auth::getCustomerID();

            $_POST['Payment_type'] = 'Card';
            $_POST['Total_amount'] = $cart->getTotalAmount($id)[0]->Total_amount;
            $_POST['Delivery_method'] = 'Delivery';
            $_POST['Shipping_cost'] = $deliveryCost;
            $_POST['Address'] = $_POST['Address_line1'].', '.$_POST['Address_line2'].', '.$_POST['City'];
            $_POST['Distance'] = $distance['distance'];


            $stripe =  new \Stripe\StripeClient(
                $_ENV['STRIPE_API_KEY']
            );


            $items = $order_items->getOrderItems($orderID);

            $item_total = 0;

            foreach ($items as $item)
            {
                $item_total += $furniture->getFurniture($item->ProductID)[0]->Cost*$item->Quantity;
            }

            $_POST['Discount_obtained'] = $item_total - $_POST['Total_amount'];
            $_POST['Item_total'] = $item_total;
//            echo json_encode($_POST);die;
            $order->update_status($orderID,$_POST);

            $line_items = [];

            foreach ($items as $item)
            {
                $line_items[] = [
                    'price_data' => [
                        'currency' => 'lkr',
                        'product_data' => [
                            'name' => $item->Name,
                        ],
                        'unit_amount' => $item->Cost*100,
                    ],
                    'quantity' => $item->Quantity,
                ];
            }

            $checkout_session = $stripe->checkout->sessions->create([
                'shipping_options' => [
                  [
                    'shipping_rate_data' => [
                      'type' => 'fixed_amount',
                      'fixed_amount' => ['amount' => $deliveryCost*100, 'currency' => 'lkr'],
                      'display_name' => 'Home Delivery',
                      'delivery_estimate' => [
                        'minimum' => ['unit' => 'business_day', 'value' => 1],
                        'maximum' => ['unit' => 'business_day', 'value' => 1],
                      ],
                    ],
                  ],
                ],

                'line_items' => $line_items,
                'mode' => 'payment',

                'success_url' => 'http://localhost/WoodWorks/public/checkout/success?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => 'http://localhost:4242/cancel',
            ]);

            $order->updateSessionID($orderID,$checkout_session->id,'unpaid');

            echo json_encode($checkout_session->url);
        }
    }

    public function orders()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $customer = new Customer();
        $id = Auth::getCustomerID();
        $data['row'] = $row = $customer->where('CustomerID',$id);

        $orders= new Orders();
        $orders_cus = $orders->getCustomerOrders($id);
        $order_items = new Order_Items();

        if(!empty($orders_cus))
        {
            foreach ($orders_cus as $order)
            {
                $order->items = $order_items->getOrderItemCount($order->OrderID)[0]->Count;
                $order->Date = date("Y/m/d - H:i:s",strtotime($order->Date));
            }

            $data['orders'] = $orders_cus;
        }

        $this->view('reg_customer/orders',$data);
    }

    public function getOrderDetails($orderID)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $order_items = new Order_Items();
        $orders = new Orders();
        $items = $order_items->getOrderItems($orderID);
        $details = $orders->deliveryOrderDetails($orderID)[0];

        $line = 'line-active';
        $yet = 'yet-to-complete';
        $completed = "<img class='completed' src='http://localhost/WoodWorks/public/assets/images/customer/tick-circle-svgrepo-com.svg' alt=''>";
        $current = "<img class='current' src='http://localhost/WoodWorks/public/assets/images/customer/loading-part-2-svgrepo-com.svg' alt=''>";

        $str = "<div class='order-progressing-bar'>";

        switch ($details->Order_status)
        {
            case 'Paid':
                $str .= "
                    <div class='prog-status-container'>
                    <img src='http://localhost/WoodWorks/public/assets/images/customer/dollar-circle-svgrepo-com(1).svg' alt='paid'>
                    <span>Paid</span>
                    <img class='completed' src='http://localhost/WoodWorks/public/assets/images/customer/tick-circle-svgrepo-com.svg' alt=''>
                    </div>
                    <div class='line'></div>
                    <div class='prog-status-container'>
                        <img class='".$yet."' src='http://localhost/WoodWorks/public/assets/images/customer/gift-box-svgrepo-com.svg' alt='paid'>
                        <span class='".$yet."'>Processing</span>
                    </div>
                    <div class='line'></div>
                    <div class='prog-status-container'>
                        <img class='".$yet."' src='http://localhost/WoodWorks/public/assets/images/customer/shipping-svgrepo-com.svg' alt='paid'>
                        <span class='".$yet."'>Dispatched</span>
                    </div>
                    <div class='line'></div>
                    <div class='prog-status-container'>
                        <img class='yet-to-complete' src='http://localhost/WoodWorks/public/assets/images/customer/delivered-svgrepo-com.svg' alt='paid'>
                        <span class='yet-to-complete'>Delivered</span>
                    </div>
                    <div class='line'></div>
                    <div class='prog-status-container'>
                        <img class='yet-to-complete' src='http://localhost/WoodWorks/public/assets/images/customer/review-like-message-svgrepo-com.svg' alt='paid'>
                        <span class='yet-to-complete'>Review</span>
                    </div>
                ";
                break;
            case 'Processing':
                $str .= "
                    <div class='prog-status-container'>
                    <img src='http://localhost/WoodWorks/public/assets/images/customer/dollar-circle-svgrepo-com(1).svg' alt='paid'>
                    <span>Paid</span>
                    <img class='completed' src='http://localhost/WoodWorks/public/assets/images/customer/tick-circle-svgrepo-com.svg' alt=''>
                    </div>
                    <div class='line line-active'></div>
                    <div class='prog-status-container'>
                        <img src='http://localhost/WoodWorks/public/assets/images/customer/gift-box-svgrepo-com.svg' alt='paid'>
                        <span>Processing</span>
                        ".$current."
                    </div>
                    <div class='line'></div>
                    <div class='prog-status-container'>
                        <img class='".$yet."' src='http://localhost/WoodWorks/public/assets/images/customer/shipping-svgrepo-com.svg' alt='paid'>
                        <span class='".$yet."'>Dispatched</span>
                    </div>
                    <div class='line'></div>
                    <div class='prog-status-container'>
                        <img class='yet-to-complete' src='http://localhost/WoodWorks/public/assets/images/customer/delivered-svgrepo-com.svg' alt='paid'>
                        <span class='yet-to-complete'>Delivered</span>
                    </div>
                    <div class='line'></div>
                    <div class='prog-status-container'>
                        <img class='yet-to-complete' src='http://localhost/WoodWorks/public/assets/images/customer/review-like-message-svgrepo-com.svg' alt='paid'>
                        <span class='yet-to-complete'>Review</span>
                    </div>
                ";
                break;
            case 'Dispatched':
                $str .= "
                    <div class='prog-status-container'>
                    <img src='http://localhost/WoodWorks/public/assets/images/customer/dollar-circle-svgrepo-com(1).svg' alt='paid'>
                    <span>Paid</span>
                    <img class='completed' src='http://localhost/WoodWorks/public/assets/images/customer/tick-circle-svgrepo-com.svg' alt=''>
                    </div>
                    <div class='line line-active'></div>
                    <div class='prog-status-container'>
                        <img src='http://localhost/WoodWorks/public/assets/images/customer/gift-box-svgrepo-com.svg' alt='paid'>
                        <span>Processing</span>
                        ".$completed."
                    </div>
                    <div class='line ".$line."'></div>
                    <div class='prog-status-container'>
                        <img src='http://localhost/WoodWorks/public/assets/images/customer/shipping-svgrepo-com.svg' alt='paid'>
                        <span>Dispatched</span>
                        ".$current."
                    </div>
                    <div class='line'></div>
                    <div class='prog-status-container'>
                        <img class='yet-to-complete' src='http://localhost/WoodWorks/public/assets/images/customer/delivered-svgrepo-com.svg' alt='paid'>
                        <span class='yet-to-complete'>Delivered</span>
                    </div>
                    <div class='line'></div>
                    <div class='prog-status-container'>
                        <img class='yet-to-complete' src='http://localhost/WoodWorks/public/assets/images/customer/review-like-message-svgrepo-com.svg' alt='paid'>
                        <span class='yet-to-complete'>Review</span>
                    </div>
                ";
                break;
            case 'Delivered':
                $str .= "
                    
                    <button class='issue-btn' onclick='loadReportIssuePage(`$orderID`)'>Report Issue</button>
                    
                    <div class='prog-status-container'>
                    <img src='http://localhost/WoodWorks/public/assets/images/customer/dollar-circle-svgrepo-com(1).svg' alt='paid'>
                    <span>Paid</span>
                    <img class='completed' src='http://localhost/WoodWorks/public/assets/images/customer/tick-circle-svgrepo-com.svg' alt=''>
                    </div>
                    <div class='line line-active'></div>
                    <div class='prog-status-container'>
                        <img src='http://localhost/WoodWorks/public/assets/images/customer/gift-box-svgrepo-com.svg' alt='paid'>
                        <span>Processing</span>
                        ".$completed."
                    </div>
                    <div class='line ".$line."'></div>
                    <div class='prog-status-container'>
                        <img src='http://localhost/WoodWorks/public/assets/images/customer/shipping-svgrepo-com.svg' alt='paid'>
                        <span>Dispatched</span>
                        ".$completed."
                    </div>
                    <div class='line ".$line."'></div>
                    <div class='prog-status-container'>
                        <img src='http://localhost/WoodWorks/public/assets/images/customer/delivered-svgrepo-com.svg' alt='paid'>
                        <span>Delivered</span>
                        ".$completed."
                    </div>
                    <div class='line ".$line."'></div>
                    
                        <div class='prog-status-container'>
                            <a href='http://localhost/WoodWorks/public/review/addreview/".$orderID."'>
                                <img src='http://localhost/WoodWorks/public/assets/images/customer/review-like-message-svgrepo-com.svg' alt='paid'>
                            </a>    
                            <span>Review</span>
                            ".$current."
                        </div>
                    
                ";
                break;
        }


        $str .= "</div><div class='order-items'>";

        foreach ($items as $item)
        {
           $str .= "
                <div class='order-item'>
                    <img src='http://localhost/WoodWorks/public/".$item->Image."' alt=''>

                    <div class='ordered-product-details'>
                        <div class='ordered-product-details-lhs'>
                            <div class='row1'>
                                <h4>".$item->Name."</h4>
                                <span>".$item->ProductID."</span>
                            </div>
                    
                            <div class='row2'><span>".$item->Wood_type."</span></div>
                            <div class='row3'><span>".$item->Quantity." item</span></div>
                        </div>
                    
                        <div class='price'>
                            <span>Rs.".$item->Cost.".00</span>
                        </div>
                    </div>
                </div>
           ";
        }

        $str .= "</div>";

        $str .= "
            <div class='order-payment-details'>
                <h2>Order Details</h2>
                <div class='order-detail'>
                    <h4>Phone Number</h4>
                    <span>" . $details->Contactno . "</span>
                </div>
                <div class='order-detail'>
                    <h4>Delivery Address</h4>
                    <span>" . $details->Address . "</span>
                </div>
                <div class='order-detail '>
                    <h4>Invoice Number</h4>
                    <span>" .$details->OrderID . "</span>
                </div>
                <div class='order-detail'>
                    <h4>Sub Total</h4>
                    <span>Rs. " . $details->Total_amount . ".00</span>
                </div> 
                <div class='order-detail'>
                    <h4>Shipping Cost</h4>
                    <span>Rs. " . $details->Shipping_cost . "</span>
                </div>
                <div class='order-detail order-final-detail'>
                    <h4>Discount Obtained</h4>
                    <span>-Rs. " . $details->Discount_obtained . (".00</span>
                </div>
                <div class='order-detail order-total'>
                    <h4>Total</h4>
                    <span>Rs. " . ($details->Total_amount + $details->Shipping_cost - $details->Discount_obtained)) .".00</span>
                </div>
            </div>
        ";

        echo $str;
    }

    public function reportIssue($order_id)
    {
        if (!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $customer = new Customer();
        $id = Auth::getCustomerID();
        $data['row'] = $customer->where('CustomerID',$id);

        $order_items = new Order_Items();
        $items = $order_items->getOrderItems($order_id);

        foreach ($items as $item)
        {
            $date = new DateTime(explode(' ',$item->Date)[0]);
            $item->Warrenty_period = $date->format('Y-m-d'). " to ".$date->add(new  DateInterval('P'.explode(' ',$item->Warrenty_period)[0].'Y'))->format('Y-m-d');
        }

        $data['order_id'] = $order_id;
        $data['items'] = $items;

        $this->view('reg_customer/issues',$data);
    }

}