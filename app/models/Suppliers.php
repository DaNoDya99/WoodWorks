<?php

class Suppliers extends Model
{
    protected $table = "supplier";
    public $errors = [];

    protected $allowedColumns = [
        'SupplierID',
        'Firstname',
        'Lastname',
        'Email',
        'Password',
        'Contactno',
        'Company_name',
    ];
    public function validate($data)
    {
        $this->errors = [];

        if (!filter_var($data['Email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['Email'] = "Email is not valid";
        } else if ($this->where(['Email' => $data['Email']])) {
            $this->errors['Email'] = "A email already exists";
        }
        if (empty($data['Firstname'])) {
            $this->errors['Firstname'] = "A first name is required";
        }
        if (empty($data['SupplierID'])) {
            $this->errors['SupplierID'] = "An Employee ID is required ";
        }
        if (empty($data['Lastname'])) {
            $this->errors['Lastname'] = "A last name is required";
        }
        if (!empty($data['Password'])) {
            if ($data['Password'] != $data['conpassword']) {
                $this->errors['Password'] = "Passwords do not match";
            }
        } else {
            $this->errors['Password'] = "A password is required";
        }
        if (empty($data['Contactno'])) {
            $this->errors['Contactno'] = "A contact number is required";
        }
        if (empty($this->errors)) {
            return true;
        }
        return false;
    }
}
