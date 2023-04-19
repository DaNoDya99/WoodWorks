<?php

require '../vendor/autoload.php';
class Checkout extends Controller
{
    public function index()
    {
        $customer = new Customer();
        $id = Auth::getCustomerID();
        $data['row'] = $customer->where('CustomerID',$id);

        $this->view('checkout/success',$data);
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
        $inventory = new Product_Inventory();

        $cart = new Carts();
        $id = Auth::getCustomerID();
        $data['row'] = $customer->where('CustomerID',$id);

        $session_id = $_GET['session_id'];

        $stripe =  new \Stripe\StripeClient(
            'sk_test_51Mx3NxCIse71JEne0LK7axCWj4nwwxotGp7kDjehW2wfmvhSLgPMPkld8L6WdaAwj8CzkT4vhr801oJQ8s39YQ3100hKfDfWLG'
        );

        try {
            $session = $stripe->checkout->sessions->retrieve($session_id);

            if(!$session){
                $this->redirect('_404');
            }

            $customer = $session->customer_details;
            $cus_order = $order->getOrderByTheSessionID($session->id)[0];

            if(!empty($cus_order)){
                $order->updateSessionID($cus_order->OrderID,$session->id,'paid');
                $order->updateIsPreparing($cus_order->OrderID);
                $order_items->updateIsPurchased($cus_order->OrderID);
                $cart->resetCartTotal($cart->getCart($id)[0]->CartID);
//                $cus_order_items = $order_items->getOrderItems($cus_order->OrderID);

//                foreach($cus_order_items as $item){
//                    $inventory->updateQuantityToDecrease($item->ProductID,$item->Quantity);
//                }

                unset($_SESSION['cart']);

            }else{
                $this->redirect('_404');
            }

            $data['customer'] = $customer['name'];

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