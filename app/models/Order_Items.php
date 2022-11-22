<?php

class Order_Items extends Model
{
    public $errors = [];
    protected $table = "order_item";

    protected $allowedColumns = [
        'ProductID',
        'Name',
        'Quantity',
        'Cost',
        'OrderID',
        'CartID',
        'Image'
    ];

    public function getCustomerCartDetails($cart_id)
    {
        $query = "select * from $this->table where CartID = :CartID;";

        return $this->query($query,['CartID' => $cart_id]);
    }
}