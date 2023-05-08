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
}

