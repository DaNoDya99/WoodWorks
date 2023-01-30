<?php

class Driver_home extends Controller
{
    public function index()
    {

//        if(Auth::logged_in() && Auth::checkPerson('driver'))
//        {
//            $data['title'] = "DASHBOARD";
//            $this->view('driver/profile',$data);
//            die;
//
//        }
//        $this->redirect('login3');

        if(!Auth::logged_in())
        {
            $this->redirect('login3');
        }

        $id = $id ?? Auth::getEmployeeID();

        $driver = new Driver();
        $employee = new Employees();
        $data['details'] = $employee->where('EmployeeID',$id);
        $data['row']=$row = $driver->where("DriverID",$id);
        //show($row[0]->Availability);

        if(empty($row[0]))
        {
            $driver->insert(['DriverID'=>$id,'Availability'=>"Not Available"]);
            //$row = $driver->query("INSERT INTO driver (DriverID,Availability) VALUES ('$id','Not Available');");
            $this->redirect('driver_home');

        }
        $order = new Orders();
//        $query = "SELECT * FROM `orders`  WHERE `DriverID` = '$id' orders by DATE desc limit 10;";
//        $data['rows']= $rows = $order->query($query);

        $data['rows']= $rows = $order->findOrders('DriverID',$id);
        $data['title'] = "DASHBOARD";
//        $data['availability'] = $row[0]->Availability;

        $this->view('driver/driver_home',$data);


    }
    public function profile($id = null)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login3');
        }

        $id = $id ?? Auth::getEmployeeID();
        $employee = new Employees();
        $data['row'] = $row = $employee->where('EmployeeID',$id);

        if($_SERVER['REQUEST_METHOD'] == 'POST' && $row)
        {
            $folder = "uploads/images/";
            if(!file_exists($folder)){
                mkdir($folder,0777,true);
                file_put_contents($folder."index.php","<?php Access Denied.");
                file_put_contents("uploads/index.php","<?php Access Denied.");
            }

            if($employee->edit_validate($_POST,$id)){
                $allowedFileType = ['image/jpeg','image/png'];


                if(!empty($_FILES['Image']['name']))
                {
                    if($_FILES['Image']['error'] == 0)
                    {
                        if(in_array($_FILES['Image']['type'],$allowedFileType))
                        {
                            $destination = $folder.time().$_FILES['Image']['name'];
                            move_uploaded_file($_FILES['Image']['tmp_name'],$destination);

                            $_POST['Image'] = $destination;
                            if(file_exists($row[0]->Image))
                            {
                                unlink($row[0]->Image);
                            }
                        }else{
                            $employee->errors['image'] = "This file type is not allowed.";
                        }
                    }else{
                        $employee->errors['image'] = "Could not upload image.";
                    }
                }
                $_POST['EmployeeID'] = $id;
                $employee->update($id,$_POST);
                $this->redirect('driver_home/profile/'.$id);
            }
        }

        $data['title'] = "PROFILE";
        $data['errors'] = $employee->errors;

        $this->view('driver/profile',$data);
    }
    public function order($id = null)
    {

        if(!Auth::logged_in())
        {
            $this->redirect('login3');
        }

        $order = new Orders();

        $id = Auth::getEmployeeID();
        $employee = new Employees();
        $data['details'] = $row = $employee->where('EmployeeID',$id);
        $data['title'] = "ORDERS";

        if(isset($_POST['status'])){//$_SERVER['REQUEST_METHOD'] == "POST"
            $OrderID =$_POST['OrderID'];
            $status =$_POST['status'];
            //$data['row'] = $order->query("UPDATE `orders` SET Order_status = '$status' WHERE OrderID = '$OrderID';");
            $data['row'] = $order->update_status($OrderID,['Order_status'=>$status]);
        }

        //$query = "SELECT OrderID,Payment_type,Total_amount,Order_status,orders.Address,Firstname,Lastname,Mobileno,orders.Date FROM `orders` INNER JOIN `customer` ON orders.CustomerID = customer.CustomerID WHERE `Deliver_method` = 'Delivery' && `DriverID` = '$id';";//&& OrderStatus = 'Processing'
        $data['row'] = $order->displayOrders('DriverID',$id);

        if(isset($_GET['orders_items']))
        {
                $orders_items = $_GET['orders_items'];// don't care at the end
                //$query = ("SELECT OrderID,Payment_type,Total_amount,Order_status,orders.Address,Firstname,Lastname,Mobileno,orders.Date FROM `orders` INNER JOIN `customer` ON orders.CustomerID = customer.CustomerID WHERE DATE_FORMAT(orders.Date, '%d/%m/%Y') like '%$orders_items%'  or Payment_type like '%$orders_items%' or orders.Address like '%$orders_items%' or orders.Total_amount like '%$orders_items%' AND `orders`.`DriverID` = '$id'LIMIT 15");

                $data['row'] = $result = $order->searchOrdersDetails('DriverID',$id,$orders_items);
                if(empty($result))
                {
                    $this->redirect('driver_home/order');
                }

        }

        if(isset($_POST['Status'])){
            $status =$_POST['Status'];
            if($status=="-- Filter --"){
                $this->redirect('driver_home/order');
            }
            else
            {
                $data['row'] = $order->filterStatus('Order_status',$status,$id);
            }

        }

//        $data['row'] = $order->query($query);
        $this->view('driver/order',$data);

    }

    public function availability($id = null)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login3');
        }

        $id = $id ?? Auth::getEmployeeID();

        $driver = new Driver();
        $row = $driver->where("DriverID",$id);

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            if (strtolower($row[0]->Availability) == "available") {
                //$driver->query("UPDATE driver SET Availability='Not Available' WHERE DriverID = '$id';");
                $driver->update($id,['DriverID'=>$id,'Availability'=>"Not Available"]);
            } elseif (strtolower($row[0]->Availability) == "not available") {
                //$driver->query("UPDATE driver SET Availability='Available'WHERE DriverID = '$id';");
                $driver->update($id,['DriverID'=>$id,'Availability'=>"Available"]);
            }

        }
        $this->redirect('driver_home');
    }

    public function pieData()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login3');
        }

        header('Content-Type: application/json');

        $order = new Orders();

        //$rows =  $order->query("SELECT COUNT(OrderID) AS numOrders,Order_status FROM `orders` GROUP BY Order_status ");
        $rows =  $order->pieGraph();
        $data = array();

        foreach ($rows as $row){
            $data[] = $row;
        }

        print json_encode($data);

    }
    public function barData()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login3');
        }

        header('Content-Type: application/json');

        $order = new Orders();

        //$rows =  $order->query("SELECT cast(Date as date) AS Date, count(OrderID) AS numOrders FROM `orders` WHERE NOT Order_status = 'delivered' GROUP BY cast(Date as date)");
        $rows =  $order->barGraph();
        $data = array();

        foreach ($rows as $row){
            $data[] = $row;
        }

        print json_encode($data);

    }
    public function lineData()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login3');
        }

        header('Content-Type: application/json');

        $order = new Orders();

        $rows =  $order->query("SELECT cast(Date as date) AS Date, count(OrderID) AS numOrders FROM `orders` WHERE Order_status = 'delivered' GROUP BY cast(Date as date) ORDER BY Date ASC");

        $data = array();

        foreach ($rows as $row){
            $data[] = $row;
        }

        print json_encode($data);

    }
}