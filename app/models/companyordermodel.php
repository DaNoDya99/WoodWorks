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
        'ProductID',
        'Comments',
        'Quantity',
    ];

    public function getacceptedorders()
    {
        $query = "select * from $this->table where OrderStatus = :OrderStatus1 OR OrderStatus= :OrderStatus2 and SupplierID = :SupplierID ORDER by Date DESC";
        $data = [
            'OrderStatus1' => 'accepted',
            'OrderStatus2' => 'complete',
            'SupplierID' => Auth::getSupplierID(),
        ];
        return $this->query($query, $data);
    }
    public function getneworders()
    {
        $query = "select * from $this->table where OrderStatus = :OrderStatus and SupplierID = :SupplierID";
        $data = [
            'OrderStatus' => 'pending',
            'SupplierID' => Auth::getSupplierID(),
        ];
        return $this->query($query, $data);
    }
}
