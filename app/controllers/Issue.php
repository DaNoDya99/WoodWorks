<?php

class Issue extends Controller
{
    public function index(){

    }
    
    // public function get_issue_details($id=null)
    // {
    //     if(!Auth::logged_in())
    //     {
    //         $this->redirect('login');
    //     }

    //     // $issue = new Issues();
    //     // $data['issues'] = $issue->getIssuesDetails($id);

    //     $this->view('manager/issuedetails');
        

    // }

    public function get_order_details($orderID=null)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $order_items = new Order_Items();
        $orders = new Orders();


        // $items = $order_items->getOrderItems($orderID);
        // $details = $orders->deliveryOrderDetails($orderID)[0];
        $data['row'] = $row = $orders->where('OrderID',$orderID);

        $data['items'] = $order_items->getOrderItems($orderID);
        

        $this->view('manager/issuedetails',$data);


    }
    
    
}

