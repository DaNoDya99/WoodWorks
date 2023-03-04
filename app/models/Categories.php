<?php

class Categories extends Model
{
    public $errors = [];
    protected $table = "categories";

    protected $allowedColumns = [
	    'CategoryID',
        'Category_name',
        'Image',
        'Date'
    ];

    public function getCategories()
    {
        $query = "select CategoryID, Category_name,Image from Categories order by CategoryID asc ;";

        return $this->query($query);
    }

    public function validate($data)
    {
        $this->errors = [];

        if(empty($data['Category_name']))
        {
            $this->errors['Category_name'] = "Category name is required";
        }elseif (!preg_match("/^[a-zA-Z ]+$/",trim($data['Category_name'])))
        {
            $this->errors['Category_name'] = "Category name can only have letters and spaces.";
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

    public function edit_validate($data = null)
    {
        $this->errors = [];

        if(empty($data['Category_name']))
        {
            $this->errors['Category_name'] = "Category name is required";
        }elseif (!preg_match("/^[a-zA-Z ]+$/",trim($data['Category_name'])))
        {
            $this->errors['Category_name'] = "Category name can only have letters and spaces.";
        }

        if(empty($this->errors))
        {
            return true;
        }

        return false;
    }

    public function deleteCategory($id)
    {
        $query = "delete from $this->table where CategoryID = :CategoryID;";
        return $this->query($query,['CategoryID' => $id]);
    }

    public function getCategoryByID($id)
    {
        $query = "select * from $this->table where CategoryID = :CategoryID;";
        return $this->query($query,['CategoryID' => $id]);
    }

    public function updateCategoryWithImage($data,$id)
    {
        $query = "update $this->table set  Category_name = :Category_name, Image = :Image where CategoryID = '$id';";
        return $this->query($query,$data);
    }

    public function updateCategoryName($name,$id)
    {
        $query = "update $this->table set Category_name = :Category_name where CategoryID = :CategoryID;";
        return $this->query($query,['Category_name' => $name,'CategoryID' => $id]);
    }

    public function getCategoryImage($id)
    {
        $query = "select Image from $this->table where CategoryID = :CategoryID;";
        return $this->query($query,['CategoryID' => $id]);
    }

}