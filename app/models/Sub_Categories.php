<?php

class Sub_Categories extends Model
{
    public $errors = [];
    protected $table = "sub_category";

    protected $allowedColumns = [
	    'CategoryID',
        'Sub_category_name',
        'Date',
    ];

    public function getSubcategoryName()
    {
        $query = "select Sub_category_name from $this->table order by Sub_category_name asc;";

        return $this->query($query);
    }
}