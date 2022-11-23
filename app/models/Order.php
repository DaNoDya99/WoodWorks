<?php

class Order extends Model
{
    public $errors = [];
    protected $table = "orders";

    protected $allowedColumns = [
        'OrderID',
        'PaymentType',
        'TotalAmount',
        'Date',
        'DeliveryMethod',
        'OrderStatus',
        'Address',
        'CustomerID',
        'DriverID',

    ];

//    protected $beforeInsert = [
//        'make_order_id',
//    ];
//
//    public function validate($post)
//    {
//        $this->errors = [];
//        $availability[] = ['available','not available'];
//
//        if (empty($post['Availability'])) {
//            $this->errors['Availability'] = "Availability can not be empty";
//        }
//        else if(!in_array(strtolower($post['Availability']),$availability)){
//            $this->errors['Availability'] = "Error occurred in availability";
//        }
//        if (empty($this->errors)) {
//            return true;
//        }
//
//        return false;
//    }

//    public function make_order_id($DATA){
//
//        $orderID = $this->random_string(60);
//        $result = $this->where('OrderID',$orderID);
//        while ($result){
//            $result = $this->where('OrderID',$orderID);
//            $customerID = $this->random_string(60);
//        }
//
//        $DATA['OrderID'] = $orderID;
//
//        return $DATA;
//    }
//
//    public function random_string($length){
//        $array = array(0,1,2,3,4,5,6,7,8,9,'A','B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
//        $text = "";
//        for($x=0;$x<$length;$x++)
//        {
//            $random = rand(0,61);
//            $text .= $array[$random];
//        }
//
//        return $text;
//    }

}