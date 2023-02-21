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
        $query = "select CategoryID, Category_name from Categories order by CategoryID asc ;";

        return $this->query($query);
    }

    public function validate($data)
    {
        $this->errors = [];

        if(empty($data['Category_name']))
        {
            $this->errors['Category_name'] = "Category name is required";
        }elseif (!preg_match("/^[a-zA-Z]+$/",trim($data['Category_name'])))
        {
            $this->errors['Category_name'] = "Category name can only have letters.";
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

}