<?php

class Inventory extends Controller
{
    public function index()
    {

    }

    public function add()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $furniture = [
            'ProductID' => $_POST['ProductID'],
            'Name' => $_POST['Name'],
            'Description' => $_POST['Description'],
            'CategoryID' => $_POST['CategoryID'],
            'Sub_category_name' => $_POST['Sub_category_name'],
            'SupplierID' => $_POST['SupplierID'],
            'Quantity' => $_POST['Quantity'],
            'Cost' => $_POST['Retail_price'],
            'Warrenty_period' => $_POST['Warrenty_period'],
            'Wood_type' => $_POST['Wood_type'],
        ];

        $inventory = [
            'ProductID' => $_POST['ProductID'],
            'Quantity' => $_POST['Quantity'],
            'Reorder_point' => $_POST['Reorder_point'],
            'Last_ordered' => '',
            'Last_received' => '',
            'Cost' => $_POST['Cost'],
            'Retail_price' => $_POST['Retail_price'],
            'Created_at' => date('Y-m-d'),
            'Updated_at' => date('Y-m-d'),
        ];

        if($_POST['Quantity']>0) {
            $inventory['Status'] = 'In Stock';
        } else {
            $inventory['Status'] = 'Out of Stock';
        }

        if($_POST['Quantity']<$_POST['Reorder_point']) {
            $inventory['Reorder_flag'] = 1;
        } else {
            $inventory['Reorder_flag'] = 0;
        }

        $inventory_model = new Product_Inventory();
        $furniture_model = new Furnitures();

        if($inventory_model->validate($inventory) && $furniture_model->validate($furniture))
        {
            $folder = "uploads/images/";
            if(!file_exists($folder)){
                mkdir($folder,0777,true);
                file_put_contents($folder."index.php","<?php Access Denied.");
                file_put_contents("uploads/index.php","<?php Access Denied.");
            }

            $allowedFileType = ['image/jpeg','image/png'];

            if(!empty($_FILES['PrimaryImage']['name']) && !empty($_FILES['Images']['name']))
            {
                if($_FILES['PrimaryImage']['error'] == 0 && $_FILES['Images']['error'][0] == 0 && $_FILES['Images']['error'][1] == 0){

                    $fileType1 = $_FILES['PrimaryImage']['type'];
                    $fileType2 = $_FILES['Images']['type'];

                    if(in_array($fileType1,$allowedFileType) && in_array($fileType2[0],$allowedFileType) && in_array($fileType2[1],$allowedFileType))
                    {
                        $destination1 = $folder.time().'primary'.$_FILES['PrimaryImage']['name'];
                        $destination2 = $folder.time().$_FILES['Images']['name'][0];
                        $destination3 = $folder.time().$_FILES['Images']['name'][1];

                        $images[0] = $destination1;
                        $images[1] = $destination2;
                        $images[2] = $destination3;

                        move_uploaded_file($_FILES['PrimaryImage']['tmp_name'],$destination1);
                        move_uploaded_file($_FILES['Images']['tmp_name'][0],$destination2);
                        move_uploaded_file($_FILES['Images']['tmp_name'][1],$destination3);

                        $furniture_model->insert($furniture);
                        $furniture_model->insertImages($furniture['ProductID'],$images);
                        $inventory_model->insert($inventory);
                    }else{
                        $furniture_model->errors['Images'] = "Invalid File Type";
                    }
                }else{
                    $furniture_model->errors['Images'] = "Error Uploading File";
                }
            }else{
                $furniture_model->errors['Images'] = "Please Select Images";
            }
        }



        $errors = array_merge($furniture_model->errors,$inventory_model->errors);

        if(!empty($errors)) {
            $stm = "
            <div  class='error-txt signup-error'>
                <img class='close-error' src='" . ROOT . "/assets/images/customer/close.png' alt='Close btn' onclick='close_error()'>
                    <ul>
            ";

            foreach ($errors as $error) {
                $stm .= "<li>$error</li>";
            }

            $stm .= "</ul></div>";
            echo $stm;
        }else{
            echo "<div class='cat-success'><h3>Successfully Added.</h3>";
        }

    }
}