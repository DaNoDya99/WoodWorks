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
            $this->redirect('login4');
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
            $this->redirect('login4');
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
            $this->redirect('login4');
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
            $this->redirect('login4');
        }

        $id = $id ?? Auth::getEmployeeID();
        $advertisement = new Advertisements();

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST['ManagerID'] = $id;

            if($advertisement->validate($_POST)){
                $advertisement->insert($_POST);
            }
            
        }

        $employee = new Employees();
        $data['row'] = $row = $employee->where('EmployeeID',$id);
        $data['title'] = "ADVERTISEMENTS";
        $data['errors'] = $advertisement->errors;

        $this->view('manager/advertisements',$data);
    }

    public function reviews($id = null)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login4');
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
            $this->redirect('login4');
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
            $this->redirect('login4');
        }

        
        $data['title']="ISSUES";

        $this->view('manager/issues',$data);
    }

    public function designs()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login4');
        }

        $design = new Design();
        $rows = $design->getAllUnverifiedDesigns();
        //create an object and call function using that object

        foreach($rows as $row)
        {
            $row->Date = explode(" ",$row->Date)[0];
            $row->Image = $design->getDisplayImage($row->DesignID)[0]->Image;
        }

        $data['designs'] = $rows;
        $data['title']="DESIGNS";

        $this->view('manager/designs',$data);
    }

    public function discounts($id = null)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login4');
        }

        $id = $id ?? Auth::getEmployeeID();
        $employee = new Employees();
        $furniture = new Furnitures();

        $data['row'] = $row = $employee->where('EmployeeID',$id);

        $data['furniture'] = $furniture->getDiscounts($id);
        $data['image'] = $furniture->getDisplayImage($id);
        $data['title'] = $data['furniture'][0]->Name;

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $furniture->updateDiscounts($id,$_POST['Discount_percentage']);
            $this->redirect('manager/discounts/'.$id);
        }

        $this->view('manager/discounts',$data);
    }

    public function reports()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login4');
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


}