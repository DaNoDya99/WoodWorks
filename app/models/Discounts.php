<?php
class Discounts extends Model{

    public $errors = [];
    protected $table = "discounts";

    protected $allowedColumns = [
        'DiscountID',
    	'Name',
    	'Description',
    	'Discount_percentage',
    	'Active',
    	'Created_at',
    	'Modified_at',
    	'Expired_at'	

    ];

    



}