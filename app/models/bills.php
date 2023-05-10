<?php

class Bills extends Model
{
    public $errors = [];
    protected $table = "bill";

    protected $allowedColumns = [
        'BillID',
        'cashierID',
        'Date',
        'billClosed',
        'billtotal',
        'discounts',
        'promoCode',
        'CustomerID',
        'OrderID'
    ];

    public function createBill($customerID)
    {
        $query = "INSERT INTO $this->table (billID,cashierID,CustomerID) VALUES (:billID,:cashierID,:CustomerID)";
        $data = [
            'billID' => $this->make_bill_id(),
            'cashierID' => $_SESSION['USER_DATA']->EmployeeID,
            'CustomerID' => $customerID
        ];

        return $this->query($query, $data);
    }

    public function make_bill_id()
    {

        $billID = $this->random_string(10);
        $result = $this->where('billID', $billID);
        while ($result) {
            $result = $this->where('billID', $billID);
            $orderID = $this->random_string(10);
        }

        return $billID;
    }

    public function random_string($length)
    {
        $array = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
        $text = "";
        for ($x = 0; $x < $length; $x++) {
            $random = rand(0, 61);
            $text .= $array[$random];
        }

        return $text;
    }
}
