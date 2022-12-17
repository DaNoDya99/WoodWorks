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
        'Image'
    ];

    protected $beforeInsert = [
        'hash_password',
    ];
    public function validate($data)
    {
        $this->errors = [];

        if (empty($data['Firstname'])) {
            $this->errors['Firstname'] = 'First name is required';
        }elseif(preg_match('/[^a-zA-Z]/', $data['Firstname'])){
            $this->errors['Firstname'] = 'First name must be letters only';
        }

        if (empty($data['Lastname'])) {
            $this->errors['Lastname'] = 'Last name is required';
        }elseif(preg_match('/[^a-zA-Z]/', $data['Lastname'])){
            $this->errors['Lastname'] = 'Last name must be letters only';
        }

        if (empty($data['Email'])) {
            $this->errors['Email'] = 'Email is required';
        }elseif (!filter_var($data['Email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['Email'] = 'Email is invalid';
        }elseif($this->where('Email', $data['Email'])){
            $this->errors['Email'] = 'Email already exists';
        }

        if (empty($data['Password'])) {
            $this->errors['Password'] = 'Password is required';
        }elseif (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/", trim($data['Password']))) {
            $this->errors['Password'] = "Password must contain at least 8 characters, at least one uppercase letter, one lowercase letter, one number and one special character.";
        }

        if (empty($data['Contactno'])) {
            $this->errors['Contactno'] = 'Contact number is required';
        }elseif(preg_match('/[^0-9]/', $data['Contactno'])){
            $this->errors['Contactno'] = 'Contact number must be numbers only';
        }

        if (empty($data['Company_name'])) {
            $this->errors['Company_name'] = 'Company name is required';
        }

        if (empty($this->errors)) {
            return true;
        }
        return false;
    }

    public function hash_password($DATA){
        $DATA['Password'] = password_hash($DATA['Password'],PASSWORD_DEFAULT);
        return $DATA;
    }

    public function getSupplierCount()
    {
        $query = "select count('SupplierID') as 'count' from $this->table;";

        return $this->query($query);
    }

}
