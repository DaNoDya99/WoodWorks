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

    public function getNewFurniture($fields = null,$limit = 2,$order = 'asc')
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

}