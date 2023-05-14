<?php

class Customer extends Model
{
    public $errors = [];
    protected $table = "customer";

    protected $allowedColumns = [
        'CustomerID',
        'Firstname',
        'Lastname',
        'Email',
        'Password',
        'Mobileno',
        'Image',
        'status',
    ];

    protected $beforeInsert = [
        'make_customer_id',
        'hash_password'
    ];

    public function validate($post)
    {
        $this->errors = [];


        if (empty($post['Firstname'])) {
            $this->errors['Firstname'] = "A first name is required.";
        } elseif (!preg_match("/^[a-zA-Z]+$/", trim($post['Firstname']))) {
            $this->errors['Firstname'] = "First name can only have letters.";
        }

        if (empty($post['Lastname'])) {
            $this->errors['Lastname'] = "A last name is required.";
        } elseif (!preg_match("/^[a-zA-Z]+$/", trim($post['Lastname']))) {
            $this->errors['Lastname'] = "Last name can only have letters.";
        }
        if (!filter_var($post['Email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['Email'] = "Email is not valid.";
        } elseif ($results = $this->where('Email', $post['Email'])) {
            foreach ($results as $result) {
                if ($post['CustomerID'] != $result->CustomerID) {
                    $this->errors['Email'] = "That email already exists.";
                }
            }
        }

        if (!filter_var($post['Email'], FILTER_VALIDATE_EMAIL)) {

            $this->errors['Email'] = "Email is not valid.";
        } elseif ($this->where('Email', $post['Email'])) {
            $this->errors['Email'] = "Email already exist.";
        }

        if (empty($post['Password'])) {
            $this->errors['Password'] = "Password is required.";
        } elseif (strlen($post['Password']) < 8) {
            $this->errors['Password'] = "Password must be at least 8 characters long.";
        } elseif ($post['Password'] !== $post['Password2']) {
            $this->errors['Password'] = "Passwords do not match.";
        }


        if (empty($post['Mobileno'])) {
            $this->errors['Mobileno'] = "Contact number required.";
        } elseif (!preg_match("/^[0-9]+$/", trim($post['Mobileno']))) {
            $this->errors['Mobileno'] = "Contact number can only have numbers.";
        }

        if (empty($this->errors)) {
            return true;
        }

        return false;
    }

    public function make_customer_id($data)
    {

        if (!isset($data['status'])) {
            $customerID = $this->random_string(60);
            $result = $this->where('CustomerID', $customerID);
            while ($result) {
                $result = $this->where('CustomerID', $customerID);
                $customerID = $this->random_string(60);
            }


            $data['CustomerID'] = $customerID;


        }
        return $data;
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

    public function hash_password($data)
    {
        if (isset($data['Password'])) {
            $data['Password'] = password_hash($data['Password'], PASSWORD_DEFAULT);
        }


        return $data;
    }

    public function edit_validate($post)
    {
        $this->errors = [];
        $gender = ['Male', 'Female'];

        if (empty($post['Firstname'])) {
            $this->errors['Firstname'] = "A first name is required.";
        } elseif (!preg_match("/^[a-zA-Z]+$/", trim($post['Firstname']))) {
            $this->errors['Firstname'] = "First name can only have letters.";
        }

        if (empty($post['Lastname'])) {
            $this->errors['Lastname'] = "A last name is required.";
        } elseif (!preg_match("/^[a-zA-Z]+$/", trim($post['Lastname']))) {
            $this->errors['Lastname'] = "Last name can only have letters.";
        }

        if (!in_array($post['Gender'], $gender)) {
            $this->errors['Gender'] = "Gender is required.";
        }

        if (empty($post['Mobileno'])) {
            $this->errors['Mobileno'] = "Contact number required.";
        } elseif (!preg_match("/^[0-9]+$/", trim($post['Mobileno']))) {
            $this->errors['Mobileno'] = "Contact number can only have numbers.";
        }

        if (empty($this->errors)) {
            return true;
        }

        return false;
    }

    public function getCustomerByID($id)
    {
        $query = "SELECT * FROM customer WHERE CustomerID = :id";

        return $this->query($query, ['id' => $id]);
    }


    public function activate_profile()
    {
        $this->update($_SESSION['Email'], ['status' => 1, 'Email' => $_SESSION['Email']]);
    }
}
