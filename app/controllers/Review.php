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
        $reviews = new Reviews();
        $id = Auth::getCustomerID();
        $data['row'] = $customer->where('CustomerID',$id);
        $data['orderItems'] = $orderItems->getOrderItems($orderID);


        foreach ($data['orderItems'] as $item){
            $rate = $reviews->getProductRating($item->ProductID)[0]->Average;

            if($rate == null){
                $rate = 0;
                $rating = '0.0%';
            }else{
                $rating = round($rate/5*100);
                $rating = $rating.'%';
            }

            $item->Rate = $rate;
            $item->Rating = $rating;

            if($reviews->getProductReviews($item->ProductID,$id)){
                $data['reviews'][$item->ProductID] = $reviews->getProductReviews($item->ProductID,$id)[0];
            }
        }

        $this->view('reg_customer/review',$data);
    }

    public function save($productId)
    {
        if(!Auth::logged_in()){
            $this->redirect('login');
        }

        $_POST['CustomerID'] = Auth::getCustomerID();
        $_POST['ProductID'] = $productId;

        $review = new Reviews();

        if($review->getProductReviews($productId,$_POST['CustomerID'])){
            $review->updateReview($_POST,$productId,$_POST['CustomerID']);
        }else{
            $review->insert($_POST);
        }
    }
}