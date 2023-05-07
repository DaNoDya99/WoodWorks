<?php

class Company_order_items extends Model
{
    protected $table = "company_order_items";
    public $errors = [];

    protected $allowedColumns = [
        'OrderID',
        'ProductID',
        'Quantity',
    ];

    public function insertItem($id,$productID, $quantity)
    {
        $query = "insert into $this->table (OrderID, ProductID, Quantity) values (:OrderID, :ProductID, :Quantity)";
        $data = [
            'OrderID' => $id,
            'ProductID' => $productID,
            'Quantity' => $quantity,
        ];
        return $this->query($query, $data);
    }

    public function getOrderItems($id)
    {
        $query = "select * from $this->table where OrderID = :OrderID";
        $data = [
            'OrderID' => $id,
        ];
        return $this->query($query, $data);
    }

    public function updateQuantities($id,$productID, $quantities)
    {
        $query = "update $this->table set Quantity = :Quantity where OrderID = :OrderID and ProductID = :ProductID";

        $data = [
            'OrderID' => $id,
            'ProductID' => $productID,
            'Quantity' => $quantities,
        ];

        return $this->query($query, $data);
    }
}