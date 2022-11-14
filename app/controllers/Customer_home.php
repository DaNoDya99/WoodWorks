<?php
require "../app/models/Auth.php";
require "../app/models/Customer.php";

class Customer_home extends Controller
{
    public function index()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login1');
        }

        $furniture = new Furnitures();
        $data['rows'] = $furniture->getNewFurniture(['ProductID','Name','Cost']);

        $this->view('reg_customer/customer_home',$data);
    }

    public function profile($id = null){

        if(!Auth::logged_in()){
            $this->redirect('login1');
        }

        $customer = new Customer();

        $id = Auth::getCustomerID();
        $data['row'] = $customer->where('CustomerID',$id);

        $this->view('reg_customer/profile',$data);
    }
}