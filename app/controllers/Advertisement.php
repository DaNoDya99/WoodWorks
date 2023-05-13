<?php

class Advertisement extends Controller{

    private function getUser()
    {
        $customer = new Customer();
        $id = Auth::getCustomerID();
        return $customer->where('CustomerID',$id);
    }
    public function insertRefurnishedFurniture(){
        
        $advertisements = new Advertisements();
        $id = $id ?? Auth::getEmployeeID();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST['Manager'] = $id;
            if($advertisements->validate($_POST)){
                $advertisements->insert($_POST);

                $folder = "uploads/images/";
                $allowedFileType = ['image/jpeg', 'image/png'];
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                    file_put_contents($folder . "index.php", "<?php Access Denied.");
                    file_put_contents("uploads/index.php", "<?php Access Denied.");
                }
                $images = array();

                if (!empty($_FILES['Images']['name']) && !empty($_FILES['PrimaryImage']['name'])) {

                    if (count(array_unique($_FILES['Images']['error'])) === 1 && end($_FILES['Images']['error']) === 0 && $_FILES['PrimaryImage']['error'] === 0) {

                        $flag = true;

                        foreach ($_FILES['Images']['type'] as $type) {
                            if (!in_array($type, $allowedFileType)) {
                                $flag = false;
                            }
                        }

                        if (!in_array($_FILES['PrimaryImage']['type'], $allowedFileType)) {
                            $flag = false;
                        }

                        if ($flag) {
                            for ($i = 0; $i < 2; $i++) {
                                $destination = $folder . time() . $_FILES['Images']['name'][$i];
                                $images[$i] = $destination;
                                move_uploaded_file($_FILES['Images']['tmp_name'][$i], $destination);
                            }
                            $destination = $folder . time() . 'primary' . $_FILES['PrimaryImage']['name'];
                            $images[2] = $destination;
                            move_uploaded_file($_FILES['PrimaryImage']['tmp_name'], $destination);

                            $advertisements->insertImages($_POST['AdvertisementID'], $images);
                        } else{
                            $advertisements->errors['Image'] = "File type must be jpeg or png.";
                        }
                    }else{
                        $advertisements->errors['Image'] = "Error occurred in images.";
                    }
                }else{
                    $advertisements->errors['Image'] = "Select primary and secondary images.";
                }
            
            }
        }

        $errors = $advertisements->errors;

        if(!empty($errors))
        {
            $stm = '<img class="close-error" src="http://localhost/WoodWorks/public/assets/images/customer/close.png" alt="Close btn" onclick="close_error()">
                        <ul>';
            foreach($errors as $error){
                $stm .= "<li>".$error."</li>";
            }

            $stm .= "</ul>";
            echo $stm;
        }else{
            echo "<h1>Furniture successfully added.</h1>";
        }
    }

    public function details($id=null)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $advertisements = new Advertisements(); 

        $data['primary_image'] = $advertisements->getDisplayImage($id);
        $data['secondary_images'] = $advertisements->getSecondaryImages($id);
        $data['furniture'] = $advertisements->getRefurnishedFurnityreById($id)[0];

        $this->view('manager/refurnished_fur_details',$data);
    }

    public function getAdDetails($id)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $advertisements = new Advertisements();

        $row = $advertisements->getRefurnishedFurnityreById($id)[0];

        if(!empty($row))
        {
            $data = [
                'primary_image' => $advertisements->getDisplayImage($id)[0]->Image,
                'secondary_image1' => $advertisements->getSecondaryImages($id)[0]->Image,
                'secondary_image2' => $advertisements->getSecondaryImages($id)[1]->Image,
                'advertisement_id' => $row->AdvertisementID,
                'name' => $row->Product_name,
                'price' => $row->Price,
                'description' => $row->Description,
                'quantity' => $row->Quantity,
            ];

            echo json_encode($data);
        }else{
            echo "error";
        }

    }

    public function updateRefurnishedFurniture($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $advertisements = new Advertisements();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST['AdvertisementID'] = $id;
            if ($advertisements->validate($_POST)) {
                $advertisements->update($id, $_POST);

                $folder = "uploads/images/";
                $allowedFileType = ['image/jpeg', 'image/png'];
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                    file_put_contents($folder . "index.php", "<?php Access Denied.");
                    file_put_contents("uploads/index.php", "<?php Access Denied.");
                }
                $secondary_images = array();
                $primary_image = "";

                if (!empty($_FILES['Images']['name']) || !empty($_FILES['PrimaryImage']['name'])) {

                    if (count(array_unique($_FILES['Images']['error'])) === 1 && end($_FILES['Images']['error']) === 0 || $_FILES['PrimaryImage']['error'] === 0) {

                        $flag = true;

                        if (!empty($_FILES['Images']['name'])) {
                            foreach ($_FILES['Images']['type'] as $type) {
                                if (!in_array($type, $allowedFileType)) {
                                    $flag = false;
                                }
                            }
                        }

                        if (!empty($_FILES['PrimaryImage']['name'])) {
                            if (!in_array($_FILES['PrimaryImage']['type'], $allowedFileType)) {
                                $flag = false;
                            }
                        }

                        echo json_encode($_FILES);

                        if ($flag) {
                            if (!empty($_FILES['Images']['name'])) {
                                for ($i = 0; $i < 2; $i++) {
                                    $destination = $folder . time() . $_FILES['Images']['name'][$i];
                                    $secondary_images[$i] = $destination;
                                    move_uploaded_file($_FILES['Images']['tmp_name'][$i], $destination);
                                }
                                $i = 0;
                                $existing_secondary_images = $advertisements->getSecondaryImages($id);
                                foreach ($existing_secondary_images as $image) {
                                    $advertisements->updateImages($id, $secondary_images[$i], $image->Image);
                                    unlink($image->Image);
                                }
                            }

                            if (!empty($_FILES['PrimaryImage']['name'])) {
                                $destination = $folder . time() . 'primary' . $_FILES['PrimaryImage']['name'];
                                $primary_image = $destination;
                                move_uploaded_file($_FILES['PrimaryImage']['tmp_name'], $destination);

                                $existing_primary_image = $advertisements->getDisplayImage($id)[0]->Image;
                                $advertisements->updateImages($id, $primary_image, $existing_primary_image);
                                unlink($existing_primary_image);
                            }


                        } else {
                            $advertisements->errors['Image'] = "File type must be jpeg or png.";
                        }
                    } else {
                        $advertisements->errors['Image'] = "Error occurred in images.";
                    }
                } else {
                    $advertisements->errors['Image'] = "Select primary and secondary images.";
                }
            }
        }

        $errors = $advertisements->errors;
        if (empty(!$errors)) {
            echo "success";
        }else{
            echo "error";
        }
    }

    public function deleteRefurnishedFurniture($id)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $advertisements = new Advertisements();
        $images = $advertisements->getDisplayImage($id)[0]->Image;
        $secondary_images = $advertisements->getSecondaryImages($id);

        unlink($images);

        if(!empty($secondary_images))
        {
            foreach($secondary_images as $image)
            {
                unlink($image->Image);
            }
        }

        $row = $advertisements->delete($id);

        if(empty($row))
        {
            echo "success";
        }else{
            echo "error";
        }
    }

    function viewAdvertisements()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }
        $limit = 8;

        $pager = new Pager($limit);
        $offset = $pager->offset;

        $advertisements = new Advertisements();
        $rows = $advertisements->getRefurbishedFurniture($limit,$offset);

        foreach ($rows as $row) {
            $row->ProductID = $row->AdvertisementID;
            $row->Name = $row->Product_name;
            $row->Cost = $row->Price;
            $row->Discount_percentage = '';
            $row->Active = '';
            $row->Rate = 0;
            $row->Image = $advertisements->getDisplayImage($row->AdvertisementID)[0]->Image;
        }

        $data['row'] = $this->getUser();
        $data['furniture'] = $rows;
        $data['sub_categories'] = 'Refurbished Furniture';
        $data['pager'] = $pager;
        $data['flag'] = 'rf';

        $this->view('reg_customer/sub_category',$data);
    }

    public function view_product($id,$page)
    {

        $advertisement = new Advertisements();
        $row = $advertisement->getRefurnishedFurnityreById($id);

        if(!empty($row))
        {
            $row[0]->ProductID = $row[0]->AdvertisementID;
            $row[0]->Name = $row[0]->Product_name;
            $row[0]->Cost = $row[0]->Price;
            $row[0]->Discount_percentage = '';
            $row[0]->Active = '';
            $row[0]->Rate = 0;
            $row[0]->Warrenty_period = '';
            $row[0]->Availability = 1;
        }

        $data['row'] = $this->getUser();
        $data['furniture'] = $row;
        $data['rating'] = 0;
        $data['images'] = $advertisement->getRefurnishedFurnitureImages($id);
        $data['reviews'] = [];
        $data['flag'] = 'rf';

        if($page === 'registered')
        {
            $this->view('reg_customer/advertisement',$data);
        }else if($page === 'unregistered'){
            $this->view('advertisement',$data);
        }
    }

}