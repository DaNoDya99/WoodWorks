<?php

class Product_Inventory extends Model
{
    protected $table = "inventory";
    public $errors = [];
    protected $allowedColumns = [
        'ProductID',
        'Quantity',
        'Reorder_point',
        'Reorder_flag',
        'Last_ordered',
        'Last_received',
        'Cost',
        'Retail_price',
        'Status',
        'Created_at',
        'Updated_at',
    ];

}