<?php

class Review extends Controller
{
    public function index()
    {

    }

    public function addReview($orderID)
    {
        if(!Auth::logged_in()){
            $this->redirect('login');
        }

        $customer = new Customer();
        $orderItems = new Order_items();
        $id = Auth::getCustomerID();
        $data['row'] = $customer->where('CustomerID',$id);
        $data['orderItems'] = $orderItems->getOrderItems($orderID);

        $this->view('reg_customer/review',$data);
    }
}