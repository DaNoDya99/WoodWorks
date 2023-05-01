<?php

use Dompdf\Dompdf;

class Manager extends Controller
{
    protected $message = '';

    public function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $data['title'] = "DASHBOARD";

        $this->view('manager/dashboard', $data);
    }

    public function mailing(){
        // if (!Auth::logged_in()) {
        //     $this->redirect('login');
        // }

       

        $this->view('manager/mailing');

    }

    public function posts()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $furniture = new Furnitures();
        $rows = $furniture->view_furniture_posts();

        foreach ($rows as $row) {
            $row->Image = $furniture->getDisplayImage($row->ProductID)[0]->Image;
        }

        $data['furniture'] = $rows;
        $data['title'] = "POSTS";

        $this->view('manager/posts', $data);
    }


    public function change_visibility($id, $status)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        if ($status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }

        $furniture  =  new Furnitures();
        $furniture->updateVisibility($id, $status);

        $this->redirect('manager/posts');
    }

    

    public function profile($id = null)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $id = $id ?? Auth::getEmployeeID();
        $employee = new Employees();
        $data['row'] = $row = $employee->where('EmployeeID', $id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $row) {
            $folder = "uploads/images/";
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
                file_put_contents($folder . "index.php", "<?php Access Denied.");
                file_put_contents("uploads/index.php", "<?php Access Denied.");
            }

            if ($employee->edit_validate($_POST, $id)) {
                $allowedFileType = ['image/jpeg', 'image/png'];


                if (!empty($_FILES['Image']['name'])) {
                    if ($_FILES['Image']['error'] == 0) {
                        if (in_array($_FILES['Image']['type'], $allowedFileType)) {
                            $destination = $folder . time() . $_FILES['Image']['name'];
                            move_uploaded_file($_FILES['Image']['tmp_name'], $destination);

                            //                            resize_image($destination);
                            $_POST['Image'] = $destination;
                            if (file_exists($row[0]->Image)) {
                                unlink($row[0]->Image);
                            }
                        } else {
                            $employee->errors['image'] = "This file type is not allowed.";
                        }
                    } else {
                        $employee->errors['image'] = "Could not upload image.";
                    }
                }

                $_POST['EmployeeID'] = $id;
                $employee->update($id, $_POST);
                $this->redirect('manager/profile/' . $id);
            }
        }

        $data['title'] = "PROFILE";
        $data['errors'] = $employee->errors;

        $this->view('manager/profile', $data);
    }

    public function advertisements($id = null)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $id = $id ?? Auth::getEmployeeID();
        $advertisement = new Advertisements();


        $employee = new Employees();
        $data['row'] = $employee->where('EmployeeID', $id);
        $data['title'] = "ADVERTISEMENTS";
        $rows = $advertisement->getReFurDetails();

        foreach ($rows as $row) {
            $row->Image = $advertisement->getDisplayImage($row->AdvertisementID)[0]->Image;
            $row->Date = explode(" ", $row->Date)[0];
        }

        $data['advertisements'] = $rows;

        $this->view('manager/advertisements', $data);
    }

    public function reviews($id = null)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $id = $id ?? Auth::getEmployeeID();
        $employee = new Employees();
        $furniture = new Furnitures();
        $reviews = new Reviews();
        $data['row'] = $row = $employee->where('EmployeeID', $id);

        $data['furniture'] = $reviews->getReviewsForManager($id);
        $data['image'] = $furniture->getDisplayImage($id);
        $data['name'] = $furniture->getFurnitureName($id);
        $data['title'] = $data['name'][0]->Name;

        $this->view('manager/reviews', $data);
    }

    public function orders()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $furniture = new Furnitures();
        $rows = $furniture->view_furniture_orders();

        foreach ($rows as $row) {
            $row->Image = $furniture->getDisplayImage($row->ProductID)[0]->Image;
        }

        $data['furniture'] = $rows;
        $data['title'] = "ORDERS";

        $this->view('manager/orders', $data);
    }

    public function issues()
    {
        if (!Auth::logged_in()) {
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
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $design = new Design();
        $rows = $design->getAllUnverifiedDesigns();
        //create an object and call function using that object
        if (!empty($rows)) {
            foreach ($rows as $row) {
                $row->Date = explode(" ", $row->Date)[0];
                $row->Image = $design->getDisplayImage($row->DesignID)[0]->Image;
            }
        }


        $data['designs'] = $rows;
        $data['title'] = "DESIGNS";

        $this->view('manager/designs', $data);
    }

    
    public function reports()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }


        $this->view('manager/reports');
    }

   public function reportCsv($reportType, $date1, $date2){
    // exportToCsv();
    echo $reportType;   
    echo $date1;
    echo $date2;
    if($reportType == 'product_sold'){

        $order = new Orders();
        $data = $order->getDetailedProductReport($date1, $date2);
        $filename = 'products_sold.csv';
        exportToCsv($data, $filename);
    }

   }

    //reply to ajax call
    public function getReport()
    {
        // if (!Auth::logged_in()) {
        //     $this->redirect('login');
        // }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            header('Content-Type: application/json');
            //encode status success and echo to ajax call
            $data['date1'] = $_POST['date1'];
            $data['date2'] = $_POST['date2'];


            $startDate = new DateTime($_POST['date1']); // start date
            $endDate = new DateTime($_POST['date2']); // end date
            $labels = [];

            while ($startDate <= $endDate) {
                array_push($labels, $startDate->format('Y-m-d'));
                $startDate->modify('+1 day');
            }
            $data['labels'] = $labels;
            // show($labels);
            $order = new Orders();

            $data['products_sold'] = $order->findProductsSold($_POST['date1'], $_POST['date2']);


            $a = $order->findOrdersSumByDate($_POST['date1'], $_POST['date2']);
//             show($a);
             if(empty($a)){
                 $a = [];
             }

            $s = [];
            for ($i = 0; $i < count($labels); $i++) {
                $s[$i] = 0;
                for ($j = 0; $j < count($a); $j++) {
                    if ($labels[$i] == $a[$j]->DATE) {
                        $s[$i] = $a[$j]->total;
                        break;
                    }
                }
            }
            $data['test'] = $s;
            $ordercount = [];
            for ($i = 0; $i < count($labels); $i++) {
                $ordercount[$i] = 0;
                for ($j = 0; $j < count($a); $j++) {
                    if ($labels[$i] == $a[$j]->DATE) {
                        $ordercount[$i] = $a[$j]->OrderCount;
                        break;
                    }
                }
            }
            $data['test'] = $s;
            $data['ordercount'] = $ordercount;


            //     $order = new Orders();
            $data['orders'] = $order->findOrdersByDate($_POST['date1'], $_POST['date2']);
            if (empty($data['orders'])){
                $data['orders'] = [];
            }
            //     //get total amount of orders grouped by date

            //     $a = $order->findOrdersSumByDate($_POST['date1'], $_POST['date2']);
            //     $data['test'] = $a;
            $data['total'] = 0;
            foreach ($data['orders'] as $row) {
                //round off to 2 decimal places
                $row->Total_amount = round($row->Total_amount, 2);
                $data['total'] += $row->Total_amount;
            }


            //     //get count of completed orders
            $data['completed'] = $order->getCompletedOrders($_POST['date1'], $_POST['date2']);
            echo json_encode($data);

    }
}

    public function productinfo($date1,$date2)
    {
        $order = new Orders();
        $furniture = new Furnitures();
        //get furniture count
        $data['furniturecount'] = $furniture->getFurnitureCount()[0]->count;
        $data['detailedinfo'] = $order->getDetailedProductReport($date1,$date2);
        echo json_encode($data);
    }

    public function chat()
    {


        $id = $id ?? Auth::getEmployeeID();
        $employee = new Employees();

        $data['row'] = $employee->where('EmployeeID', $id);
        $data['title'] = "CHAT";

        $this->view('manager/chat', $data);
    }

    public function verify($id = null)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $id = $id ?? Auth::getEmployeeID();
        $employee = new Employees();

        $data['row'] = $employee->where('EmployeeID', $id);
        $data['title'] = "Design Details";

        $this->view('manager/verify', $data);
    }

    public function all_designs()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $designs = new Design();
        $rows = $designs->getDesignsCardDetails();

        foreach ($rows as $row) {
            $row->Image = $designs->getDesignPrimaryImage($row->DesignID)[0]->Image;
        }

        $data['designs'] = $rows;

        $this->view('manager/all_designs', $data);
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


}
