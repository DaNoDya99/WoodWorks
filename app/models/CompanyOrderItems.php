<?php

class CompanyOrderItems extends Model
{
    protected $table = "company_order_items";
    public $errors = [];

    protected $allowedColumns = [
        'OrderID',
        'ProductID',
        'Quantity',
    ];

    public function getItemsByOrderID($id)
    {
        $query = "select * from $this->table where OrderID = :OrderID";
        $data = [
            'OrderID' => $id,
        ];
        return $this->query($query, $data);
    }
}
?>