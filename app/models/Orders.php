<?php

class Orders extends Model
{
    public $errors = [];
    protected $table = "orders";

    protected $allowedColumns = [
        'OrderID',
        'Payment_type',
        'Total_amount',
        'Date',
        'Deliver_method',
        'Order_status',
        'Address',
        'CustomerID',
        'DriverID',
        'Is_preparing'
    ];

    public function findOrders($column,$value)
    {
        $query = "select * from $this->table where $column = :value order by DATE desc limit 10";
        return $this->query($query,['value'=>$value]);
    }

    public function checkIsPreparing($id)
    {
        $query = "select OrderID from $this->table where CustomerID = :CustomerID && Is_preparing = :Is_preparing;";

        return $this->query($query,['CustomerID' => $id, 'Is_preparing' => 1]);
    }

    public function setOrder($id)
    {
        $data = [
            'OrderID' => $this->make_order_id(),
            'Is_preparing' => 1,
            'CustomerID' => $id
        ];

        $this->insert($data);
        return $data['OrderID'];
    }


    public function make_order_id(){

        $orderID = $this->random_string(60);
        $result = $this->where('OrderID',$orderID);
        while ($result){
            $result = $this->where('OrderID',$orderID);
            $orderID = $this->random_string(60);
        }

        return $orderID;
    }

    public function random_string($length){
        $array = array(0,1,2,3,4,5,6,7,8,9,'A','B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
        $text = "";
        for($x=0;$x<$length;$x++)
        {
            $random = rand(0,61);
            $text .= $array[$random];
        }

        return $text;
    }
}