<?php

require '../vendor/autoload.php';
use Dompdf\Dompdf;

class Checkout extends Controller
{
    public function index()
    {

    }

    public function downloadInvoice($orderId,$name)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }


        $order = new Orders();
        $order_items = new Order_items();

        $order_details = $order->getPaidOrderDetails($orderId)[0];
        $order_items_details = $order_items->getOrderItems($orderId);

        echo json_encode($order_details);

        $address = explode(',',$order_details->Address);

        $html = '
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="preconnect" href="https://fonts.googleapis.com">
                <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300&display=swap" rel="stylesheet">
                <title>Invoice</title>
                <style>
                    .invoice.js-container{
                        margin: 3em auto;
                        width: 100%;
                        text-align: center;
                        padding: 1em;
                        border: 2px solid #d4d4d4;
                        font-family: Rubik, sans-serif;
                    }

                    .title-container{
                        margin-top: 1em;
                        font-size: smaller;
                        width: 100%;
                    }

                    .title-left{
                        display: inline-block;
                        border-top:2px #d4d4d4 solid;
                        width: 30%;
                    }
                    .title-right{
                        display: inline-block;
                        border-bottom:2px #d4d4d4 solid;
                        width: 30%;
                    }

                    .detail-container{
                        display: flex;
                        justify-content: space-between;
                        margin-top: 2em;
                        font-size: x-small;
                    }

                    .left-detail{
                        display: block;
                        margin-bottom: 15px;
                        width: 50%;
                    }

                    .right-detail{
                        display: inline-block;
                        flex-direction: column;
                    }

                    .detail-box{
                        display: inline-block;
                        width: 10em;
                        padding: .5em;
                        background-color: #0F3D3E;
                        color: white;
                        height: 3em;
                    }

                    .detail-box img{
                        width: 2em;
                        height: 2em;
                        margin-bottom: 1em;
                    }

                    .address{
                        display:flex;
                        align-items: end;
                        flex-direction: column;
                    }

                    .right-detail{
                        display: flex;
                        text-align: right;
                    }

                    .item-details{
                        margin-top: 2em;
                        width: 100%;
                        border: 2px solid #d4d4d4;

                    }

                    .item-details, th, td{
                        border: 2px solid #d4d4d4;
                        border-collapse: collapse;
                    }

                    .item-details th{
                        background-color: #0F3D3E;
                        font-size: smaller;
                        color: white;
                    }

                    .item-details th, .item-details td{
                        padding: 0.5em;
                    }

                    .item-details td{
                        font-size: x-small;
                    }

                    .costs{
                        font-weight: 700;
                        text-align: left;
                    }

                    .cost{
                        font-weight: 700;
                        text-align: right;
                    }

                    .response{
                        display: flex;
                        justify-content: space-between;
                    }

                    .response h3{
                        font-size: large;
                    }

                    .signature{
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        margin-top: 2em;
                        font-size: small;
                    }

                    .signature img{
                        width: 6em;
                        height: 4em;
                    }

                    .items{
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                    }

                </style>
            </head>
            <body>
                <div class="invoice.js-container">
                    <div class="title-container">
                        <div class="title-left">
                            <h1>Woodworks Furniture</h1>
                        </div>
                        <div class="title-right">
                            <h1>INVOICE</h1>
                        </div>

                    </div>

                    <div class="detail-container">
                        <div class="left-detail">
                            <div class="detail-box">
                                <div class="items">
                                    <span>INVOICE NO #</span><br>
                                    <span>'.substr($order_details->OrderID,0,8).'</span>
                                </div>
                            </div>
                            <div class="detail-box">
                                <div class="items">
                                    <span>INVOICE DATE</span><br>
                                    <span>'.$order_details->Date.'</span>
                                </div>

                            </div>
                            <div class="detail-box">
                                <div class="items">
                                    <span>DUE:</span>
                                    <span>Rs '.$order_details->Total_amount.'.00</span>
                                 </div>

                            </div>
                        </div>
                        <div class="right-detail">
                            <span>INVOICE TO,</span>
                            <span>'.$name.'</span>
                            <div class="address">';

        foreach ($address as $add) {
            $html .= '<span>'.$add.'</span>';
        }

         $html .=            '</div>
                        </div>


                    </div>
                    <table class="item-details">
                        <tr>
                            <th>ITEM DESCRIPTION</th>
                            <th>QUANTITY</th>
                            <th>UNIT PRICE</th>
                            <th>TOTAL PRICE</th>
                        </tr>';

        foreach ($order_items_details as $item) {
            $html .= '
                <tr>
                    <td>' . $item->Name . '</td>
                    <td>' . $item->Quantity . '</td>
                    <td>Rs. ' . $item->Cost . '.00</td>
                    <td>Rs. ' . $item->Cost * $item->Quantity . '.00</td>
                <tr>';
        }

        $html .=       '<tr>
                            <td colspan="3" class="costs">SUBTOTAL</td>
                            <td class="cost">Rs. '.$order_details->Total_amount.'.00</td>
                       </tr>
                        <tr>
                             <td colspan="3" class="costs">DELIVERY CHARGES</td>
                             <td class="cost">Rs. '.$order_details->Shipping_cost.'.00</td>
                        </tr>
                        <tr>
                             <td colspan="3" class="costs">DISCOUNTS</td>
                             <td class="cost">-Rs. '.$order_details->Discount_obtained.'.00</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="costs">TOTAL</td>
                            <td class="cost">Rs. '.$order_details->Total_amount + $order_details->Shipping_cost - $order_details->Discount_obtained.'.00</td>
                        </tr>
                    </table>

                    <div class="signature">
                        <h3>Thank you!</h3>
                        <img src="http://localhost/WoodWorks/public/assets/images/manager/NapoleonSignature2_1050x700.webp" alt="">
                        <p>Viharsha Jayathilake</p>
                        <p>Manager</p>
                    </div>

                </div>


            </body>
            </html>
        ';

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("invoice.pdf");
    }

    public function success()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $customer = new Customer();
        $order = new Orders();
        $order_items = new Order_items();

        $cart = new Carts();
        $id = Auth::getCustomerID();
        $data['row'] = $customer->where('CustomerID',$id);

        $session_id = $_GET['session_id'];
        $order_id = $order->checkIsPreparing($id)[0]->OrderID;


        $stripe =  new \Stripe\StripeClient(
            $_ENV['STRIPE_API_KEY']
        );

        try {
            $session = $stripe->checkout->sessions->retrieve($session_id);


            if(!$session){
                $this->redirect('_404');
            }

            $customer = $session->customer_details;
            $cus_order = $order->getOrderByTheOrderID($order_id)[0];

            if($session->id === $cus_order->SessionID){
                $order->updateSessionID($cus_order->OrderID,$session->id,'paid');
                $order->updateIsPreparing($cus_order->OrderID);
                $order_items->updateIsPurchased($cus_order->OrderID);
                $cart->resetCartTotal($cart->getCart($id)[0]->CartID);

                unset($_SESSION['cart']);

            }else{
                $this->redirect('_404');
            }

            $data['customer'] = $customer['name'];
            $data['order'] = $cus_order;
            $data['order_items'] = $order_items->getOrderItems($cus_order->OrderID);
            $data['orderId'] = $order_id;

            $this->view('checkout/success',$data);
        }
        catch (Exception $e)
        {
            $this->redirect('_404');
        }
    }

    public function cancel()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $this->view('checkout/cancel');
    }

}