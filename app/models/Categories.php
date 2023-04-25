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

}