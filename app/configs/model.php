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

        $keys = array_keys($data);
        $values = array_values($data);

        $query = "insert into ".$this->table;
        $query .= " (".implode(",",$keys) .") values (:".implode(",:",$keys) .")";

        $this->query($query,$data);
    }

    public function where($column,$value)
    {
        $column = addslashes($column);
        $query = "select * from $this->table where $column = :value";
        return $this->query($query,['value' => $value]);
    }

}