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

	public function random_string($length){
        $array = array(0,1,2,3,4,5,6,7,8,9,'A','B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
        $text = "";
        for($x=0;$x<$length;$x++)
        {
            $random = rand(0,61);
            $text .= $array[$random];
        }

        return $text;
    }

    public function getDiscount($id)
    {
        $query = "SELECT * FROM discounts WHERE DiscountID = :id";

        return $this->query($query, ['id' => $id]);
    }

    public function getActiveDiscounts()
    {
        $query = "SELECT * FROM discounts WHERE Active = 1";

        return $this->query($query);
    }

    



}