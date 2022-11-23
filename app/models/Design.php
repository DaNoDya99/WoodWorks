<?php

class Design extends Model
{
    public $errors = [];
    protected $table = "design";

    protected $allowedColumns = [
        'DesignID',
        'Description',
        'EmployeeID',
        'ManagerID',
        'Date',

    ];

    protected $beforeInsert = [
        'make_design_id',
    ];

    public function validate($post)
    {
        $this->errors = [];

        if (empty($post['Description'])) {
            $this->errors['Description'] = "Description can not be empty";
        }
        if (empty($this->errors)) {
            return true;
        }

        return false;
    }

    public function make_design_id($DATA){

        $designID = $this->random_string(60);
        $result = $this->where('DesignID',$designID);
        while ($result){
            $result = $this->where('DesignID',$designID);
            $designID = $this->random_string(60);
        }

        $DATA['DesignID'] = $designID;

        return $DATA;
    }

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

}