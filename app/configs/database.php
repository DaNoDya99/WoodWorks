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
                    `Slug` varchar(60) NOT NULL,
                    `Image` varchar(1024) DEFAULT NULL,
                    PRIMARY KEY (`EmployeeID`),
                    KEY `Firstname` (`Firstname`),
                    KEY `Lastname` (`Lastname`),
                    KEY `Email` (`Email`),
                    KEY `Role` (`Role`),
                    KEY `Contactno` (`Contactno`),
                    KEY `Date` (`Date`),
                    KEY `slug` (`Slug`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=latin1
        ";

        $this->query($query);

        $query = "
            	CREATE TABLE IF NOT EXISTS `customer` (
                `CustomerID` char(60) NOT NULL,
                `Firstname` char(30) NOT NULL,
                `Lastname` char(30) NOT NULL,
            	`Gender` char(6) NOT NULL,
                `Email` varchar(100) NOT NULL,
                `Password` varchar(255) NOT NULL,
                `Address` varchar(200) NOT NULL,
                `Mobileno` char(10) NOT NULL,
                `Date` timestamp NOT NULL DEFAULT current_timestamp(),
                PRIMARY KEY (`CustomerID`),
                KEY `CustomerID` (`CustomerID`),
                KEY `Firstname` (`Firstname`),
                KEY `Lastname` (`Lastname`),
                KEY `Email` (`Email`),
                KEY `Address` (`Address`),
                KEY `Mobileno` (`Mobileno`),
                KEY `Date` (`Date`)
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1
        ";

        $this->query($query);

        $query = "
            	CREATE TABLE IF NOT EXISTS `driver`(
                `DriverID` char(60) NOT NULL,
                `Availability` char(13) NOT NULL,
                PRIMARY KEY (`DriverID`),
                KEY `DriverID` (`DriverID`),
                KEY `Availability` (`Availability`),
                CONSTRAINT `DriverEmployee` FOREIGN KEY (`DriverID`) REFERENCES `employee` (`EmployeeID`) ON DELETE CASCADE ON UPDATE CASCADE
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1
        ";
        $this->query($query);

        $query = "
                CREATE TABLE IF NOT EXISTS `orders` (
                `OrderID` char(60) NOT NULL,
                `PaymentType` char(6) NOT NULL,
                `TotalAmount` float NOT NULL,
                `Date` timestamp NOT NULL DEFAULT current_timestamp(),
                `DeliveryMethod` char(8) NOT NULL,
                `OrderStatus` char(10) NOT NULL,
                `Address` varchar(200) DEFAULT NULL,
                `CustomerID` char(60) NOT NULL,
                `DriverID` char(60) DEFAULT NULL,
                PRIMARY KEY (`OrderID`),
                KEY `OrderId` (`OrderID`),
                KEY `PaymentType` (`PaymentType`),
                KEY `TotalAmount` (`TotalAmount`),
                KEY `Date` (`Date`),
                KEY `DeliveryMethod` (`DeliveryMethod`),
                KEY `OrderStatus` (`OrderStatus`),
                KEY `Address` (`Address`),
                KEY `CustomerID` (`CustomerID`),
                KEY `DriverID` (`DriverID`),
                CONSTRAINT `OrderCustomer` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`) ON DELETE NO ACTION ON UPDATE CASCADE
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1
        ";
        $this->query($query);

        $query = "
                 CREATE TABLE IF NOT EXISTS `design` (
                 `DesignID` char(60) NOT NULL,
                 `Description` varchar(1024) NOT NULL,
                 `EmployeeID` char(5) NOT NULL,
                 `ManagerID` char(5) DEFAULT NULL,
                 `Date` timestamp NOT NULL DEFAULT current_timestamp(),
                 PRIMARY KEY (`DesignID`),
                 KEY `ManagerID` (`ManagerID`),
                 KEY `Date` (`Date`),
                 KEY `EmployeeID` (`EmployeeID`)
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1
        ";
        $this->query($query);

        $query = "
                CREATE TABLE IF NOT EXISTS `design_images` (
                `DesignID` char(60) NOT NULL,
                `Image` varchar(1024) NOT NULL,
                PRIMARY KEY (`Image`,`DesignID`),
                KEY `DesignID` (`DesignID`),
                KEY `Image` (`Image`),
                CONSTRAINT `DesignerDesign` FOREIGN KEY (`DesignID`) REFERENCES `design` (`DesignID`) ON DELETE CASCADE ON UPDATE CASCADE
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1
        ";
        $this->query($query);
    }
}