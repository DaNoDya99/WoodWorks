<?php

class Model extends Database
{
    protected $table = "";

    public function insert($data)
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

        if(property_exists($this,'beforeInsert'))
        {
            foreach($this->beforeInsert as $func)
            {
                $data = $this->$func($data);
            }
        }

        $keys = array_keys($data);
        $values = array_values($data);

        $query = "insert into ".$this->table;
        $query .= " (".implode(",",$keys) .") values (:".implode(",:",$keys) .")";

        return ($this->query($query,$data));
    }

    public function where($column,$value)
    {
        $column = addslashes($column);
        $query = "select * from $this->table where $column = :value";
        return $this->query($query,['value' => $value]);
    }

    public function update($id,$data)
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

         if(property_exists($this,'beforeInsert'))
        {
            foreach($this->beforeInsert as $func)
            {
                $data = $this->$func($data);
            }
        }

        $keys = array_keys($data);
       
        $id = array_search($id,$data);
        $query = "update ".$this->table." set ";
        foreach ($keys as $key)
        {
            $query .= $key . "=:" . $key . ",";
        }
        $query = trim($query,",");
        $query .= " where ".$id." = :".$id;
        $this->query($query,$data);
    }

    public function findAll()
    {
        $query = "select * from $this->table";
        return $this->query($query);
    }



}