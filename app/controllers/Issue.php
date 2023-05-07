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
                        $issue->insertImages($_POST['IssueID'], $images);

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
    
}

