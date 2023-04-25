<?php

class Sub_Categories extends Model
{
    public $errors = [];
    protected $table = "sub_category";

    protected $allowedColumns = [
	    'CategoryID',
        'Sub_category_name',
        'Image',
        'Date',
    ];

    public function getSubcategoryName()
    {
        $query = "select Sub_category_name from $this->table order by Sub_category_name asc;";

        return $this->query($query);
    }

    public function getSubCategoriesByCatID($id)
    {
        $query = "select Sub_category_name, Image from $this->table where CategoryID = :CategoryID;";

        return $this->query($query,['CategoryID' => $id]);
    }

    public function validate($data)
    {
        $this->errors = [];

        if(empty($data['Sub_category_name']))
        {
            $this->errors['Sub_category_name'] = "Sub category name is required";
        }elseif (!preg_match("/^[a-zA-Z ]+$/",trim($data['Sub_category_name'])))
        {
            $this->errors['Sub_category_name'] = "Sub category name can only have letters and spaces.";
        }

        if(empty($data['CategoryID']))
        {
            $this->errors['CategoryID'] = "Category ID is required";
        }elseif (!preg_match("/^[a-zA-Z0-9]+$/",trim($data['CategoryID'])))
        {
            $this->errors['CategoryID'] = "Category ID can only have letters and numbers.";
        }

        if(empty($this->errors))
        {
            return true;
        }

        return false;
    }

    public function edit_validate($data)
    {
        $this->errors = [];

        if(empty($data['Sub_category_name']))
        {
            $this->errors['Sub_category_name'] = "Sub category name is required";
        }elseif (!preg_match("/^[a-zA-Z ]+$/",trim($data['Sub_category_name'])))
        {
            $this->errors['Sub_category_name'] = "Sub category name can only have letters and spaces.";
        }

        if(empty($this->errors))
        {
            return true;
        }

        return false;
    }

    public function deleteSubCategory($id,$name)
    {
        $query = "delete from $this->table where Sub_category_name = :Sub_category_name && CategoryID = :CategoryID;";
        return $this->query($query,['Sub_category_name' => $name,'CategoryID' => $id]);
    }

    public function getSubCategoryImage($name,$id)
    {
        $query = "select Image from $this->table where Sub_category_name = :Sub_category_name && CategoryID = :CategoryID;";
        return $this->query($query,['Sub_category_name' => $name,'CategoryID' => $id]);
    }

    public function updateSubCategoryWithImage($data,$name,$id){
        $query = "update $this->table set Sub_category_name = :Sub_category_name_new, Image = :Image where Sub_category_name = :Sub_category_name && CategoryID = :CategoryID;";
        return $this->query($query,['Sub_category_name_new' => $data['Sub_category_name'],'Sub_category_name' => $name,'Image' => $data['Image'],'CategoryID' => $id]);
    }

    public function updateSubCategoryName($name_new,$name,$id){
        $query = "update $this->table set Sub_category_name = :Sub_category_name_new where Sub_category_name = :Sub_category_name && CategoryID = :CategoryID;";
        return $this->query($query,['Sub_category_name_new' => $name_new,'Sub_category_name' => $name,'CategoryID' => $id]);
    }
}