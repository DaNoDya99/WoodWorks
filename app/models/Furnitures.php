<?php

class Furnitures extends Model
{
    public $errors = [];
    protected $table = "furniture";

    protected $allowedColumns = [
	    'ProductID',
        'Name',
        'Category',
        'Description',
        'Quantity',
        'Cost',
        'Visibility',
        'Availability',
        'Warrenty_period',
        'Wood_type ',
        'Discount_percentage',
        'SupplierID',
        'Discount_given_by',
        'Date'
    ];

    public function getNewFurniture($fields = null,$limit = 5,$order = 'asc')
    {
        $query = "select ";

        if(!empty($fields)){
            foreach ($fields as $field){
                $query .= $field.", ";
            }
        }

        $query = trim($query,", ");

        $query .= " from ".$this->table." order by date $order limit $limit";

        return $this->query($query);
    }

    public function viewFurniture($id = null)
    {
        $query = "select ";

        $fields = [
            'ProductID',
            'Name',
            'Description',
            'Quantity',
            'Cost',
            'Availability',
            'Warrenty_period',
            'Wood_type ',
            'Discount_percentage'
        ];

        if(!empty($fields)){
            foreach ($fields as $field){
                $query .= $field.", ";
            }
        }

        $query = trim($query,", ");
        $query .= " from ".$this->table." where ProductID = '$id'";

        return $this->query($query);
    }

    public function getFurnitures($category = null,$sub_cat,$limit = 2,$offset)
    {
        $query = "select ProductID, Name , Cost from furniture WHERE CategoryID = '$category' && Sub_category_name = '$sub_cat' limit $limit offset $offset; ";

        return $this->query($query);
    }

    public function getFurniture($id){

        $query = "select Name , Cost from furniture WHERE ProductID = :ProductID; ";

        return $this->query($query,['ProductID' => $id]);
    }

    public function getDisplayImage($ProductId = null)
    {
        $query = "
             WITH cte as
             (
                 SELECT *,
                  ROW_NUMBER()
                  OVER (PARTITION BY ProductID) AS rn
               FROM furniture_image WHERE ProductID = '$ProductId'
             )
            select * from cte
            where rn = 1  
        ";

        return $this->query($query);
    }

    public function getAllImages($id)
    {
        $query = "select Image from furniture_image WHERE ProductID = '$id';";

        return $this->query($query);
    }
}