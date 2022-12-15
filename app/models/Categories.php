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

}