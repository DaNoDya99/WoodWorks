<?php

class Customer extends Model
{
    public $errors = [];
    protected $table = "customer";

    protected $allowedColumns = [
        'CustomerID',
        'Firstname',
        'Lastname',
        'Gender',
        'Email',
        'Password',
        'Address',
        'Mobileno'
    ];

    protected $beforeInsert = [
        'make_customer_id',
        'hash_password'
    ];

    public function validate($post): bool
    {
        return true;
    }

    public function make_customer_id($DATA){

        $customerID = $this->random_string(60);
        $result = $this->where('CustomerID',$customerID);
        while ($result){
            $result = $this->where('CustomerID',$customerID);
            $customerID = $this->random_string(60);
        }

        $DATA['CustomerID'] = $customerID;

        return $DATA;
    }

    public function hash_password($DATA){
        $DATA['Password'] = password_hash($DATA['Password'],PASSWORD_DEFAULT);
        return $DATA;
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