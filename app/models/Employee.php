<?php

class Employee extends Model
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
}