<?php

class Designer extends Controller
{
    public function index()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login3');
        }

        $data['title'] = "DASHBOARD";

        $this->view('designer/dashboard',$data);

    }
    public function profile($id = null)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login3');
        }

        $id = $id ?? Auth::getEmployeeID();
        $employee = new Employee();
        $data['row'] = $row = $employee->where('EmployeeID',$id);
//        show($id);

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
                $this->redirect('designer/profile/'.$id);
            }
        }

        $data['title'] = "PROFILE";
        $data['errors'] = $employee->errors;

        $this->view('designer/profile',$data);

    }
    public function design()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login3');
        }

        $employee = new Employee();
        $data['rows'] = $employee->query("SELECT * FROM design INNER JOIN design_images ON design.DesignID = design_images.DesignID GROUP BY design.DesignID;");

        $data['title'] = "DESIGNS";
        $this->view('designer/design',$data);

    }

    public function add_design($id=null)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login3');
        }

        $folder = "uploads/images/";
        $id = $id ?? Auth::getEmployeeID();
        $employee = new Employee();
        $data['row'] = $row = $employee->where('EmployeeID', $id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $row)
        {

            if ($employee->validate($_POST))
            {
//                $destination = $folder . "user.png";
//                copy(ROOT . "assets/images/designer/user.png", $destination);
//                $_POST['Image'] = $destination;
//                $employee->insert($_POST);
                $this->redirect('designer/design');
            }

        }

        $data['errors'] = $employee->errors;
        $data['title'] = "ADD DESIGNS";

        $this->view('designer/includes/add_design',$data);
    }


    public function add_new_design($id=null)
    {

        if(!Auth::logged_in())
        {
            $this->redirect('login3');
        }

        $id = $id ?? Auth::getEmployeeID();
        $employee = new Employee();
        $design_images = new Design_images();
        $data['row'] = $row = $employee->where('EmployeeID',$id);

        $design = new Design();


//        show($design_row);

        if($_SERVER['REQUEST_METHOD'] == "POST" && $row) {


            $images = $_FILES['images'];
            $num_of_imgs = count($images['name']); //number of images
            $_POST['EmployeeID'] = $id;

            for ($i = 0; $i < $num_of_imgs; $i++)
            {

                $image_name = $images['name'][$i];
                $tmp_name = $images['tmp_name'][$i];
                $error = $images['error'][$i];



                $folder = "uploads/designer/images/";

                if (!file_exists($folder))
                {
                    mkdir($folder, 0777, true);
                    file_put_contents($folder . "index.php", "<?php //silence");
                    file_put_contents("uploads/designer/index.php", "<?php //silence");
                }

                if (!empty($image_name))
                {

                    if ($error === 0)
                    {

                        $img_ex = pathinfo($image_name, PATHINFO_EXTENSION);// image extension
                        $img_ex_lc = strtolower($img_ex); // image extension lowercase
                        $allowed_exs = array('jpg', 'jpeg', 'png');// allowed extensions

                        if (in_array($img_ex_lc, $allowed_exs))
                        {

                            $new_img_name = uniqid('IMG-',true).'.'.$img_ex_lc;// unique image names
                            $destination = $folder . time() . $new_img_name;
//                            show($new_img_name);
                            move_uploaded_file($tmp_name, $destination);

                            if($i == 0)
                            {
                                $design->insert($_POST); // it must run only one time
                            }
                            //$query = "INSERT INTO design_images (Image) VALUES (?)";

                            $data['design_row'] = $design_row = $design->first('EmployeeID',$id);
                            $designID = $design_row[0]->DesignID;

                            $design_images->insert (['DesignID'=>$designID,'Image'=>$destination]);
//                            $this->redirect('designer/design');

                        }
                        else
                        {
                            $employee->errors['image'] = "This file type is not allowed";
                        }
                    }
                    else
                    {
                        $employee->errors['image'] = "Could not upload image";
                    }

                }

            }

            $data['title'] = "Add Design";
            $this->redirect('designer/design');
            $this->view('designer/design', $data);
        }

    }

}
