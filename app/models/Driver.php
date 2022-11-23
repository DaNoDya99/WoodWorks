<?php

class Driver extends Model
{
    public $errors = [];
    protected $table = "driver";

    protected $allowedColumns = [
        'DriverID',
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


}