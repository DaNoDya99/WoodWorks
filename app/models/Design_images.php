<?php

class Design_images extends Model
{
    public $errors = [];
    protected $table = "design_images";

    protected $allowedColumns = [
        'DesignID',
        'Image',

    ];

    public function validate($post)
    {
        $this->errors = [];

        if (empty($post['Image'])) {
            $this->errors['Image'] = "Please upload the design images";
        }
        if (empty($this->errors)) {
            return true;
        }

        return false;
    }


}