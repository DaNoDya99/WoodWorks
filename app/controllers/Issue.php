<?php

class Issue extends Controller
{
    public function index(){

    }

    public function addIssue($order_id)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $issue = new Issues();
            $_POST['IssueID'] = $issue->generateIssueID();
            $_POST['CustomerID'] = Auth::getCustomerID();
            $_POST['OrderID'] = $order_id;
            $_POST['Reported_date'] = date('Y-m-d H:i:s');

            $folder = "uploads/images/";
            $allowedFileType = ['image/jpeg', 'image/png'];

            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
                file_put_contents($folder . "index.php", "<?php Access Denied.");
                file_put_contents("uploads/index.php", "<?php Access Denied.");
            }

            if($_FILES['Images']['name'][0] == '')
            {
                $issue->insert($_POST);
                echo "success";
                return;
            }

            if(count($_FILES['Images']['name']) <= 5)
            {

                if(count(array_unique($_FILES['Images']['error'])) === 1 && end($_FILES['Images']['error']) === 0){
                    $flag = true;
                    foreach ($_FILES['Images']['type'] as $type) {
                        if (!in_array($type, $allowedFileType)) {
                            $flag = false;
                        }
                    }
                    if ($flag) {
                        $images = array();
                        for ($i = 0; $i < count($_FILES['Images']['name']); $i++) {
                            $destination = $folder . time() . $_FILES['Images']['name'][$i];
                            $images[$i] = $destination;
                            move_uploaded_file($_FILES['Images']['tmp_name'][$i], $destination);
                        }
                        $issue->insert($_POST);

                        if(count($images) > 0)
                        {
                            $issue->insertImages($_POST['IssueID'], $images);
                        }

                        echo "success";

                    }else{
                        echo "&nbsp *File type must be jpeg or png.";
                    }

                }else{
                    echo "&nbsp *Error occurred in images.";
                }
            }else{
                echo "&nbsp *Maximum 5 images can be uploaded.";
            }

        }
    }

    public function getIssuesReportedForTheOrder($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $issue = new Issues();

        $issues = $issue->getIssuesReportedForTheOrder($id);

        $stm = '';

        if(empty($issues))
        {
            $stm .= "
                <tr>
                    <td colspan='5' style='text-align: center'>No Issues Reported</td>
                </tr>
            ";

            echo $stm;
            return;
        }

        foreach ($issues as $issue) {

            if($issue->Response == '')
            {
                $response = 'Not Responded Yet';
            }else{
                $response = 'Responded';
            }

            $stm .= "
                 <tr>
                    <td><input type='radio' name='IssueID' value='$issue->IssueID' onclick='getIssueDetails(`".$issue->IssueID."`)'></td>
                    <td>$issue->IssueID</td>
                    <td>".explode(' ',$issue->Reported_date)[0]."</td>
                    <td>$response</td>
                    <td>
                        <div class='inv-table-btns'>
                            <button style='margin-top: unset' onclick='deleteIssue(`$issue->IssueID`)'><img src='http://localhost/WoodWorks/public/assets/images/admin/delete-svgrepo-com.svg' alt=''></button>
                        </div>
                    </td>
                </tr>
            ";
        }
        echo $stm;

    }

    public function getIssueDetails($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $issue = new Issues();

        $issue_details = $issue->getIssueDetails($id)[0];
        $issue_images = $issue->getIssueImages($id);

        $stm = "<div class='issue-details-header'>
                <h3>$id</h3>
            </div>
            <div class='issue-images-container'>";

        if(!empty($issue_images)){
            foreach ($issue_images as $image) {
                $stm .= "<img src='http://localhost/WoodWorks/public/".$image->Image."' alt=''>";
            }
        }else{
            $stm .= "No Images Uploaded";
        }

        $stm .= "</div>";

        if(empty($issue_details->Response))
        {
            $response = 'Not Responded Yet';
        }else{
            $response = $issue_details->Response;
        }

        $stm .= "
            <div class='issue-description-container'>
                <span>Issue Description:</span>
                <p>$issue_details->Problem_statement</p>
            </div>
            <div class='issue-description-container'>
                <span>Company Response:</span>
                <p>$response</p>
            </div>
        ";

        echo $stm;
    }

    public function deleteIssue($id)
    {
        if(!Auth::logged_in()){
            $this->redirect('login');
        }

        $issue = new Issues();
        $images = $issue->getIssueImages($id);

        if(!empty($images))
        {
            foreach($images as $image)
            {
                unlink($image->Image);
            }
        }

        $issue->deleteIssue($id);

        echo "success";
    }

    function getPendingIssueDetails($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }


        $issue = new Issues();
        $order = new Orders();
        $order_item = new Order_Items();
        $issue_details = $issue->getIssuesDetails($id)[0];
        $issue_images = $issue->getIssueImages($id);
        $order_details = $order->getOrderDetails($issue_details->OrderID)[0];
        $order_item_details = $order_item->getOrderItems($issue_details->OrderID);

        $stm = "
            <div class='order-details'>
                <div class='order-heading'>
                    <h4>Order ID : <span style='font-weight: normal; font-size: 0.9rem'>$issue_details->OrderID</span></h4>
                    <h4>Date : <span style='font-weight: normal; font-size: 0.9rem'>$order_details->Date</span></h4>

                    <table class='order-items-table'>
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Warranty</th>
                            </tr>
                        </thead>
                        <tbody>";

        foreach ($order_item_details as $item) {
            $stm .= "
                            <tr>
                                <td>$item->ProductID</td>
                                <td>$item->Name</td>
                                <td>$item->Quantity</td>
                                <td>$item->Warrenty_period</td>
                            </tr>
            ";
        }

        $stm .= "
                        </tbody>
                    </table>

                    <div class='order-payment-details'>
                        <div class='row'>
                            <h4>Sub Total</h4>
                            <span>Rs ".$order_details->Total_amount.".00</span>
                        </div>
                        <div class='row'>
                            <h4>Discount Obtained</h4>
                            <span>- Rs ".$order_details->Discount_obtained.".00</span>
                        </div>
                        <div class='row' style='border-bottom: 2px solid #f1f1f1'>
                            <h4>Delivery Charge</h4>
                            <span>Rs ".$order_details->Shipping_cost.".00</span>
                        </div>
                        <div class='row'>
                            <h4>Total</h4>
                            <span>Rs ".$order_details->Total_amount + $order_details->Shipping_cost - $order_details->Discount_obtained.".00</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class='issue-details'>
                <h3>Issue Details</h3>

                <div class='issue-images-container'>
                    <span>Reported Images:</span>
                    <div class='issue-images '>
        ";

        if(!empty($issue_images)){
            $i = 1;
            $issue_image = "issue-image".$i;
            foreach ($issue_images as $image) {
                $stm .= "<img src='http://localhost/WoodWorks/public/$image->Image' alt='' onclick='displayImage(`".$issue_image."`)'>
                        <div class='image-popup' id='$issue_image'>
                            <img class='close-image' src='http://localhost/WoodWorks/public/assets/images/customer/close.png' alt='Close' onclick='closeImage(`".$issue_image."`)'>
                            <img src='http://localhost/WoodWorks/public/$image->Image' alt=''>
                        </div>";
                $i++;

                $issue_image = "issue-image".$i;
            }
        }else{
            $stm .= "No Images Uploaded";
        }


        $stm .= "
                    </div>
                </div>
                <div class='issue-description-container'>
                    <span>Issue Description:</span>
                    <p>$issue_details->Problem_statement</p>
                </div>
                <div class='issue-description-container'>
                    <span>Company Response: <span class='dis-err' id='response-error'></span></span>
                    <textarea name='Response' id='response' cols='30' rows='6'>$issue_details->Response</textarea>
                </div>
                <div class='response-btn'>
                    <button class='btn btn-primary' onclick='saveResponse(`".$id."`)'>Save Response</button>
                </div>
            </div>";

        echo $stm;
    }

    public function saveResponse()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $issue = new Issues();
        $_POST['ManagerID'] = Auth::getEmployeeID();
        $issue->saveResponse($_POST);

        echo "success";
    }

    public function getRespondedIssues()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $issue = new Issues();
        $customer = new Customer();
        $employee = new Employees();
        $issues = $issue->getRespondedIssues();


        if(!empty($issues)){
            foreach ($issues as $issue) {
                $customer_details = $customer->getCustomerByID($issue->CustomerID)[0];
                $employee_details = $employee->getEmployeeByID($issue->ManagerID)[0];
                $manager_name = $employee_details->Firstname." ".$employee_details->Lastname;

                $issue->First_name = $customer_details->Firstname;
                $issue->Last_name = $customer_details->Lastname;
                $issue->Email = $customer_details->Email;
                $issue->Contact_number = $customer_details->Mobileno;
                $issue->Manager = $manager_name;
            }

            foreach ($issues as $issue) {
                $stm = "
                    <tr>
                        <td>$issue->IssueID</td>
                        <td>".substr($issue->OrderID,0,8)."</td>
                        <td>$issue->First_name $issue->Last_name</td>
                        <td>$issue->Contact_number</td>
                        <td>$issue->Email</td>
                        <td>$issue->Reported_date</td>
                        <td>$issue->Responded_date</td>
                        <td>$issue->Manager</td>
                        <td>
                            <div class='inv-table-btns manager-btns'>
                                <button onclick='getIssueInfo(`".$issue->IssueID."`)'><img src='http://localhost/WoodWorks/public/assets/images/manager/info-svgrepo-com.svg' alt=''></button>
                            </div>
                        </td>
                    </tr>
                ";

                echo $stm;
            }
        }else{
            echo "
                <tr>
                    <td colspan='9' style='text-align: center'>No Responded Issues Found</td>
                </tr>
            ";
        }
    }
}

