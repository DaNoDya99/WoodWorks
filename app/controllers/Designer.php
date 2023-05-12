<?php

class Designer extends Controller
{

    private function getUser()
    {
        $employee = new Employees();
        $id = Auth::getEmployeeID();
        return $employee->where("EmployeeID",$id);
    }

    public function index()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $data['title'] = "DASHBOARD";
        $id = Auth::getEmployeeID();

        $design = new Design();

        $limit = 7;

        $data['rows'] = $design->getDesign("DesignerID",$id,$limit);

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
            $this->redirect('login');
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

    public function design($CatID = null)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $limit = 5;
        $pager = new Pager($limit);
        $offset = $pager->offset;
        $data['pager'] = $pager;

        $design = new Design();
        $employee = new Employees();
        $id = $id ?? Auth::getEmployeeID();
        $data['row'] = $employee->where("EmployeeID",$id);
        $data['rows'] = $design->getDesigns($CatID,$offset,$limit);

        if(!empty($data['rows'])) {

            foreach ($data['rows'] as $row) {
                $row->Image = $design->getDisplayImage($row->DesignID)[0]->Image;
            }
        }

        $data['title'] = "DESIGNS";
        $this->view('designer/design_subcategory',$data);

    }

    public function view_design_categories(){

        if(!Auth::logged_in())
        {
            $this->redirect('login1');
        }

        $limit = 10;
        $categories = new Categories();
        $data['row'] = $this->getUser();
        $data['categories'] = $categories->getDesignCategories($limit);

        $this->view("designer/design_category",$data);
    }

    public function view_design($id = null)
    {

        if(!Auth::logged_in())
        {
            $this->redirect('login');
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
            $this->redirect('login');
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
            $this->redirect('login');
        }

        $id = $id ?? Auth::getEmployeeID();
        $employee = new Employees();
        $design_images = new Design_image();
        $data['row'] = $row = $employee->where('EmployeeID',$id);

        $design = new Design();

        if($_SERVER['REQUEST_METHOD'] == "POST" && $row) {

            if ($design->validate($_POST)) {

                $images = $_FILES['images'];
                $pdf_file = $_FILES['pdfFile-input'];
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

                            if (in_array($img_ex_lc, $allowed_exs)) {

                                $new_img_name = uniqid('IMG-', true) . '.' . $img_ex_lc;// unique image names
                                $destination = $folder . time() . $new_img_name;// image destination
                                move_uploaded_file($tmp_name, $destination);// move image to destination


                                //insert into database
                                if ($i == 0) {

                                    //upload pdf file
                                    $pdf_file_name = $pdf_file['name'];
                                    $pdf_tmp_name = $pdf_file['tmp_name'];
                                    $pdf_error = $pdf_file['error'];
                                    $pdf_folder = "uploads/designer/pdf/";

                                    if (!file_exists($pdf_folder)) {
                                        mkdir($pdf_folder, 0777, true);
                                        file_put_contents($pdf_folder . "index.php", "<?php //silence");
                                        file_put_contents("uploads/designer/index.php", "<?php //silence");
                                    }

                                    if (!empty($pdf_file_name)) {
                                        if ($pdf_error === 0) {
                                            $pdf_ex = pathinfo($pdf_file_name, PATHINFO_EXTENSION); // pdf extension
                                            $pdf_ex_lc = strtolower($pdf_ex); // pdf extension lowercase
                                            $allowed_exs = array('pdf'); // allowed extensions

                                            if (in_array($pdf_ex_lc, $allowed_exs)) {
                                                $new_pdf_name = uniqid('PDF-', true) . '.' . $pdf_ex_lc; // unique pdf name
                                                $pdf_destination = $pdf_folder . time() . $new_pdf_name; // pdf destination
                                                move_uploaded_file($pdf_tmp_name, $pdf_destination); // move pdf to destination

                                                $design->insert($_POST); // it must run only one time
                                                $data['design_row'] = $design_row = $design->first('DesignerID', $id);
                                                $designID = $design_row[0]->DesignID;
                                                $design->update_pdf(['DesignID' => $designID], ['Pdf' => $pdf_destination]);

                                            } else {
                                                $design->errors['pdf'] = "This file type is not allowed. Please select pdf file";
                                            }
                                        } else {
                                            $design->errors['pdf'] = "Could not upload pdf file";
                                        }
                                    } else {
                                        $design->errors['pdf'] = "Please select the pdf file";
                                    }

                                }
                                $data['design_row'] = $design_row = $design->first('DesignerID', $id);
                                if(!empty($design_row))
                                {
                                    $designID = $design_row[0]->DesignID;

                                    $design_images->insert(['DesignID' => $designID, 'Image' => $destination]);
                                }else{
                                    $design->errors['pdf'] = "Please upload the pdf file";
                                }

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

    public function update_design($id)
    {

        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $design_images = new Design_image();

        $design = new Design();

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            if ($design->validate($_POST)) {

                $images = $_FILES['images'];
                $pdf_file = $_FILES['pdfFile-input'];
                $num_of_imgs = count($images['name']); //number of images

                $design->updatePost($id,$_POST);

                $pdf_file_name = $pdf_file['name'];
                $pdf_tmp_name = $pdf_file['tmp_name'];
                $pdf_error = $pdf_file['error'];
                $pdf_folder = "uploads/designer/pdf/";

                //upload pdf file
                if (!empty($pdf_file_name)) {
                    show("hello");
                    if ($pdf_error === 0) {
                        $pdf_ex = pathinfo($pdf_file_name, PATHINFO_EXTENSION); // pdf extension
                        $pdf_ex_lc = strtolower($pdf_ex); // pdf extension lowercase
                        $allowed_exs = array('pdf'); // allowed extensions

                        if (in_array($pdf_ex_lc, $allowed_exs)) {
                            $new_pdf_name = uniqid('PDF-', true) . '.' . $pdf_ex_lc; // unique pdf name
                            $pdf_destination = $pdf_folder . time() . $new_pdf_name; // pdf destination
                            move_uploaded_file($pdf_tmp_name, $pdf_destination); // move pdf to destination

                            // it must run only one time
                            $design->update_pdf(['DesignID' => $id], ['Pdf' => $pdf_destination]);

                        } else {
                            $design->errors['pdf'] = "This file type is not allowed. Please select pdf file";
                        }
                    } else {
                        $design->errors['pdf'] = "Could not upload pdf file";
                    }
                }

                //loop through all images
                if($num_of_imgs == 3) {
                    for ($i = 0; $i < $num_of_imgs; $i++) {

                        $image_name = $images['name'][$i];
                        $tmp_name = $images['tmp_name'][$i];
                        $error = $images['error'][$i];

                        $folder = "uploads/designer/images/";

                        //check if there is an image
                        if (!empty($image_name)) {

                            //check if there is no error
                            // $error === 0 means no error
                            if (count(array_unique($_FILES['images']['error'])) === 1 && end($_FILES['images']['error']) === 0) {

                                $img_ex = pathinfo($image_name, PATHINFO_EXTENSION);// image extension
                                $img_ex_lc = strtolower($img_ex); // image extension lowercase
                                $allowed_exs = array('jpg', 'jpeg', 'png');// allowed extensions

                                if (in_array($img_ex_lc, $allowed_exs)) {

                                    $new_img_name = uniqid('IMG-', true) . '.' . $img_ex_lc;// unique image names
                                    $destination = $folder . time() . $new_img_name;// image destination
                                    move_uploaded_file($tmp_name, $destination);// move image to destination

                                    if ($i == 0) {
                                        $design_images->deleteImage($id);
                                    }

                                }
                                $design_images->insert(['DesignID' => $id, 'Image' => $destination]);

                            } else {
                                $design->errors['image'] = "This file type is not allowed";
                            }
                        } else {
                            $design->errors['image'] = "Could not upload image";
                        }
                    }
                }

            }

        }

        if(empty($design->errors))
        {
            echo "<div class='cat-success'>
                      <h3>Design Updated Successfully.</h3>
                        </div>";

        }else{
            $stm = "<div class='cat-errors''>
                                        <ul>";
            foreach ($design->errors as $error)
            {
                $stm .= "<li>".$error."</li>";
            }

            $stm .= "</ul>
                             </div>";

            echo $stm;
        }
    }

    public function remove_add_design($id=null)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $design = new Design();

        if(empty($design->deleteDesign($id)))
        {
            echo "success";
        }
        else
        {
            echo "failed";
        }

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


    public function acceptDesign($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $design = new Design();
        $emp_id = Auth::getEmployeeID();

        if(!$design->acceptDesign($id,$emp_id)){
            echo "<div class='design-response'>
                        <h2>Design Accepted Successfully!</h2>
                    </div>";
        }else{
            echo "<div class='design-response error'>
                        <h2>Error Occured!</h2>
                    </div>";
        }
    }

    public function rejectDesign($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $design = new Design();
        $emp_id = Auth::getEmployeeID();

        if(!$design->rejectDesign($id,$emp_id)){
            echo "<div class='design-response'>
                    <h2>Design Rejected Successfully!</h2>
                </div>";
        }else{
            echo "<div class='design-response error'>
                    <h2>Error Occured!</h2>
                  </div>";
        }
    }

    public function downloadPdf()
    {
        $filepath = $_GET['filepath'];
        $filename = explode('/',$filepath)[3];

        if (file_exists($filepath)) {
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' .$filename. '"');
            header('Content-Length: ' . filesize($filepath));

            readfile($filepath);

        } else {
            echo 'File not found.';
        }
    }

    public function viewDesigns($status)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $design = new Design();
        $employee = new Employees();
        $categories = new Categories();

        $rows = $design->getDesignsByStatus($status);

        if (empty($rows)){
            echo "<tr>
                    <td colspan='8' style='text-align: center'>No Designs Available</td>
                </tr>";
            return;
        }

        $stm = "";

        foreach ($rows as $row){
            $designer = $employee->getEmployeeByID($row->DesignerID)[0];
            $category = $categories->getCategoryByID($row->CategoryID)[0];

            $row->Category = $category->Category_name;
            $row->Desinger = $designer->Firstname." ".$designer->Lastname;
            $row->Image = $design->getDisplayImage($row->DesignID)[0]->Image;

            $stm .= "
                <tr>
                    <td>$row->DesignID</td>
                    <td><img class='table-image' src='http://localhost/WoodWorks/public/".$row->Image. "' alt=''></td>
                    <td>$row->Name</td>
                    <td>$row->Desinger</td>
                    <td>$row->Status</td>
                    <td>$row->Category</td>
                    <td>$row->Date</td>
                    <td>
                        <div class='inv-table-btns manager-btns'>
                            <button onclick='downloadPdf(`$row->Pdf`)'><img src='http://localhost/WoodWorks/public/assets/images/manager/download-svgrepo-com.svg' alt=''></button>
                            <button onclick='getDesignInfo(`$row->DesignID`)'><img src='http://localhost/WoodWorks/public/assets/images/manager/info-svgrepo-com.svg' alt=''></button>
                        </div>
                    </td>
                </tr>
            ";
        }

        echo $stm;
    }

    public function getDesignInfo($id)
    {
        if (!Auth::logged_in()){
            $this->redirect('login');
        }

        $designs = new Design();
        $employees = new Employees();
        $design = $designs->getDesignByID($id)[0];
        $images = $designs->getDesignImages($id);
        $designer = $employees->getEmployeeByID($design->DesignerID)[0];

        $stm = "
            <div class='design-images'>
                   <img class='display-image' id='display-image' src='http://localhost/WoodWorks/public/".$images[0]->Image."' alt=''>
            <div class='images-list'>
                <img id='image1' onclick='changeImage(`image1`)' src='http://localhost/WoodWorks/public/".$images[0]->Image."' alt=''>
                <img id='image2' onclick='changeImage(`image2`)' src='http://localhost/WoodWorks/public/".$images[1]->Image."' alt=''>
                <img id='image3' onclick='changeImage(`image3`)'  src='http://localhost/WoodWorks/public/".$images[2]->Image."' alt=''>
            </div>
            </div>
            <div class='design-info'>
                <h2 id='design-name'>$design->Name</h2>
                <h3>Designer: <span style='font-weight: normal;font-size: medium'>".$designer->Firstname." ".$designer->Lastname."</span></h3>
                <div>
                    <h3>Design Description:</h3>
                    <p id='design-description'>$design->Description</p>
                </div>
            </div>
        ";

        echo $stm;
    }

}
