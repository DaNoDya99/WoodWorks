<?php

class Order extends Model
{
    public $errors = [];
    protected $table = "order";

    protected $allowedColumns = [
        'OrderID',
        'Payment_type',
        'Total_amount',
        'Date',
        'Delivery_method',
        'Order_status',
        'Address',
        'CustomerID',
        'DriverID',

    ];


}