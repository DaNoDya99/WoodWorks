<?php

class Employees extends Model
{
    public $errors = [];
    protected $table = "employee";

    protected $allowedColumns = [
        'EmployeeID',
        'Firstname',
        'Lastname',
        'Email',
        'Password',
        'Role',
        'Contactno',
        'Slug',
        'Image'
    ];

    protected $beforeInsert = [
            'hash_password',
            'create_slug',
        ];

    public function edit_validate($post,$id)
    {
        $this->errors = [];


        if(empty($post['Firstname'])){
            $this->errors['Firstname'] = "A first name is required.";
        }elseif (!preg_match("/^[a-zA-Z]+$/",trim($post['Firstname']))){
            $this->errors['Firstname'] = "First name can only have letters.";
        }

        if(empty($post['Lastname'])){
            $this->errors['Lastname'] = "A last name is required.";
        }elseif (!preg_match("/^[a-zA-Z]+$/",trim($post['Lastname']))){
            $this->errors['Lastname'] = "Last name can only have letters.";
        }

        if(!filter_var($post['Email'],FILTER_VALIDATE_EMAIL)){
            $this->errors['Email'] = "Email is not valid.";
        }elseif ($results = $this->where('Email',$post['Email']))
        {
            foreach ($results as $result){
                if($id != $result->EmployeeID){
                    $this->errors['email'] = "That email already exists.";
                }
            }
        }
        if(empty($post['Contactno'])){
            $this->errors['Contactno'] = "Contact number required.";
        }elseif (!preg_match("/^[0-9]+$/",trim($post['Contactno']))){
            $this->errors['Contactno'] = "Contact number can only have numbers.";
        }

        if(empty($this->errors)){
            return true;
        }

        return false;
    }

    public function hash_password($DATA){
        $DATA['Password'] = password_hash($DATA['Password'],PASSWORD_DEFAULT);
        return $DATA;
    }

    public function create_slug($DATA){
        $DATA['Slug'] = strtolower($DATA['Firstname'])."-".strtolower($DATA['Lastname']);
        return $DATA;
    }

    public function validate($data)
    {
        $this->errors = [];

        if(empty($data['EmployeeID'])){
            $this->errors['EmployeeID'] = "Employees ID is required.";
        }elseif($this->where('EmployeeID',$data['EmployeeID'])){
            $this->errors['EmployeeID'] = "Employees ID already exist.";
        }

        if (empty($data['Firstname'])) {
            $this->errors['Firstname'] = "A first name is required.";
        } elseif (!preg_match("/^[a-zA-Z]+$/", trim($data['Firstname']))) {
            $this->errors['Firstname'] = "First name can only have letters.";
        }

        if (empty($data['Lastname'])) {
            $this->errors['Lastname'] = "A last name is required.";
        } elseif (!preg_match("/^[a-zA-Z]+$/", trim($data['Lastname']))) {
            $this->errors['Lastname'] = "Last name can only have letters.";
        }

        if (!filter_var($data['Email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['Email'] = "Email is not valid.";
        } elseif ($this->where('Email', $data['Email'])) {
            $this->errors['email'] = "That email already exists.";
        }

        if (empty($data['Password'])) {
            $this->errors['Password'] = "A password is required.";
        } elseif (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/", trim($data['Password']))) {
            $this->errors['Password'] = "Password must contain at least 8 characters, at least one uppercase letter, one lowercase letter, one number and one special character.";
        }

        if (empty($data['Contactno'])) {
            $this->errors['Contactno'] = "Contact number required.";
        } elseif (!preg_match("/^[0-9]+$/", trim($data['Contactno']))) {
            $this->errors['Contactno'] = "Contact number can only have numbers.";
        }

        if (empty($this->errors)) {
            return true;
        }

        return false;

    }

    public function deleteEmployee($id = null)
    {
        $query = "delete from $this->table where EmployeeID = :EmployeeID;";

        return $this->query($query , ['EmployeeID' => $id]);
    }

    public function getEmployeeCount()
    {
        $query = "select count('EmployeeID') as 'count' from $this->table;";

        return $this->query($query);
    }

}