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

    public function validate($data)
    {
        $this->errors = [];

        if (empty($data['ProductID'])) {
            $this->errors['ProductID'] = 'ProductID is required';
        }elseif (!preg_match('/^[A-Z0-9]*$/', $data['ProductID'])) {
            $this->errors['ProductID'] = 'ProductID must be the format of P0001';
        }

        if (empty($data['Quantity'])) {
            $this->errors['Quantity'] = 'Quantity is required';
        } elseif (preg_match('/[^0-9]/', $data['Quantity'])) {
            $this->errors['Quantity'] = 'Quantity must be numbers only';
        }

        if (empty($data['Reorder_point'])) {
            $this->errors['Reorder_point'] = 'Reorder point is required';
        } elseif (preg_match('/[^0-9]/', $data['Reorder_point'])) {
            $this->errors['Reorder_point'] = 'Reorder point must be numbers only';
        }

        if (empty($data['Cost'])) {
            $this->errors['Cost'] = 'Cost is required';
        } elseif (preg_match('/[^0-9.]/', $data['Cost'])) {
            $this->errors['Cost'] = 'Cost must be numbers only';
        }

        if (empty($data['Retail_price'])) {
            $this->errors['Retail_price'] = 'Retail price is required';
        } elseif (preg_match('/[^0-9.]/', $data['Retail_price'])) {
            $this->errors['Retail_price'] = 'Retail price must be numbers only';
        }

        $status = ['In Stock', 'Out of Stock'];

        if (empty($data['Status'])) {
            $this->errors['Status'] = 'Status is required';
        } elseif (!in_array($data['Status'], $status)) {
            $this->errors['Status'] = 'Status must be In Stock or Out of Stock';
        }

        if(empty($data['Created_at'])) {
            $this->errors['Created_at'] = 'Created at is required';
        } elseif (!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $data['Created_at'])) {
            $this->errors['Created_at'] = 'Created at must be the format of YYYY-MM-DD';
        }

        if(empty($data['Updated_at'])) {
            $this->errors['Updated_at'] = 'Updated at is required';
        } elseif (!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $data['Updated_at'])) {
            $this->errors['Updated_at'] = 'Updated at must be the format of YYYY-MM-DD';
        }


        if(empty($this->errors)) {
            return true;
        } else {
            return false;
        }
    }

    public function searchInventoryProductByID($id): false|array
    {
        $query = "SELECT * FROM $this->table WHERE ProductID = :ProductID;";

        return $this->query($query,['ProductID' => $id]);
    }

    public function getAllFromInventory(): false|array
    {
        $query = "SELECT * FROM $this->table";

        return $this->query($query);
    }

    public function deleteInvProduct($id): false|array
    {
        $query = "DELETE FROM $this->table WHERE ProductID = :ProductID;";

        return $this->query($query,['ProductID' => $id]);
    }

    public function updateQuantityToDecrease($ProductID,$Quantity)
    {
        $query = "UPDATE $this->table SET Quantity = Quantity - :Quantity WHERE ProductID = :ProductID; ";

        $data = [
            'Quantity' => $Quantity,
            'ProductID' => $ProductID
        ];

        return $this->query($query, $data);
    }

    public function updateQuantityToIncrease($ProductID,$Quantity)
    {
        $query = "UPDATE $this->table SET Quantity = Quantity + :Quantity WHERE ProductID = :ProductID; ";

        $data = [
            'Quantity' => $Quantity,
            'ProductID' => $ProductID
        ];

        return $this->query($query, $data);
    }

    public function getProductQuantity($ProductID)
    {
        $query = "SELECT Quantity FROM $this->table WHERE ProductID = :ProductID;";

        return $this->query($query,['ProductID' => $ProductID]);
    }
}