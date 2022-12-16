<?php

class CompanyOrderModel extends Model
{
    protected $table = "company_order";
    public $errors = [];

    protected $allowedColumns = [
        'OrderID',
        'OrderStatus',
        'Date',
        'ManagerID',
        'SupplierID',
    ];

}
