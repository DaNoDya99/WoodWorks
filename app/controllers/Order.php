<?php

class Order extends Controller
{
    public function index(){

    }

    public function orderDetails($id)
    {

        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $orders = new Orders();
        $rows = $orders->getOrderDetails($id);

        $str = '<div  class="delivery-order-items">';
        foreach ($rows as $row) {
            $str .= "
                <div class='order-item deliver-order-item'>
                    <img src='http://localhost/WoodWorks/public/" . $row->Image . "' alt=''>
                    <div class='ordered-product-details'>
                        <div class='ordered-product-details-lhs'>
                            <div class='row5'>
                                <h4>" . $row->Name . "</h4>
                            </div>
                 
                            <div class='row4'>
                                <span>" . $row->Quantity . " item</span>
                                <span>" . $row->ProductID . "</span>
                            </div>
                        </div>
                    
                        <div class='price'>
                            <span>Rs. " . $row->Cost . ".00</span>
                        </div>
                    </div>
                </div>
            ";
        }

        $order = $orders->deliveryOrderDetails($id)[0];

        $str .= '</div>';
        $str .= "
             <div class='order-payment-details deliver-order-details' >
                        <h2>Order Details</h2>
                        <div class='order-detail'>
                            <h4>Order ID</h4>
                            <span>" . $order->OrderID . "</span>
                        </div>
                        <div class='order-detail'>
                            <h4>Phone Number</h4>
                            <span>" . $order->Contactno . "</span>
                        </div>
                        <div class='order-detail'>
                            <h4>Delivery Address</h4>
                            <span>" . $order->Address . "</span>
                        </div>
                        <div class='order-detail order-final-detail'>
                        </div>
                        <div class='order-detail order-total delivery-order-total'>
                            <h4>Total Amount</h4>
                            <span>Rs. " . $order->Total_amount . ".00</span>
                        </div>
                    </div>
        ";

        echo $str;
    }

    public function getOrderItem($orderID,$productId)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $order_item = new Order_Items();
        $row = $order_item->getOrderItem($orderID,$productId)[0];

        $str = "
            <h2>".$row->Name." - ".$row->ProductID."</h2>
            <div class='review-fur-img'>
                <img src='http://localhost/WoodWorks/public/".$row->Image."' alt=''>
            <div class='current-rating'>
                <h2>Current Ratings</h2>
                <span>4.5</span>
                <div>
                    <div class='stars-outer'>
                        <div class='stars-inner' style='width: 80%'></div>
                    </div>
                    <span class='number-rating'></span>
                </div>
            </div>
            <div class='your-rating'>
                <h2>Rate Product</h2>
            
                <div class='star-widget'>
                    <input type='radio' name='rate' id='rate-5' value='5'>
                    <label for='rate-5' class='fas fa-star' onclick='setRate(5)'></label>
                    <input type='radio' name='rate' id='rate-4' value='4'>
                    <label for='rate-4' class='fas fa-star' onclick='setRate(4)'></label>
                    <input type='radio' name='rate' id='rate-3' value='3'>
                    <label for='rate-3' class='fas fa-star' onclick='setRate(3)'></label>
                    <input type='radio' name='rate' id='rate-2' value='2'>
                    <label for='rate-2' class='fas fa-star' onclick='setRate(2)'></label>
                    <input type='radio' name='rate' id='rate-1' value='1'>
                    <label for='rate-1' class='fas fa-star' onclick='setRate(1)'></label>
                </div>
            </div>
            </div>
            <div class='write-review'>
                <h2>Write a review</h2>
                <textarea id='review' cols='30' rows='10' maxlength='1024' placeholder='Describe Your Experience...'></textarea>
            </div>
            <div class='review-btn-container'>
                <button class='review-btn' onclick='saveReview()'>Post Review</button>
            </div>
        ";

        echo $str;
    }
}