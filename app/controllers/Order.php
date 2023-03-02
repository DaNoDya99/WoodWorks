<?php

class Order extends Controller
{
    public function index(){

    }

    public function orderDetails($id)
    {

        if (!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $orders = new Orders();
        $rows = $orders->getOrderDetails($id);

        $str = '<div  class="delivery-order-items">';
        foreach($rows as $row)
        {
            $str .= "
                <div class='order-item deliver-order-item'>
                    <img src='http://localhost/WoodWorks/public/".$row->Image."' alt=''>
                    <div class='ordered-product-details'>
                        <div class='ordered-product-details-lhs'>
                            <div class='row5'>
                                <h4>".$row->Name."</h4>
                            </div>
                 
                            <div class='row4'>
                                <span>".$row->Quantity." item</span>
                                <span>".$row->ProductID."</span>
                            </div>
                        </div>
                    
                        <div class='price'>
                            <span>Rs. ".$row->Cost.".00</span>
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
                            <span>".$order->OrderID."</span>
                        </div>
                        <div class='order-detail'>
                            <h4>Phone Number</h4>
                            <span>".$order->Contactno."</span>
                        </div>
                        <div class='order-detail'>
                            <h4>Delivery Address</h4>
                            <span>".$order->Address."</span>
                        </div>
                        <div class='order-detail order-final-detail'>
                            <h4>Invoice Number</h4>
                            <span>12345</span>
                        </div>
                        <div class='order-detail order-total delivery-order-total'>
                            <h4>Total Amount</h4>
                            <span>Rs. ".$order->Total_amount.".00</span>
                        </div>
                    </div>
        ";

        echo $str;
    }
}