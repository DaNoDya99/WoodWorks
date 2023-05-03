<?php
class Advertisements extends model
{
    public $errors = [];
    protected $table = "advertisement";

    protected  $allowedColumns = [
        'AdvertisementID',
        'Date',
        'Product_name',
        'Quantity',
        'Description',
        'Price',
        'Manager'                  
    ];

    public function validate($post){
        $this->errors = [];

        if(empty($post['AdvertisementID'])){
            $this->errors['AdvertisementID'] = "Product ID is required.";
        }elseif(!preg_match("/^[A-Z0-9]+$/",trim($post['AdvertisementID']))){
            $this->errors['AdvertisementID'] = "Product ID should only have capital letters and numbers.";
        }

        if(empty($post['Product_name'])){
            $this->errors['Product_name'] = "Product name is required.";
            
        }elseif(!preg_match("/^[A-Za-z ]+$/",trim($post['Product_name']))){
            $this->errors['Product_name'] = "Product name should only have letters.";
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

    public function insertImages($productID, $images)
    {
        $query = "insert into advertisements_image (`AdvertisementID`, `Image`) values ('$productID','$images[0]'),('$productID','$images[1]'),('$productID','$images[2]');";

        return $this->query($query);
    }

    public function getDisplayImage($AdvertisementID = null)
    {
        $query = "select Image from advertisements_image where AdvertisementID = :AdvertisementID && Image like '%primary%';";

        return $this->query($query, ['AdvertisementID' => $AdvertisementID]);//define :AdvertisementID
    }

    public function getSecondaryImages($AdvertisementID = null)
    {
        $query = "select Image from advertisements_image where AdvertisementID = :AdvertisementID && Image not like '%primary%';";

        return $this->query($query, ['AdvertisementID' => $AdvertisementID]);//define :AdvertisementID
    }

    public function getReFurDetails()
    {
        $query = "SELECT * FROM `advertisement`;";
        return $this->query($query);
    }

    public function getRefurnishedFurniture($id = null)
    {
        $query = "select * from advertisement where AdvertisementID = :AdvertisementID;";
        return $this->query($query,['AdvertisementID' => $id]);
    }

    public function getRefurnishedFurnitureImages($id = null)
    {
        $query = "select Image from advertisements_image where AdvertisementID = :AdvertisementID;";
        return $this->query($query,['AdvertisementID' => $id]);
    }

    public function getRefurnishedFurnityreById($id = null)
    {
        $query = "SELECT * FROM $this->table WHERE AdvertisementID = :AdvertisementID;";
        return $this->query($query,['AdvertisementID' => $id]);
    }

    public function getSoldOutRefurnishedProducts()
    {
        $query = "SELECT * FROM $this->table WHERE Quantity = 0;";

        return $this->query($query);
    }
}