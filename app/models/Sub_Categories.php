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

}