<?php

class Design_image extends Model
{
    public $errors = [];
    protected $table = "design_image";

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

    public function deleteImage($id = null)
    {
        $query = "delete from $this->table where DesignID = :DesignID;";

        return $this->query($query,['DesignID' => $id]);
    }

}