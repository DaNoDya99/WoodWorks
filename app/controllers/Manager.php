<?php

class Manager extends Controller
{
    protected $message = '';

    public function index()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $data['title'] = "DASHBOARD";

        $this->view('manager/dashboard',$data);
    }


    public function posts()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $furniture = new Furnitures();
        $rows = $furniture->view_furniture_posts();

        foreach($rows as $row)
        {
            $row->Image = $furniture->getDisplayImage($row->ProductID)[0]->Image;
        }

        $data['furniture'] = $rows;
        $data['title']="POSTS";

        $this->view('manager/posts',$data);
    }


    public function change_visibility($id,$status)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        if($status == 1)
        {
            $status = 0;
        }else {
            $status = 1;
        }

        $furniture  =  new Furnitures();
        $furniture->updateVisibility($id,$status);

        $this->redirect('manager/posts');
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

//                            resize_image($destination);
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

                $_POST['EmployeeID'] = $id;
                $employee->update($id,$_POST);
                $this->redirect('manager/profile/'.$id);
            }
        }

        $data['title'] = "PROFILE";
        $data['errors'] = $employee->errors;

        $this->view('manager/profile',$data);
    }

    public function advertisements($id = null)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $id = $id ?? Auth::getEmployeeID();
        $advertisement = new Advertisements();
        

        $employee = new Employees();
        $data['row'] = $employee->where('EmployeeID',$id);
        $data['title'] = "ADVERTISEMENTS";
        $rows = $advertisement->getReFurDetails();

        // show($rows);die;

        foreach($rows as $row)
        {
            $row->Image = $advertisement->getDisplayImage($row->AdvertisementID)[0]->Image;
            $row->Date = explode(" ",$row->Date)[0];
        }

        $data['advertisements'] = $rows;

        $this->view('manager/advertisements',$data);
    }

    public function reviews($id = null)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $id = $id ?? Auth::getEmployeeID();
        $employee = new Employees();
        $furniture = new Furnitures();
        $reviews = new Reviews();
        $data['row'] = $row = $employee->where('EmployeeID',$id);

        $data['furniture'] = $reviews->getReviewsForManager($id);
        $data['image'] = $furniture->getDisplayImage($id);
        $data['name'] = $furniture->getFurnitureName($id);
        $data['title'] = $data['name'][0]->Name;

        $this->view('manager/reviews',$data);
    }

    public function orders()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $furniture = new Furnitures();
        $rows = $furniture->view_furniture_orders();

        foreach($rows as $row)
        {
            $row->Image = $furniture->getDisplayImage($row->ProductID)[0]->Image;
        }

        $data['furniture'] = $rows;
        $data['title']="ORDERS";

        $this->view('manager/orders',$data);
    }

    public function issues()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $data['title']="ISSUES";
        

        $issue = new Issues();
        $data['issue'] = $issue->get_issue();
        $data['issues'] = $issue->getissuehistory();
        $this->view('manager/issues',$data);
    }

    public function designs()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $design = new Design();
        $rows = $design->getAllUnverifiedDesigns();
        //create an object and call function using that object
        if(!empty($rows))
        {
            foreach($rows as $row)
        {
            $row->Date = explode(" ",$row->Date)[0];
            $row->Image = $design->getDisplayImage($row->DesignID)[0]->Image;
        }
        }
        

        $data['designs'] = $rows;
        $data['title']="DESIGNS";

        $this->view('manager/designs',$data);
    }

    
    public function reports()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        // $furniture = new Furnitures();
        // $rows = $furniture->view_furniture_issues();

        // foreach($rows as $row)
        // {
        //     $row->Image = $furniture->getDisplayImage($row->ProductID)[0]->Image;
        // }

        // $data['furniture'] = $rows;
        $data['title']="REPORTS";

        $this->view('manager/reports',$data);
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

        $this->view('manager/chat',$data);
    }

    public function verify($id=null)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $id = $id ?? Auth::getEmployeeID();
        $employee = new Employees();

        $data['row'] = $employee->where('EmployeeID',$id);
        $data['title'] = "Design Details";

        $this->view('manager/verify',$data);        
    }

    public function all_designs()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $designs = new Design();
        $rows = $designs->getDesignsCardDetails();

        foreach($rows as $row)
        {
            $row->Image = $designs->getDesignPrimaryImage($row->DesignID)[0]->Image;
        }

        $data['designs'] = $rows;

        $this->view('manager/all_designs',$data);
    }

    public function discounts()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $categories = new Categories();

        $data['categories'] = $categories->getCategories();

        $this->view('manager/discounts',$data);
 
    }

    public function getTopSellingProducts()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $items = new Order_Items();
        $rows = $items->getTopSellingProducts();

        if(!empty($rows)){
            echo json_encode($rows);
        }else{
            echo "error";
        }
    } 

    public function getTop10Products()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $reviews = new Reviews();
        $rows = $reviews->getTop10RatedProducts();

        if(!empty($rows)) {
            echo json_encode($rows);
        }else {
            echo json_encode("error");
        }
    }

    public function getIncomeLastWeek()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $order = new Order_Items();
        $rows = $order->getIncomeLastWeek();

        if(!empty($rows)) {
            echo json_encode($rows);
        }else {
            echo json_encode("error");
        }
    }

    public function getProductsReachedReorderLevel()
    {
        if(!Auth::logged_in()){
            $this->redirect('login');
        }

        $inventory = new Product_Inventory();
        $rows = $inventory->getItemsReachedReorderLevel();

        if(!empty($rows)) {
            echo json_encode($rows);
        }else {
            echo json_encode("error");
        }
    }

    public function getPendingIssues()
    {
        if(!Auth::logged_in()){
            $this->redirect('login');
        }

        $issue = new Issues();
        $rows = $issue->getPendingIssuesCount()[0];

        if(!empty($rows)) {
            echo json_encode($rows);
        }else {
            echo json_encode(['Count'=>0]);
        }
    }

    public function getPendingDesigns()
    {
        if(!Auth::logged_in()){
            $this->redirect('login');
        }

        $design = new Design();
        $rows = $design->getPendingDesignsCount()[0];

        if(!empty($rows)) {
            echo json_encode($rows);
        }else {
            echo json_encode(['Count'=>0]);
        }
    }

    public function getActiveDiscounts()
    {
        if(!Auth::logged_in()){
            $this->redirect('login');
        }

        $discount = new Discounts();
        $rows = $discount->getActiveDiscounts();

        if(!empty($rows)) {
            $stm = '';

            foreach ($rows as $row){
                $stm .= "
                    <tr>
                        <td>".$row->Name."</td>
                        <td>".$row->Discount_percentage."%</td>
                        <td>".explode(' ',$row-> Created_at)[0]."</td>
                        <td>".explode(' ',$row-> Expired_at)[0]."</td>
                    </tr>
                ";
            }

            echo $stm;
        }else {
            echo "No Active Discounts";
        }
    }

    public function getSoldOutRefurnishedProducts()
    {
        if(!Auth::logged_in()){
            $this->redirect('login');
        }

        $advertisement = new Advertisements();
        $rows = $advertisement->getSoldOutRefurnishedProducts();

        if(!empty($rows)) {
            $stm = '';

            foreach ($rows as $row){
                $stm .= "
                    <tr>
                        <td>".$row->AdvertisementID."</td>
                        <td>".$row->Name."</td>
                    </tr>
                ";
            }

            echo $stm;
        }else {
            echo "No Sold Out Refurnished Products";
        }
    }

    


}