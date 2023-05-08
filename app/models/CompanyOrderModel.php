<?php

class CompanyOrderModel extends Model
{
    public $errors = [];
    protected $table = "company_order";
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
//            'SupplierID' => Auth::getSupplierID(),
            'SupplierID' => 'S0001',
        ];
        return $this->query($query, $data);
    }

    public function getAllOrders()
    {
        $query = "select * from $this->table where SupplierID = :SupplierID";
        $data = [
            'SupplierID' => 'S0001'
        ];
        return $this->query($query, $data);
    }

    public function findOrder($id)
    {
        $query = "select * from $this->table where OrderID = :OrderID";
        $data = [
            'OrderID' => $id,
        ];
        if ($this->query($query, $data)) {
            return $this->query($query, $data)[0];
        } else {
            return false;
        }
    }

    public function changeOrderStatus($id, $status)
    {
        if ($status == 'accepted') {
            $query = "update $this->table set OrderStatus = :OrderStatus, Accepted_date = :Accepted_date where OrderID = :OrderID";
            $data = [
                'OrderStatus' => $status,
                'OrderID' => $id,
                'Accepted_date' => date('Y-m-d'),

            ];
        } else {
            $query = "update $this->table set OrderStatus = :OrderStatus where OrderID = :OrderID";
            $data = [
                'OrderStatus' => $status,
                'OrderID' => $id,
            ];
        }

        return $this->query($query, $data);
    }
}
