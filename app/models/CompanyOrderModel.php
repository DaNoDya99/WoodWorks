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
        'Comments',
        'Completed_date',
        'Reason_for_rejection',
        'Responded_date',
        'Received_date',
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
    public function generateOrderID() {
        $prefix = 'COM-ORD';
        $unique_id = mt_rand(1000, 9999);
        $timestamp = substr(date('YmdHis'), 8, 6);
        return $prefix . '-' . $unique_id . '-' . $timestamp;
    }

    public function getSupplierOrdersByStatus($status)
    {
        $query = "SELECT * FROM $this->table WHERE OrderStatus = :OrderStatus";

        $data = [
            'OrderStatus' => $status,
        ];

        return $this->query($query, $data);
    }

    public function deleteOrder($id)
    {
        $query = "DELETE FROM $this->table WHERE OrderID = :OrderID";
        $data = [
            'OrderID' => $id,
        ];

        return $this->query($query, $data);
    }

    public function orderReceived($id)
    {
        $query = "UPDATE $this->table SET OrderStatus = :OrderStatus, Received_date = :Received_date WHERE OrderID = :OrderID";
        $data = [
            'OrderStatus' => 'received',
            'OrderID' => $id,
            'Received_date' => date('Y-m-d H:i:s'),
        ];

        return $this->query($query, $data);
    }

    public function getOrder($id)
    {
        $query = "SELECT * FROM $this->table WHERE OrderID = :OrderID";
        $data = [
            'OrderID' => $id,
        ];

        return $this->query($query, $data);
    }

    public function updateComment($id,$comment)
    {
        $query = "UPDATE $this->table SET Comments = :Comments WHERE OrderID = :OrderID";
        $data = [
            'OrderID' => $id,
            'Comments' => $comment,
        ];

        return $this->query($query, $data);
    }
}
