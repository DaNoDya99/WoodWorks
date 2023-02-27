<?php

class Orders extends Model
{
    public $errors = [];
    protected $table = "orders";

    protected $allowedColumns = [
        'OrderID',
       	'Firstname',
        'Lastname',
        'Email',
        'Contactno',
        'Payment_type',
        'Total_amount',
        'Date',
        'Deliver_method',
        'Order_status',
        'Vehicle_type',
        'Address',
        'CustomerID',
        'DriverID',
        'Is_preparing'
    ];

    public function findOrders($column,$value)
    {
        $query = "select * from $this->table where $column = :value order by DATE desc limit 4";
        return $this->query($query,['value'=>$value]);
    }

    public function displayOrders($column,$value)
    {
        $query = "select * from $this->table WHERE `Deliver_method` = 'Delivery' && $column = :value ";
        return $this->query($query,['value'=>$value]);
    }

    public function searchOrdersDetails($column,$value,$orders_items)
    {
        $query = "select * from $this->table  WHERE DATE_FORMAT(Date, '%d/%m/%Y') like '%$orders_items%'  or Payment_type like '%$orders_items%' or Address like '%$orders_items%' or Total_amount like '%$orders_items%' AND $column = :value LIMIT 15 ";
        return $this->query($query,['value'=>$value]);

    }

    public function filterStatus($column,$value,$id)
    {
        $query = "select OrderID,Payment_type,Total_amount,Order_status,Address,Firstname,Lastname,Contactno,Date from $this->table  WHERE `Deliver_method` = 'Delivery' && $column = :value  && `DriverID` = '$id' limit 15";
        return $this->query($query,['value'=>$value]);
    }

    public function pieGraph()
    {
        $query = "SELECT COUNT(OrderID) AS numOrders,Order_status FROM $this->table GROUP BY Order_status ";
        return $this->query($query);
    }

    public function barGraph()
    {
        $query = "SELECT cast(Date as date) AS Date, count(OrderID) AS numOrders FROM $this->table WHERE NOT Order_status = 'delivered' GROUP BY cast(Date as date)";
        return $this->query($query);
    }

    public function update_status($OrderID,$data)
    {
        if(!empty($this->allowedColumns))
        {
            foreach ($data as $key => $value){
                if(!in_array($key,$this->allowedColumns))
                {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);
        //$OrderID = array_search($OrderID,$data);
        $data['OrderID'] = $OrderID;

        $query = "update ".$this->table." set ";
        foreach ($keys as $key)
        {
            $query .= $key . "=:" . $key . ",";
        }
        $query = trim($query,",");
        $query .= " where OrderID = :OrderID";

        $this->query($query,$data);
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