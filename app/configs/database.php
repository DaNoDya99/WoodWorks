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
            CREATE TABLE IF NOT EXISTS `advertisement` (
             `AdvetisementID` char(60) NOT NULL,
             `Date` timestamp NOT NULL DEFAULT current_timestamp(),
             `Product_name` char(30) NOT NULL,
             `Description` varchar(1024) NOT NULL,
             `Price` float NOT NULL,
             `Verified_manager` char(5) NOT NULL,
             `CustomerID` char(60) NOT NULL,
             `Advertisement_status` char(8) NOT NULL,
             PRIMARY KEY (`AdvetisementID`),
             KEY `Product_name` (`Product_name`),
             KEY `Price` (`Price`),
             KEY `Advertisement_status` (`Advertisement_status`),
             KEY `ManagerAd` (`Verified_manager`),
             KEY `CustomerAd` (`CustomerID`),
             CONSTRAINT `CustomerAd` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`) ON DELETE CASCADE ON UPDATE CASCADE,
             CONSTRAINT `ManagerAd` FOREIGN KEY (`Verified_manager`) REFERENCES `employee` (`EmployeeID`) ON DELETE NO ACTION ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1
        ";

        $this->query($query);

        $query = "
            CREATE TABLE IF NOT EXISTS `advertisements_image` (
             `AdvertisementID` char(60) NOT NULL,
             `Image` varchar(1024) NOT NULL,
             PRIMARY KEY (`AdvertisementID`,`Image`),
             KEY `AdvertisementID` (`AdvertisementID`),
             CONSTRAINT `AdImage` FOREIGN KEY (`AdvertisementID`) REFERENCES `advertisement` (`AdvetisementID`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1
        ";

        $this->query($query);

        $query = "
             	CREATE TABLE IF NOT EXISTS `bill` (
                 `BillID` varchar(60) NOT NULL,
                 `Date` timestamp NOT NULL DEFAULT current_timestamp(),
                 `Paid_amount` float NOT NULL,
                 `CashierID` char(5) NOT NULL,
                 `OrderID` char(60) NOT NULL,
                 PRIMARY KEY (`BillID`),
                 KEY `BillID` (`BillID`,`Paid_amount`,`CashierID`,`OrderID`)
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1
        ";

        $this->query($query);

        $query = "
             	CREATE TABLE IF NOT EXISTS `cart` (
                 `CartID` char(60) NOT NULL,
                 `Total_amount` float NOT NULL,
                 `CustomerID` char(60) NOT NULL,
                 PRIMARY KEY (`CartID`),
                 KEY `CartID` (`CartID`,`Total_amount`,`CustomerID`)
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1
        ";

        $this->query($query);

        $query = "
             	CREATE TABLE IF NOT EXISTS `supplier` (
                 `SupplierID` char(5) NOT NULL,
                 `Firstname` char(30) NOT NULL,
                 `Lastname` char(30) NOT NULL,
                 `Contactno` char(10) NOT NULL,
                 `Company_name` varchar(100) NOT NULL,
                 PRIMARY KEY (`SupplierID`),
                 KEY `Firstname` (`Firstname`),
                 KEY `Lastname` (`Lastname`),
                 KEY `SupplierID` (`SupplierID`)
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1
        ";

        $this->query($query);
        
        $query = "
             	CREATE TABLE IF NOT EXISTS `company_order` (
                 `OrderID` char(60) NOT NULL,
                 `OrderStatus` char(10) NOT NULL,
                 `Date` timestamp NOT NULL DEFAULT current_timestamp(),
                 `ManagerID` char(5) NOT NULL,
                 `SupplierID` char(5) NOT NULL,
                 PRIMARY KEY (`OrderID`),
                 KEY `OrderStatus` (`OrderStatus`),
                 KEY `ManagerID` (`ManagerID`),
                 KEY `SupplierID` (`SupplierID`),
                 KEY `OrderID` (`OrderID`),
                 CONSTRAINT `CompOrderManager` FOREIGN KEY (`ManagerID`) REFERENCES `employee` (`EmployeeID`) ON DELETE NO ACTION ON UPDATE CASCADE,
                 CONSTRAINT `CompOrderSupplier` FOREIGN KEY (`SupplierID`) REFERENCES `supplier` (`SupplierID`) ON DELETE CASCADE ON UPDATE CASCADE
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1
        ";

        $this->query($query);

        $query = "
             	CREATE TABLE IF NOT EXISTS `design` (
                 `DesignID` char(60) NOT NULL,
                 `Description` varchar(1024) NOT NULL,
                 `DesgnerID` char(5) NOT NULL,
                 `Date` timestamp NOT NULL DEFAULT current_timestamp(),
                 `ManagerID` char(5) DEFAULT NULL,
                 `Verified_date` datetime NOT NULL,
                 PRIMARY KEY (`DesignID`),
                 KEY `DesgnerID` (`DesgnerID`),
                 KEY `Date` (`Date`),
                 KEY `DesignID` (`DesignID`),
                 KEY `ManagerID` (`ManagerID`),
                 CONSTRAINT `DesignerDesign` FOREIGN KEY (`DesgnerID`) REFERENCES `employee` (`EmployeeID`) ON DELETE CASCADE ON UPDATE CASCADE,
                 CONSTRAINT `VerifiedManager` FOREIGN KEY (`ManagerID`) REFERENCES `employee` (`EmployeeID`) ON DELETE NO ACTION ON UPDATE CASCADE
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1
        ";

        $this->query($query);

        $query = "
             	CREATE TABLE IF NOT EXISTS `design_image` (
                 `DesignID` char(60) NOT NULL,
                 `Image` varchar(1024) NOT NULL,
                 PRIMARY KEY (`DesignID`,`Image`),
                 KEY `DesignID` (`DesignID`),
                 CONSTRAINT `DesignImage` FOREIGN KEY (`DesignID`) REFERENCES `design` (`DesignID`) ON DELETE CASCADE ON UPDATE CASCADE
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1
        ";

        $this->query($query);

        $query = "
            CREATE TABLE IF NOT EXISTS `driver` (
             `DriverID` char(5) NOT NULL,
             `Availability` char(10) NOT NULL,
             PRIMARY KEY (`DriverID`,`Availability`),
             KEY `DriverID` (`DriverID`,`Availability`),
             CONSTRAINT `DriverEmp` FOREIGN KEY (`DriverID`) REFERENCES `employee` (`EmployeeID`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1
        ";

        $this->query($query);

        $query = "
             	 	CREATE TABLE IF NOT EXISTS `furniture` (
                     `ProductID` char(5) NOT NULL,
                     `Name` varchar(50) NOT NULL,
                     `Category` varchar(15) NOT NULL,
                     `Description` varchar(1024) NOT NULL,
                     `Quantity` int(11) NOT NULL,
                     `Cost` decimal(10,0) NOT NULL,
                     `Visibility` tinyint(1) NOT NULL,
                     `Availability` tinyint(1) NOT NULL,
                     `Warrenty_period` char(8) NOT NULL,
                     `Wood_type` char(15) NOT NULL,
                     `Discount_percentage` decimal(10,0) DEFAULT NULL,
                     `SupplierID` char(5) NOT NULL,
                     `Discount_given_by` char(5) DEFAULT NULL,
                     `Date` datetime NOT NULL DEFAULT current_timestamp(),
                     PRIMARY KEY (`ProductID`),
                     KEY `DiscountGiven` (`Discount_given_by`),
                     KEY `ProductID` (`ProductID`),
                     KEY `ProductID_2` (`ProductID`,`Category`,`Description`,`Quantity`,`Cost`,`Visibility`,`Availability`,`Warrenty_period`,`Wood_type`,`Discount_percentage`,`SupplierID`,`Discount_given_by`),
                     KEY `Description` (`Description`),
                     KEY `FurnitureSupplier` (`SupplierID`),
                     CONSTRAINT `DiscountGiven` FOREIGN KEY (`Discount_given_by`) REFERENCES `employee` (`EmployeeID`) ON DELETE NO ACTION ON UPDATE CASCADE,
                     CONSTRAINT `FurnitureSupplier` FOREIGN KEY (`SupplierID`) REFERENCES `supplier` (`SupplierID`) ON DELETE NO ACTION ON UPDATE CASCADE
                    ) ENGINE=InnoDB DEFAULT CHARSET=latin1
        ";

        $this->query($query);

        $query = "
             	CREATE TABLE IF NOT EXISTS `furniture_image` (
                 `ProductID` char(5) NOT NULL,
                 `Image` varchar(1024) NOT NULL,
                 PRIMARY KEY (`ProductID`,`Image`),
                 KEY `ProductID` (`ProductID`),
                 CONSTRAINT `FurnitureImage` FOREIGN KEY (`ProductID`) REFERENCES `furniture` (`ProductID`) ON DELETE CASCADE ON UPDATE CASCADE
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1
        ";

        $this->query($query);

        $query = "
             	CREATE TABLE IF NOT EXISTS `order` (
                 `OrderID` char(60) NOT NULL,
                 `Payment_type` char(6) NOT NULL,
                 `Total_amount` float NOT NULL,
                 `Date` timestamp NOT NULL DEFAULT current_timestamp(),
                 `Deliver_method` char(8) NOT NULL,
                 `Order_status` char(10) NOT NULL,
                 `Address` varchar(200) NOT NULL,
                 `CustomerID` char(60) NOT NULL,
                 `DriverID` char(5) NOT NULL,
                 PRIMARY KEY (`OrderID`),
                 KEY `OrderID` (`OrderID`),
                 KEY `Payment_type` (`Payment_type`),
                 KEY `Total_amount` (`Total_amount`),
                 KEY `Date` (`Date`),
                 KEY `Deliver_method` (`Deliver_method`),
                 KEY `Order_status` (`Order_status`),
                 KEY `Address` (`Address`),
                 KEY `CustomerID` (`CustomerID`),
                 KEY `DriverID` (`DriverID`),
                 CONSTRAINT `CustomerOrder` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`) ON DELETE NO ACTION ON UPDATE CASCADE
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1
        ";

        $this->query($query);

        $query = "
            	CREATE TABLE IF NOT EXISTS `issues` (
                 `IssueID` char(60) NOT NULL,
                 `Problem_statement` varchar(1024) NOT NULL,
                 `CustomerID` char(60) NOT NULL,
                 `OrderID` char(60) NOT NULL,
                 `ManagerID` char(5) DEFAULT NULL,
                 `Response` varchar(512) DEFAULT NULL,
                 PRIMARY KEY (`IssueID`),
                 KEY `IssueID` (`IssueID`,`CustomerID`,`OrderID`,`ManagerID`),
                 KEY `IssueCustomer` (`CustomerID`),
                 KEY `IssureOrder` (`OrderID`),
                 KEY `IssueManager` (`ManagerID`),
                 CONSTRAINT `IssueCustomer` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`) ON DELETE CASCADE ON UPDATE CASCADE,
                 CONSTRAINT `IssueManager` FOREIGN KEY (`ManagerID`) REFERENCES `employee` (`EmployeeID`) ON DELETE NO ACTION ON UPDATE CASCADE,
                 CONSTRAINT `IssureOrder` FOREIGN KEY (`OrderID`) REFERENCES `order` (`OrderID`) ON DELETE CASCADE ON UPDATE CASCADE
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1 
        ";

        $this->query($query);

        $query = "
            CREATE TABLE IF NOT EXISTS `issue_image` (
             `IssueID` char(60) NOT NULL,
             `Image` varchar(1024) NOT NULL,
             PRIMARY KEY (`IssueID`,`Image`),
             KEY `IssueID` (`IssueID`),
             CONSTRAINT `IssueImage` FOREIGN KEY (`IssueID`) REFERENCES `issues` (`IssueID`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1
        ";

        $this->query($query);


        $query = "
             	CREATE TABLE IF NOT EXISTS `order_item` (
                 `ProductID` char(5) NOT NULL,
                 `Quantity` int(11) NOT NULL,
                 `Cost` float NOT NULL,
                 `OrderID` char(60) NOT NULL,
                 `CartID` char(60) DEFAULT NULL,
                 PRIMARY KEY (`ProductID`),
                 KEY `ProductID` (`ProductID`),
                 KEY `Cost` (`Cost`),
                 KEY `OrderID` (`OrderID`),
                 KEY `CartID` (`CartID`),
                 CONSTRAINT `OrderItemCart` FOREIGN KEY (`CartID`) REFERENCES `cart` (`CartID`) ON DELETE CASCADE ON UPDATE CASCADE,
                 CONSTRAINT `OrderItemFurniture` FOREIGN KEY (`ProductID`) REFERENCES `furniture` (`ProductID`) ON DELETE CASCADE ON UPDATE CASCADE,
                 CONSTRAINT `OrderOrder_Item` FOREIGN KEY (`OrderID`) REFERENCES `order` (`OrderID`) ON DELETE CASCADE ON UPDATE CASCADE
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1
        ";

        $this->query($query);

        $query = "
             	CREATE TABLE IF NOT EXISTS `ratings` (
                 `RateID` char(60) NOT NULL,
                 `Rating` int(11) NOT NULL,
                 `Reviews` varchar(1024) NOT NULL,
                 `CustomerID` char(5) NOT NULL,
                 `ProductID` char(5) NOT NULL,
                 PRIMARY KEY (`RateID`),
                 KEY `Rating` (`Rating`),
                 KEY `CustomerID` (`CustomerID`,`ProductID`),
                 KEY `RateProduct` (`ProductID`),
                 CONSTRAINT `RateCustomer` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`) ON DELETE NO ACTION ON UPDATE CASCADE,
                 CONSTRAINT `RateProduct` FOREIGN KEY (`ProductID`) REFERENCES `furniture` (`ProductID`) ON DELETE NO ACTION ON UPDATE CASCADE
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1
        ";

        $this->query($query);
    }
}