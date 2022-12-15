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

        return $this->query($query);
    }

    public function getReviewsForManager($id)
    {
        $query = "select Rating, Reviews, Date from $this->table where ProductID = :ProductID;";

        return $this->query($query, ['ProductID'=>$id]);
    }
}