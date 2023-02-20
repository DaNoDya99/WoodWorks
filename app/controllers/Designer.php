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
        $id = Auth::getEmployeeID();

        $design = new Design();
        $employee = new Employees();
        $data['row'] = $employee->where("EmployeeID",$id);

        $limit = 8;

        $data['rows'] = $design->getDesign($limit);

        if(!empty($data['rows'])) {

            foreach ($data['rows'] as $row) {
                $row->Image = $design->getDisplayImage($row->DesignID)[0]->Image;
            }
        }

        $this->view('designer/dashboard',$data);

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

        $limit = 3;
        $pager = new Pager($limit);
        $offset = $pager->offset;
        $data['pager'] = $pager;

        $design = new Design();
        $employee = new Employees();
        $id = $id ?? Auth::getEmployeeID();
        $data['row'] = $employee->where("EmployeeID",$id);
        $data['rows'] = $design->getDesigns($offset,$limit);

        if(!empty($data['rows'])) {

            foreach ($data['rows'] as $row) {
                $row->Image = $design->getDisplayImage($row->DesignID)[0]->Image;
            }
        }

        $data['title'] = "DESIGNS";
        $this->view('designer/design',$data);

    }

    public function view_design($id = null)
    {

        if(!Auth::logged_in())
        {
            $this->redirect('login1');
        }

        $employee = new Employees();
        $emp_id = Auth::getEmployeeID();

        $design = new Design();
        $design_image = new Design_image();

        $data['title'] = "Design View";
        $data['row'] = $employee->where('EmployeeID',$emp_id);
        $data['design'] = $design->viewDesign($id);
        $data['images'] = $design->getAllImages($id);

        $this->view("designer/design_description", $data);
    }

    public function add_design($id=null)
    {

        if (!Auth::logged_in())
        {
            $this->redirect('login3');
        }

        $id = $id ?? Auth::getEmployeeID();
        $employee = new Employees();
        $data['row'] = $row = $employee->where('EmployeeID', $id);

        if ($_SERVER['REQUEST_METHOD'] == 'GET' && $row)
        {

            $data['errors'] = $employee->errors;
            $data['title'] = "ADD DESIGNS";

            $this->view('designer/includes/add_design',$data);

        }

    }

    public function add_new_design($id=null)
    {

        if(!Auth::logged_in())
        {
            $this->redirect('login3');
        }

        $id = $id ?? Auth::getEmployeeID();
        $employee = new Employees();
        $design_images = new Design_image();
        $data['row'] = $row = $employee->where('EmployeeID',$id);

        $design = new Design();

        if($_SERVER['REQUEST_METHOD'] == "POST" && $row) {

            if ($design->validate($_POST)) {


                $images = $_FILES['images'];
                $num_of_imgs = count($images['name']); //number of images
                $_POST['DesignerID'] = $id;

                //loop through all images
                for ($i = 0; $i < $num_of_imgs; $i++) {

                    $image_name = $images['name'][$i];
                    $tmp_name = $images['tmp_name'][$i];
                    $error = $images['error'][$i];

                    $folder = "uploads/designer/images/";

                    //check if folder exists
                    if (!file_exists($folder)) {
                        mkdir($folder, 0777, true);
                        file_put_contents($folder . "index.php", "<?php //silence");
                        file_put_contents("uploads/designer/index.php", "<?php //silence");
                    }

                    //check if there is an image
                    if (!empty($image_name)) {

                        //check if there is no error
                        // $error === 0 means no error
                        if (count(array_unique($_FILES['images']['error'])) === 1 && end($_FILES['images']['error']) === 0) {

                            $img_ex = pathinfo($image_name, PATHINFO_EXTENSION);// image extension
                            $img_ex_lc = strtolower($img_ex); // image extension lowercase
                            $allowed_exs = array('jpg', 'jpeg', 'png');// allowed extensions

//                           show($img_ex_lc);

                            if (in_array($img_ex_lc, $allowed_exs)) {

                                $new_img_name = uniqid('IMG-', true) . '.' . $img_ex_lc;// unique image names
                                $destination = $folder . time() . $new_img_name;// image destination
                                move_uploaded_file($tmp_name, $destination);// move image to destination

                                //insert into database
                                if ($i == 0) {
                                    $design->insert($_POST); // it must run only one time
                                }
                                $data['design_row'] = $design_row = $design->first('DesignerID', $id);
                                $designID = $design_row[0]->DesignID;

                                $design_images->insert(['DesignID' => $designID, 'Image' => $destination]);

                            } else {
                                $design->errors['image'] = "This file type is not allowed";
                            }
                        } else {
                            $design->errors['image'] = "Could not upload image";
                        }
                    }else {
                        $design->errors['image'] = "Please select the images";
                    }

                }

            }

        }
        $data['errors'] = $design->errors;
        $this->view('designer/includes/add_design',$data);
    }

    public function remove_add_design($id=null)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $design = new Design();
        $design_images = new Design_image();

        if(isset($_POST['delete_btn'])){
            $design->deleteDesign($id);
            $design_images->deleteImage($id);
            $this->redirect('designer/design');
        }

        $this->redirect('designer/design');
    }

    public function chat()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $id = $id ?? Auth::getEmployeeID();
        $employee = new Employees();

        $data['row'] = $employee->where('EmployeeID',$id);
        $data['title'] = "CHAT";

        $this->view('designer/chat',$data);
    }

    public function barData()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login3');
        }

        $id = Auth::getEmployeeID();

        header('Content-Type: application/json');

        $order = new Order();

        $rows =  $order->query("SELECT cast(Date as date) AS Date, count(DesignID) AS numDesigns FROM `design` WHERE DesignerID = '$id' GROUP BY cast(Date as date) ORDER BY Date ASC");

        $data = array();

        foreach ($rows as $row){
            $data[] = $row;
        }

        print json_encode($data);

    }
}
