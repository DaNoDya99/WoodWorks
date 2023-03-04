<?php

class Design extends Model
{
    public $errors = [];
    protected $table = "design";

    protected $allowedColumns = [
        'DesignID',
        'Description',
        'DesignerID',
        'ManagerID',
        'Date',
        'Name',
        'Image',
        'Status'
    ];

    protected $beforeInsert = [
        'make_design_id',
    ];

    public function validate($data)
    {
        $this->errors = [];

        if (empty($data['Name'])) {
            $this->errors['Name'] = "Design Name can not be empty";
        }
        if (empty($data['Description'])) {
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

    public function getDesigns($offset,$limit = 2){

        $query = "SELECT DesignID,Name,DATE_FORMAT(Date,'%d / %m / %Y') AS Date FROM design ORDER BY DesignID desc limit $limit offset $offset; ";
        //SELECT * FROM design INNER JOIN design_image ON design.DesignID = design_image.DesignID ORDER BY design.DesignID desc limit $limit offset $offset;
        //SELECT * FROM design d INNER JOIN (SELECT DISTINCT DesignID,Image FROM design_image) ou ON d.DesignID = ou.DesignID ORDER BY d.DesignID desc limit $limit offset $offset;
        return $this->query($query);
    }

    public function getDesign($limit = 5){

        $query = "SELECT DesignID,Name,DATE_FORMAT(Date,'%d / %m / %Y') AS Date FROM design ORDER BY DesignID desc limit $limit; ";

        return $this->query($query);
    }

    public function viewDesign($id = null)
    {
        $query = "select ";

        $fields = [
            'DesignID',
            'DesignerID',
            'Description',
            'Name',
            'ManagerID',
            'Date',

        ];

        if(!empty($fields)){
            foreach ($fields as $field){
                $query .= $field.", ";
            }
        }

        $query = trim($query,", ");
        $query .= " from ".$this->table." where DesignID = '$id'";

        return $this->query($query);
    }

    public function getDisplayImage($DesignID = null)
    {
        $query = "
             WITH cte as
             (
                 SELECT *,
                  ROW_NUMBER()
                  OVER (PARTITION BY DesignID) AS rn
               FROM design_image WHERE DesignID = '$DesignID'
             )
            select * from cte
            where rn = 1  
        ";

        return $this->query($query);
    }



    public function getAllImages($id)
    {
        $query = "select Image from design_image WHERE DesignID = '$id';";

        return $this->query($query);
    }

    public function first($column,$value)
    {

        $query = "select * from $this->table where $column = :value";
        $query .= " order by Date desc limit 1";
        return $this->query($query,['value' => $value]);

    }

    public function getAllUnverifiedDesigns(){
        $query = "SELECT * FROM $this->table WHERE Status = 'pending';";
        return $this->query($query);
    }

    public function deleteDesign($id = null)
    {
        $query = "delete from $this->table where DesignID = :DesignID;";

        return $this->query($query,['DesignID' => $id]);
    }


    public function getDesignsCardDetails(){
        $query = "SELECT DesignID, Name FROM $this->table;";

        return $this->query($query);
    }

    public function getDesignPrimaryImage($id = null)
    {
        $query = "select Image from design_image where DesignID = :DesignID && Image like '%primary%';";

        return $this->query($query,['DesignID' => $id]);
    }

    public function getDesignSecondaryImages($id = null)
    {
        $query = "select Image from design_image where DesignID = :DesignID && Image not like '%primary%';";

        return $this->query($query,['DesignID' => $id]);
    }

    public function getDesignDetailsByID($id)
    {
        $query = "select * from $this->table where DesignID = :DesignID;";

        return $this->query($query,['DesignID'=>$id]);
    }

    public function acceptDesign($id,$emp){
        $query = 'update design set Status = :Status, ManagerID = :ManagerID where DesignID = :DesignID;';

        return $this->query($query,['Status' => 'accepted','DesignID' => $id, 'ManagerID' => $emp]);
    }

    public function rejectDesign($id,$emp){
        $query = 'update design set Status = :Status, ManagerID = :ManagerID where DesignID = :DesignID;';

        return $this->query($query,['Status' => 'rejected','DesignID' => $id, 'ManagerID' => $emp]);
    }
}