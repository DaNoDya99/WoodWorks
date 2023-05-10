<?php

class Driver extends Model
{
    public $errors = [];
    protected $table = "driver";

    protected $allowedColumns = [
        'DriverID',
        'Vehicle_type',
        'Availability',

    ];

    public function validate($post)
    {
        $this->errors = [];
        $availability[] = ['available','not available'];

        if (empty($post['Availability'])) {
            $this->errors['Availability'] = "Availability can not be empty";
        }
        else if(!in_array(strtolower($post['Availability']),$availability)){
            $this->errors['Availability'] = "Error occurred in availability";
        }
        if (empty($this->errors)) {
            return true;
        }

        return false;
    }


    public function update_type($DriverID,$data)
    {
        if (!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);
        $data['DriverID'] = $DriverID;

        $query = "update " . $this->table . " set ";
        foreach ($keys as $key) {
            $query .= $key . "=:" . $key . ",";
        }
        $query = trim($query, ",");
        $query .= " where DriverID = :DriverID";

        $this->query($query, $data);
    }

    public function availableDrivers()
    {
        $query = "SELECT * FROM $this->table WHERE Availability = :Availability;";

        return $this->query($query,['Availability' => 'Available']);
    }

    public function getAssignedOrderCount($id)
    {
        $query = "SELECT COUNT(OrderID) AS Count FROM orders WHERE DriverID = :DriverID;";

        return $this->query($query,['DriverID' => $id]);
    }

}
