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
//        $this->redirect('login');

        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        // If no ID is passed as a parameter, use the ID of the log ed in user
        $id = $id ?? Auth::getEmployeeID();

        // Instantiate the Driver and Employees models
        $driver = new Driver();
        $employee = new Employees();

        // Get the details of the employee with the specified ID
        $data['details'] = $employee->where('EmployeeID',$id);
        // Get the row for the driver with the specified ID
        $data['row']=$row = $driver->where("DriverID",$id);

        // If the driver row is empty, insert a new row and redirect to the home page
        if(empty($row[0]))
        {
            $driver->insert(['DriverID'=>$id,'Availability'=>"Not Available"]);
            $this->redirect('driver_home');

        }

        // Instantiate the Orders model
        $order = new Orders();

        // Get the orders for the current week for the driver with the specified ID
        $data['rows']= $rows = $order->findThisWeekOrders('DriverID',$id);
        // Get the completed orders for the current week for the driver with the specified ID
        $data['completedOrders']= $order->findThisWeekCompletedOrders('DriverID',$id);
        // Get the delayed orders for the current month for the driver with the specified ID
        $data['delayedOrders']= $order->findThisMonthDelayedOrders('DriverID',$id);

        // If there are no orders for the current week, display a message
        if (empty($rows[0]))
        {
            echo "No orders";
        }

        // If the vehicle form is submitted, update the driver's vehicle type
        if(isset($_POST['vehicle'])){
            $vehicle =$_POST['vehicle'];
            $driver->update_type($id,['Vehicle_type'=>$vehicle]);
        }

        // Set the title of the page
        $data['title'] = "DASHBOARD";

        // Load the driver home page view with the data
        $this->view('driver/driver_home',$data);


    }
    public function profile($id = null)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        // If no ID is passed as a parameter, use the ID of the logg ed in user
        $id = $id ?? Auth::getEmployeeID();
        // Instantiate the Driver and Employees models
        $employee = new Employees();
        $data['row'] = $row = $employee->where('EmployeeID',$id);

        if($_SERVER['REQUEST_METHOD'] == 'POST' && $row)
        {
            // Create the uploads/images folder if it doesn't exist
            $folder = "uploads/images/";
            if(!file_exists($folder)){
                mkdir($folder,0777,true);
                file_put_contents($folder."index.php","<?php Access Denied.");
                file_put_contents("uploads/index.php","<?php Access Denied.");
            }

            // Validate the form input.
            if($employee->edit_validate($_POST,$id)){
                $allowedFileType = ['image/jpeg','image/png'];

                // If a new image has been uploaded.
                if(!empty($_FILES['Image']['name']))
                {
                    // Check if there was an error uploading the file.
                    if($_FILES['Image']['error'] == 0)
                    {
                        // Check if the file type is allowed.
                        if(in_array($_FILES['Image']['type'],$allowedFileType))
                        {
                            $destination = $folder.time().$_FILES['Image']['name'];
                            // Move the uploaded file to the uploads/images folder.
                            move_uploaded_file($_FILES['Image']['tmp_name'],$destination);

                            $_POST['Image'] = $destination;

                            // If the user already had a profile image, delete it.
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

        // Check if user is logged in, if not then redirect to login page
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        // Initialize the Orders class and get the employee ID
        $order = new Orders();

        $id = Auth::getEmployeeID();
        $employee = new Employees();

        // Get the employee details and set the page title
        $data['details'] = $row = $employee->where('EmployeeID',$id);
        $data['title'] = "ORDERS";

        // Get the orders for the driver and display them
        $data['row'] = $order->displayOrders('DriverID',$id);

        // If the user searched for an order, show the results
        if(isset($_GET['orders_items']))
        {
                $orders_items = $_GET['orders_items'];// don't care at the end
                $data['row'] = $result = $order->searchOrdersDetails('DriverID',$id,$orders_items);
                if(empty($result))
                {
                    $this->redirect('driver_home/order');
                }

        }

        // If the user selected a status filter, apply the filter and show the results
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

        // Load the view for the order page with the data
        $this->view('driver/order',$data);

    }

    public function delivered_orders($id = null)
    {

        // Check if the user is logged in.
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }
        // Create a new instance of the employee model.
        $order = new Orders();
        // Get the ID of the driver.
        $id = Auth::getEmployeeID();
        // Create a new instance of the employee model.
        $employee = new Employees();
        $data['details'] = $row = $employee->where('EmployeeID',$id);
        // Set the page title.
        $data['title'] = "ORDERS";

        // Display the delivered orders of the driver.
        $data['records1'] = $order->displayDeliveredOrders('DriverID',$id);

        // Search for delivered orders with specific details.
        if(isset($_GET['delivered_items']))
        {
            $orders_items = $_GET['delivered_items'];
            $data['records1'] = $result = $order->searchDeliveredOrdersDetails('DriverID',$id,$orders_items);

            // If no results were found, redirect to the delivered orders page.
            if(empty($result))
            {
                $this->redirect('driver_home/delivered_orders'.$id);
            }

        }

        // Load the view that displays the delivered orders table.
        $this->view('driver/includes/delivered_orders_table',$data);

    }

    public function orders_records($id = null)
    {

        // Redirects to login page if not logged in
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        // Initializes necessary variables
        $order = new Orders();

        $id = Auth::getEmployeeID();
        $employee = new Employees();
        $data['details'] = $row = $employee->where('EmployeeID',$id);
        $data['title'] = "ORDERS";

        // Displays the delivered orders of the logged-in driver
        $data['records2'] = $order->displayDeliveredOrders('DriverID',$id);

        // Filters the displayed delivered orders by date range and/or status
        if(isset($_POST['dateFilter'])){
            $status = $_POST['Status'];
            $from_date = $_POST['from_date'];
            $to_date = $_POST['to_date'];
            $data['records2'] = $order->filterRecords($status, $from_date, $to_date);
            if (empty($data['records2'])) {
                $this->redirect('driver_home/orders_records');
            }
        }

        // Loads the view to display the delivered orders history table
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

            // Check if an image file was selected
            if(!empty($_FILES["Image"]['name']))
            {

                // Create upload directory if it doesn't exist
                $folder = "uploads/driver/";
                if(!file_exists($folder)){
                    mkdir($folder,0777,true);
                    file_put_contents($folder."index.php","<?php Access Denied.");
                    file_put_contents("uploads/index.php","<?php Access Denied.");
                }

                $allowedFileType = ['image/jpeg','image/png'];

                // Check if selected file type is allowed
                if(in_array($_FILES['Image']['type'],$allowedFileType))
                {

                    // Check if no errors occurred during file upload
                    if($_FILES['Image']['error'] == 0)
                    {
                        $destination = $folder.time().$_FILES['Image']['name'];
                        // Move uploaded file to specified directory
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

        // Display success message or error messages
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
            $this->redirect('login');
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

    public function change_order_status($order_id)
    {

        $orderStatus = $_POST['status'];

        // Update the order status in the database
        $order = new Orders();
        $orderData = $order->where('OrderID',$order_id);

        if (!empty($orderData)) {

            $order->update($order_id,['OrderID'=>$order_id,'Order_status'=>$orderStatus]);

            echo "success";

        }
        else{

            echo "failed";

        }


    }

    public function pieData()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
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
            $this->redirect('login');
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
            $this->redirect('login');
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