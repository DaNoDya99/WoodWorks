<?php

class Database
{
    private function connect()
    {
        $str = DBDRIVER.":hostname=".DBHOST.";dbname=".DBNAME;
        $con = new PDO($str,DBUSER,DBPASS);
        return $con;
    }

    public function query($query,$data,){
        $con = $this->connect();

        $statement = $con->prepare($query);
    }
}