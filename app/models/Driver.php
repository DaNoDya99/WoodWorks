<?php

class Driver extends Model
{
    public $errors = [];
    protected $table = "driver";

    protected $allowedColumns = [
        'DriverID',
        'Firstname',
        'Lastname',
        'Gender',
        'Email',
        'Password',
        'Address',
        'Mobileno',
    ];

    protected $beforeInsert = [ // doubt
        'make_customer_id',
        'hash_password'
    ];

    public function validate($post)
    {
        $this->errors = [];
        $gender = ['Male','Female'];

        if(empty($post['Firstname'])){ // do i need to add these errors ??
            $this->errors['Firstname'] = "A first name is required.";
        }elseif (!preg_match("/^[a-zA-Z]+$/",trim($post['Firstname']))){ // doubt
            $this->errors['Firstname'] = "First name can only have letters.";
        }

        if(empty($post['Lastname'])){
            $this->errors['Lastname'] = "A last name is required.";
        }elseif (!preg_match("/^[a-zA-Z]+$/",trim($post['Lastname']))){
            $this->errors['Lastname'] = "Last name can only have letters.";
        }

        if(!in_array($post['Gender'],$gender)){
            $this->errors['Gender'] = "Gender is required.";
        }

        if(!filter_var($post['Email'],FILTER_VALIDATE_EMAIL)){
            $this->errors['Email'] = "Email is not valid.";
        }elseif($this->where('Email',$post['Email'])){
            $this->errors['Email'] = "Email already exist.";
        }

        if(empty($post['Password'])){
            $this->errors['Password'] = "Password is required.";
        }elseif ($post['Password'] !== $post['Password2']){
            $this->errors['Password'] = "Passwords do not match.";
        }

        if(empty($post['Mobileno'])){
            $this->errors['Mobileno'] = "Contact number required.";
        }elseif (!preg_match("/^[0-9]+$/",trim($post['Mobileno']))){
            $this->errors['Mobileno'] = "Contact number can only have numbers.";
        }

        if(empty($this->errors)){
            return true;
        }

        return false;
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