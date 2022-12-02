<?php

class Furniture extends Controller
{
    public function index(){

        if(!Auth::logged_in())
        {
            $this->redirect('login1');
        }

    }

    public function view_product($id = null){

        if(!Auth::logged_in())
        {
            $this->redirect('login1');
        }

        $customer = new Customer();
        $cus_id = Auth::getCustomerID();


        $allowedCols = [
            'ratings.Rating',
            'ratings.Reviews',
            'ratings.Date',
            'customer.Firstname',
            'customer.Lastname',
            'customer.Image'

        ];

        $furniture = new Furnitures();
        $review = new Reviews();

        $data['row'] = $customer->where('CustomerID',$cus_id);
        $data['furniture'] = $furniture->viewFurniture($id);
        $data['reviews'] = $review->getReview($allowedCols,$id);
        $data['images'] = $furniture->getAllImages($id);

        $this->view("reg_customer/product", $data);
    }

    public function edit($id = null)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login1');
        }
    }

    public function remove($id = null)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login1');
        }

        $furniture = new Furnitures();
        $furniture->deleteFurniture($id);

        $this->redirect('admin/inventory');
    }
}