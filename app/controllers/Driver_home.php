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
            $this->redirect('login');
        }

        $id = $id ?? Auth::getEmployeeID();

        $driver = new Driver();
        $employee = new Employees();
        $data['details'] = $employee->where('EmployeeID',$id);
        $data['row']=$row = $driver->where("DriverID",$id);

        if(empty($row[0]))
        {
            $driver->insert(['DriverID'=>$id,'Availability'=>"Not Available"]);
            $this->redirect('driver_home');

        }
        $order = new Orders();

        $data['rows']= $rows = $order->findThisWeekOrders('DriverID',$id);
        $data['completedOrders']= $order->findThisWeekCompletedOrders('DriverID',$id);
        $data['delayedOrders']= $order->findThisMonthDelayedOrders('DriverID',$id);
        if (empty($rows[0]))
        {
            echo "No orders";
        }

        if(isset($_POST['vehicle'])){
            $vehicle =$_POST['vehicle'];
            $driver->update_type($id,['Vehicle_type'=>$vehicle]);
        }

        $data['title'] = "DASHBOARD";

        $this->view('driver/driver_home',$data);


    }
    public function profile($id = null)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
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
            $this->redirect('login');
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

        $data['row'] = $order->displayOrders('DriverID',$id);


        if(isset($_GET['orders_items']))
        {
                $orders_items = $_GET['orders_items'];// don't care at the end
                $data['row'] = $result = $order->searchOrdersDetails('DriverID',$id,$orders_items);
                if(empty($result))
                {
                    $this->redirect('driver_home/order');
                }

        }

        if(isset($_POST['Status'])){
            $status =$_POST['Status'];
            if($status=="All"){
                $this->redirect('driver_home/order');
            }
            else
            {
                $data['row'] = $order->filterStatus('Order_status',$status,$id);
            }

        }

        $this->view('driver/order',$data);

    }

    public function delivered_orders($id = null)
    {

        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $order = new Orders();

        $id = Auth::getEmployeeID();
        $employee = new Employees();
        $data['details'] = $row = $employee->where('EmployeeID',$id);
        $data['title'] = "ORDERS";

        $data['records1'] = $order->displayDeliveredOrders('DriverID',$id);

        if(isset($_GET['delivered_items']))
        {
            $orders_items = $_GET['delivered_items'];
            $data['records1'] = $result = $order->searchDeliveredOrdersDetails('DriverID',$id,$orders_items);
            if(empty($result))
            {
                $this->redirect('driver_home/delivered_orders'.$id);
            }

        }

        $this->view('driver/includes/delivered_orders_table',$data);

    }

    public function orders_records($id = null)
    {

        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $order = new Orders();

        $id = Auth::getEmployeeID();
        $employee = new Employees();
        $data['details'] = $row = $employee->where('EmployeeID',$id);
        $data['title'] = "ORDERS";

        $data['records2'] = $order->displayDeliveredOrders('DriverID',$id);

        if(isset($_POST['dateFilter'])){
            $status = $_POST['Status'];
            $from_date = $_POST['from_date'];
            $to_date = $_POST['to_date'];
            $data['records2'] = $order->filterRecords($status, $from_date, $to_date);
            if (empty($data['records2'])) {
                $this->redirect('driver_home/orders_records');
            }
        }

        $this->view('driver/includes/delivered_history_table',$data);

    }

    public function upload_document($id)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $order = new Orders();

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {

            //$order->update_Reason(['OrderID' => $id], ['Reasons' => $_POST['Reason']]);

            if(!empty($_FILES["Image"]['name']))
            {
                $folder = "uploads/driver/";
                if(!file_exists($folder)){
                    mkdir($folder,0777,true);
                    file_put_contents($folder."index.php","<?php Access Denied.");
                    file_put_contents("uploads/index.php","<?php Access Denied.");
                }

                $allowedFileType = ['image/jpeg','image/png'];

                if(in_array($_FILES['Image']['type'],$allowedFileType))
                {

                    if($_FILES['Image']['error'] == 0)
                    {
                        $destination = $folder.time().$_FILES['Image']['name'];
                        if(move_uploaded_file($_FILES['Image']['tmp_name'],$destination))
                        {
                            $order->update_Image(['OrderID' => $id], ['Image' => $destination]);

                        }else{
                            $order->errors['image'] = "Could not upload image.";
                        }
                    }else{
                        $order->errors['image'] = "Could not upload image.";
                    }
                }else{
                    $order->errors['image'] = "This file type is not allowed.";
                }
            }else{
                $order->errors['image'] = "Please select an image.";
            }
        }

        if(empty($order->errors))
        {
            echo "<div class='cat-success'>
                      <h3>Image Added Successfully.</h3>
                        </div>";
            }else{
                $stm = "<div class='cat-errors''>
                                        <ul>";
                foreach ($order->errors as $error)
                {
                    $stm .= "<li>".$error."</li>";
                }

                $stm .= "</ul>
                             </div>";

                echo $stm;
        }

    }

    public function details($id = null)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $order_items = new Order_Items();
        $OrderID = $id;
        $data['rows'] = $order_items->where('OrderID', $OrderID);

        header('Content-Type: application/json');
        echo json_encode($data['rows']);
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
//            $this->redirect('driver_home');
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
        $id = $id ?? Auth::getEmployeeID();

        //$rows =  $order->query("SELECT COUNT(OrderID) AS numOrders,Order_status FROM `orders` GROUP BY Order_status ");
        $rows =  $order->pieGraph('DriverID',$id);
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
        $id = $id ?? Auth::getEmployeeID();
        $rows =  $order->barGraph('DriverID',$id);
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

    public function available_drivers()
    {
        if(!Auth::logged_in()) {
            $this->redirect('login');

        }

        $driver = new Driver();
        $rows = $driver->availableDrivers();

        foreach ($rows as $row){
            $row->Fullname = $row->Firstname." ".$row->Lastname;
            $row->Order_count = $driver->getAssignedOrderCount($row->DriverID)[0]->Count;
        }

        $str = "<option selected>-- Assign Driver --</option>";

        foreach ($rows as $row){
            $str .= "<option value='".$row->DriverID."'>".$row->DriverID." - ".$row->Fullname." - ".$row->Order_count." Orders Assigned.</option>";
        }

        echo $str;
    }

    public function assign_driver($orderId, $driverId){

        if(!Auth::logged_in()) {
            $this->redirect('login');

        }

        $order = new Orders();
        $order->assignDriver($orderId,$driverId);

        echo 'success';
        
    }

}