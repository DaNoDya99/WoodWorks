<?php
class Advertisements extends model
{
    public $errors = [];
    protected $table = "advertisement";

    protected  $allowedColumns = [
        'AdvetisementID',
        'Date',
        'Product_name',
        'CategoryID',
        'Sub_category_name',
        'Quantity',
        'Description',
        'Price',
        'ManagerID'                  
    ];

    protected $beforeInsert = [
        'make_advertisement_id'
    ];

    public function validate($post){
        $this->errors = [];

        if(empty($post['Product_name'])){
            $this->errors['Product_name'] = "Product name is required.";
            
        } 

        if(empty($post['CategoryID'])){
            $this->errors['CategoryID'] = "Category ID is required.";

        }

        if(empty($post['Sub_category_name'])){
            $this->errors['Sub_category_name'] = "Subcategory name is required.";
        }

        if(empty($post['Quantity']))
        {
            $this->errors['Quantity'] = "Quantity is required.";
        }elseif(!preg_match("/^[0-9]+$/",trim($post['Quantity']))){
            $this->errors['Quantity'] == "Quantity should only have numbers";
        }

        if(empty($post['Description']))
        {
            $this->errors['Description'] = "Description is required.";
        }

        if(empty($post['Price']))
        {
            $this->errors['Price'] = "Price is required.";
        }elseif(!preg_match("/^[0-9]+$/",trim($post['Price']))){
            $this->errors['Price'] == " Price should only have numbers";
        }

        if(empty($this->errors)){
            return true;
        }
        return false;

    }

    public function make_advertisement_id($DATA){

        $advertisementID = $this->random_string(60);
        $result = $this->where('AdvertisementID',$advertisementID);
        while ($result){
            $advertisementID = $this->random_string(60);
            $result = $this->where('AdvertisementID',$advertisementID);   
        }

        $DATA['AdvertisementID'] = $advertisementID;

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

    // public function viewAdvertisement($id = null)
    // {
    //     $query = "select ";

    //     $fields = [
    //         'AdvetisementID',
    //         'Date',
    //         'Product_name',
    //         'CategoryID',
    //         'Sub_category_name',
    //         'Quantity',
    //         'Description',
    //         'Price',
    //         'ManagerID' 

    //     ];

    //     if(!empty($fields)){
    //         foreach ($fields as $field){
    //             $query .= $field.", ";
    //         }
    //     }

    //     $query = trim($query,", ");
    //     $query .= " from ".$this->table." where AdvetisementID = '$id'";

    //     return $this->query($query);
    // }


    
}