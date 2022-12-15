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
        $data['rows'] = $design->getDesigns($limit,$offset);

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

        $employee = new Employee();
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
        $employee = new Employee();
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
        $employee = new Employee();
        $design_images = new Design_image();
        $data['row'] = $row = $employee->where('EmployeeID',$id);

        $design = new Design();

        if($_SERVER['REQUEST_METHOD'] == "POST" && $row) {

            if ($design->validate($_POST)) {


                $images = $_FILES['images'];
                $num_of_imgs = count($images['name']); //number of images
                $_POST['EmployeeID'] = $id;

                for ($i = 0; $i < $num_of_imgs; $i++) {

                    $image_name = $images['name'][$i];
                    $tmp_name = $images['tmp_name'][$i];
                    $error = $images['error'][$i];


                    $folder = "uploads/designer/images/";

                    if (!file_exists($folder)) {
                        mkdir($folder, 0777, true);
                        file_put_contents($folder . "index.php", "<?php //silence");
                        file_put_contents("uploads/designer/index.php", "<?php //silence");
                    }

                    if (!empty($image_name)) {

                        if ($error === 0) {

                            $img_ex = pathinfo($image_name, PATHINFO_EXTENSION);// image extension
                            $img_ex_lc = strtolower($img_ex); // image extension lowercase
                            $allowed_exs = array('jpg', 'jpeg', 'png');// allowed extensions

                            if (in_array($img_ex_lc, $allowed_exs)) {

                                $new_img_name = uniqid('IMG-', true) . '.' . $img_ex_lc;// unique image names
                                $destination = $folder . time() . $new_img_name;
//                            show($new_img_name);
                                move_uploaded_file($tmp_name, $destination);

                                if ($i == 0) {
                                    $design->insert($_POST); // it must run only one time
                                }
                                //$query = "INSERT INTO design_images (Image) VALUES (?)";

                                $data['design_row'] = $design_row = $design->first('EmployeeID', $id);
                                $designID = $design_row[0]->DesignID;

                                $design_images->insert(['DesignID' => $designID, 'Image' => $destination]);
//                            $this->redirect('designer/design');

                            } else {
                                $employee->errors['image'] = "This file type is not allowed";
                            }
                        } else {
                            $employee->errors['image'] = "Could not upload image";
                        }

                    }

                }

                $data['title'] = "Add Design";
                $this->redirect('designer/design');
                $this->view('designer/design', $data);
            }
            else
            {
                $data['title'] = "Add Design";
                $data['errors'] = $design->errors;
                $this->view('designer/includes/add_design',$data);
            }

        }

    }
    public function pieData()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login3');
        }

        header('Content-Type: application/json');

        $order = new Order();

        $rows =  $order->query("SELECT COUNT(OrderID) AS numOrders,Order_status FROM `order` GROUP BY Order_status ");

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

        $order = new Order();

        $rows =  $order->query("SELECT cast(Date as date) AS Date, count(OrderID) AS numOrders FROM `order` WHERE NOT Order_status = 'delivered' GROUP BY cast(Date as date)");

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

        $id = Auth::getEmployeeID();

        header('Content-Type: application/json');

        $order = new Order();

        $rows =  $order->query("SELECT cast(Date as date) AS Date, count(DesignID) AS numDesigns FROM `design` WHERE EmployeeID = '$id' GROUP BY cast(Date as date) ORDER BY Date ASC");

        $data = array();

        foreach ($rows as $row){
            $data[] = $row;
        }

        print json_encode($data);

    }
}
