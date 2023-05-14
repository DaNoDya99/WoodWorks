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

    public function getAllRespondedOrders()
    {
        $query = "select * from $this->table where OrderStatus = :OrderStatus1 OR OrderStatus= :OrderStatus2 OR OrderStatus= :OrderStatus3 OR OrderStatus= :OrderStatus4 and SupplierID = :SupplierID ORDER by Responded_date DESC";
        $data = [
            'OrderStatus1' => 'Accepted',
            'OrderStatus2' => 'Recieved',
            'OrderStatus3' => 'Rejected',
            'OrderStatus4' => 'Completed',
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

    public function generateOrderID()
    {
        $prefix = 'COM-ODR';
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

    public function updateComment($id, $comment)
    {
        $query = "UPDATE $this->table SET Comments = :Comments WHERE OrderID = :OrderID";
        $data = [
            'OrderID' => $id,
            'Comments' => $comment,
        ];
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

    public function changeOrderStatus($id, $status, $reason = null)
    {
        if ($status == 'Accepted') {
            $query = "update $this->table set OrderStatus = :OrderStatus, Responded_date = :Responded_date where OrderID = :OrderID";
            $data = [
                'OrderStatus' => $status,
                'OrderID' => $id,
                'Responded_date' => date('Y-m-d H:i:s'),

            ];
        } else if ($status == 'Rejected') {
            $query = "update $this->table set OrderStatus = :OrderStatus, Responded_date = :Responded_date, Reason_for_rejection= :Reason where OrderID = :OrderID";
            $data = [
                'OrderStatus' => $status,
                'OrderID' => $id,
                'Responded_date' => date('Y-m-d H:i:s'),
                'Reason' => $reason['reason'],

            ];
        } else if ($status == 'Completed') {
            $query = "update $this->table set OrderStatus = :OrderStatus, Completed_date = :Completed_date where OrderID = :OrderID";
            $data = [
                'OrderStatus' => $status,
                'OrderID' => $id,
                'Completed_date' => date('Y-m-d H:i:s'),
            ];
        }
        return $this->query($query, $data);
    }
}
