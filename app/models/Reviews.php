<?php

class Reviews extends Model
{
    public $errors = [];
    protected $table = "ratings";

    protected $allowedColumns = [

        'RateID',
        'Rating',
        'Reviews',
        'CustomerID',
        'ProductID'
    ];

    public function getReview($fields = null,$id = null){

        $query = "select ";

        foreach ($fields as $field){
          $query .= $field.", ";
        }

        $query = trim($query,", ");
        $query .= " from ".$this->table." INNER JOIN customer ON ".$this->table.".CustomerID = customer.CustomerID WHERE ".$this->table.".ProductID = '$id';";

//        show($query);die;
        return $this->query($query);
    }
}