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
        $data['row']=$row = $driver->where("DriverID",$id);
        //show($row[0]->Availability);

        if(empty($row[0]))
        {
            $driver->insert(['DriverID'=>$id,'Availability'=>"Not Available"]);
            //$row = $driver->query("INSERT INTO driver (DriverID,Availability) VALUES ('$id','Not Available');");
            $this->redirect('driver_home');

        }
        $order = new Order();
        $query = "SELECT * FROM `order`  WHERE `DriverID` = '$id' order by DATE desc limit 10;";
        $data['rows']= $rows = $order->query($query);

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

        $order = new Order();
        $id = Auth::getEmployeeID();
        $data['title'] = "ORDERS";

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $OrderID =$_POST['OrderID'];
            $status =$_POST['status'];
            $data['row'] = $order->query("UPDATE `order` SET Order_status = '$status' WHERE OrderID = '$OrderID';");

        }

        $query = "SELECT OrderID,Payment_type,Total_amount,Order_status,order.Address,Firstname,Lastname,Mobileno,order.Date FROM `order` INNER JOIN `customer` ON order.CustomerID = customer.CustomerID WHERE `Deliver_method` = 'Delivery' && `DriverID` = '$id';";//&& OrderStatus = 'Processing'
        if(isset($_GET['designs_date']))
        {
            $designs_date = $_GET['designs_date'].'%';// don't care at the end
            $query = ("SELECT * FROM `order` INNER JOIN `customer` ON order.CustomerID = customer.CustomerID WHERE (`Date` = '$designs_date') && `DriverID` = '$id';");
        }

        $data['row'] = $order->query($query);
//        show($data['row']);
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

        $order = new Order();

        $rows =  $order->query("SELECT COUNT(OrderID) AS numOrders,Order_status FROM `order` GROUP BY Order_status ");

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

        $order = new Order();

        //$rows =  $order->query("SELECT cast(Date as date) AS Date, count(OrderID) AS numOrders FROM `order` WHERE NOT Order_status = 'delivered' GROUP BY cast(Date as date)");
        $rows =  $order->query("SELECT cast(Date as date) AS Date, count(OrderID) AS numOrders FROM `order` WHERE NOT Order_status = 'delivered' GROUP BY cast(Date as date)");

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

        $order = new Order();

        $rows =  $order->query("SELECT cast(Date as date) AS Date, count(OrderID) AS numOrders FROM `order` WHERE Order_status = 'delivered' GROUP BY cast(Date as date) ORDER BY Date ASC");

        $data = array();

        foreach ($rows as $row){
            $data[] = $row;
        }

        print json_encode($data);

    }
}
