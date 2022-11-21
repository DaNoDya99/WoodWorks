<?php

class Cart extends Controller
{
    private function getUser()
    {
        $customer = new Customer();
        $id = Auth::getCustomerID();
        return $customer->where('CustomerID',$id);
    }

    public function index()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $data['row'] = $this->getUser();

        $this->view('reg_customer/cart',$data);
    }
}