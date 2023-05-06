<?php

class Advertisement extends Controller{

    

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
        echo json_encode($_FILES['Images']);
    }

    public function deleteRefurnishedFurniture($id)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $advertisements = new Advertisements();
        $row = $advertisements->delete($id);

        if(empty($row))
        {
            echo "success";
        }else{
            echo "error";
        }
    }
}