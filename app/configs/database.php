<?php

class Database
{
    private function connect()
    {
        $str = DBDRIVER.":hostname=".DBHOST.";dbname=".DBNAME;
        $con = new PDO($str,DBUSER,DBPASS);
        return $con;
    }

    public function query($query,$data = [],$type = 'object'){
        $con = $this->connect();

        $statement = $con->prepare($query);
        if($statement){
            $check = $statement->execute($data);
            if($check) {
                $mode = PDO::FETCH_OBJ;
                if ($type != 'object') {
                    $mode = PDO::FETCH_ASSOC;
                }
                $result = $statement->fetchAll($mode);

                if(is_array($result) && count($result)>0){
                    return $result;
                }
            }
        }

        return false;
    }

    public function create_tables()
    {
        $query = "
            CREATE TABLE IF NOT EXISTS `employee` (
            `EmployeeID` char(5) NOT NULL,
            `Firstname` char(30) NOT NULL,
            `Lastname` char(30) NOT NULL,
            `Email` varchar(100) NOT NULL,
            `Password` varchar(256) NOT NULL,
            `Role` char(15) NOT NULL,
            `Contactno` char(10) NOT NULL,
            `Date` timestamp NOT NULL DEFAULT current_timestamp(),
             PRIMARY KEY (`EmployeeID`),
            KEY `Firstname` (`Firstname`),
            KEY `Lastname` (`Lastname`),
            KEY `Email` (`Email`),
            KEY `Role` (`Role`),
            KEY `Contactno` (`Contactno`),
            KEY `Date` (`Date`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1
        ";

        $this->query($query);
    }
}