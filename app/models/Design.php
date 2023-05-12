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
        'CategoryID',
        'Pdf',
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
        if (empty($data['CategoryID'])) {
            $this->errors['CategoryID'] = "Please select a category";
        }
        if (empty($this->errors)) {
            return true;
        } else {
            return false;
        }
    }

    public function make_design_id($DATA){

//        $designID = $this->random_string(60);
//        $result = $this->where('DesignID',$designID);
//        while ($result){
//            $result = $this->where('DesignID',$designID);
//            $designID = $this->random_string(60);
//        }

        $prefix = 'DES';
        $unique_id = mt_rand(1000, 9999);
        $timestamp = substr(date('YmdHis'), 8, 6);
        $designID = $prefix . '-' . $unique_id . '-' . $timestamp;

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

    public function getDesigns($CatID, $offset, $limit = 2) {
        $query = "SELECT DesignID, Name,CategoryID, DATE_FORMAT(Date,'%d / %m / %Y') AS Date FROM `$this->table` WHERE CategoryID = '$CatID' ORDER BY DesignID DESC LIMIT $limit OFFSET $offset";
        return $this->query($query);
    }


    public function getDesign($column,$value,$limit = 5){

        $query = "SELECT `DesignID`,`Name`,DATE_FORMAT(Date,'%d / %m / %Y') AS 'Date',`CategoryID` FROM `$this->table` WHERE $column = :value ORDER BY `Date` DESC LIMIT $limit";

        $params = ['value' => $value];

        return $this->query($query,$params);
    }

    public function viewDesign($id = null)
    {
        $query = "select ";

        $fields = [
            'DesignID',
            'DesignerID',
            'Description',
            'CategoryID',
            'Name',
            'Pdf',
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

    public function update_pdf($where, $data)
    {
        if(!empty($this->allowedColumns))
        {
            foreach ($data as $key => $value){
                if(!in_array($key,$this->allowedColumns))
                {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);
        $id = array_search($where['DesignID'], $where);

        $query = "update ".$this->table." set ";
        foreach ($keys as $key)
        {
            $query .= $key . "=:" . $key . ",";
        }
        $query = trim($query,",");
        $query .= " where DesignID = :id";

        $data['id'] = $where['DesignID'];
        $this->query($query,$data);
    }

    public function updatePost($id, $data)
    {
        if (!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);

        $setClause = '';
        foreach ($keys as $key) {
            $setClause .= $key . '=:' . $key . ',';
        }
        $setClause = rtrim($setClause, ',');

        $query = "UPDATE " . $this->table . " SET " . $setClause . " WHERE DesignID=:DesignID";

        $data['DesignID'] = $id;

        $this->query($query, $data);
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

    public function getDesignImages($id = null)
    {
        $query = "select Image from design_image where DesignID = :DesignID && Image not like '%primary%';";

        return $this->query($query,['DesignID' => $id]);
    }

    public function getDesignByID($id)
    {
        $query = "select * from design where DesignID = 'DES-4117-145602';";

        return $this->query($query);
    }

    public function acceptDesign($id,$emp){
        $query = 'update design set Status = :Status, ManagerID = :ManagerID where DesignID = :DesignID;';

        return $this->query($query,['Status' => 'accepted','DesignID' => $id, 'ManagerID' => $emp]);
    }

    public function rejectDesign($id,$emp){
        $query = 'update design set Status = :Status, ManagerID = :ManagerID where DesignID = :DesignID;';

        return $this->query($query,['Status' => 'rejected','DesignID' => $id, 'ManagerID' => $emp]);
    }

    public function getPendingDesignsCount(){
        $query = "SELECT COUNT(*) AS Count FROM $this->table WHERE Status = 'Pending';";

        return $this->query($query);
    }

    public function getDesignsByStatus($status)
    {
        $query = "SELECT * FROM $this->table WHERE Status = :Status;";

        return $this->query($query,['Status' => $status]);
    }
}