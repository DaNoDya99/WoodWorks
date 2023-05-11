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

        $furniture = new Furnitures();
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

        // show($rows);die;

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
        $supplier = new Suppliers();

        $data['suppliers'] = $supplier->getSuppliersWithComanyName();
        $data['title'] = "ORDERS";

        $this->view('manager/orders', $data);
    }

    public function issues()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $issue = new Issues();
        $customer = new Customer();
        $issues = $issue->get_issue();

        $data['issues'] = [];

        if (!empty($issues)) {
            foreach ($issues as $issue) {
                $customer_details = $customer->getCustomerByID($issue->CustomerID)[0];

                $issue->First_name = $customer_details->Firstname;
                $issue->Last_name = $customer_details->Lastname;
                $issue->Email = $customer_details->Email;
                $issue->Contact_number = $customer_details->Mobileno;

            }

            $data['issues'] = $issues;
        }

        $this->view('manager/issues', $data);
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

    public function reportCsv($reportType, $date1, $date2, $status)
    {
        // exportToCsv();
        echo $reportType;
        echo $date1;
        echo $date2;
        if ($reportType == 'product_sold') {

            $order = new Orders();
            $data = $order->getDetailedProductReport($date1, $date2, $status);
            $filename = 'products_sold.csv';
            exportToCsv($data, $filename);
        }

    }

//    public function getReport()
//    {
//        // if (!Auth::logged_in()) {
//        //     $this->redirect('login');
//        // }
//        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//            header('Content-Type: application/json');
//            $data['date1'] = $_POST['date1'];
//            $data['date2'] = $_POST['date2'];
//
//            $data['labels'] = $this->getDateLabels($_POST['date1'], $_POST['date2']);
//            $labels = $data['labels'];
//
//            $order = new Orders();
//
//
//            $a = $order->findOrdersSumByDate($_POST['date1'], $_POST['date2']);
//            if (empty($a)) {
//                $a = [];
//            }
//
//            $s = [];
//            for ($i = 0; $i < count($labels); $i++) {
//                $s[$i] = 0;
//                for ($j = 0; $j < count($a); $j++) {
//                    if ($labels[$i] == $a[$j]->DATE) {
//                        $s[$i] = $a[$j]->total;
//                        break;
//                    }
//                }
//            }
//            $data['test'] = $s;
//            $ordercount = [];
//            for ($i = 0; $i < count($labels); $i++) {
//                $ordercount[$i] = 0;
//                for ($j = 0; $j < count($a); $j++) {
//                    if ($labels[$i] == $a[$j]->DATE) {
//                        $ordercount[$i] = $a[$j]->OrderCount;
//                        break;
//                    }
//                }
//            }
//            $data['test'] = $s;
//            $data['ordercount'] = $ordercount;
//
//
//            $data['orders'] = $order->findOrdersByDate($_POST['date1'], $_POST['date2']);
//            if (empty($data['orders'])) {
//                $data['orders'] = [];
//            }
//
//
//            $data['total'] = 0;
//            foreach ($data['orders'] as $row) {
//                //round off to 2 decimal places
//                if ($row->Order_status == 'paid' || $row->Order_status == 'Delivered'|| $row->Order_status == 'Dispatched') {
////                    show($row->Order_status);
//                    $row->Total_amount = round($row->Total_amount, 2);
//                    $data['total'] += $row->Total_amount;
//
//                }
//
//            }
////            show($data['total']);
//
//            //     //get count of completed orders
//            $data['completed'] = $order->getCompletedOrders($_POST['date1'], $_POST['date2']);
//            echo json_encode($data);
//
//        }
//    }


    //reply to ajax call

    public function productinfo($date1, $date2)
    {
        $order = new Orders();
        $furniture = new Furnitures();
        //get furniture count

        $data['furniturecount'] = $furniture->getFurnitureCount()[0]->count;
        $data['detailedinfo'] = $order->getDetailedProductReport($date1, $date2);
        echo json_encode($data);
    }

    public function inventoryinfo()
    {
        $inventory = new Product_Inventory();
        $data['inventory'] = $inventory->getAllFromInventory();
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

        $this->view('manager/discounts', $data);

    }

    public function getTopSellingProducts()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $items = new Order_Items();
        $rows = $items->getTopSellingProducts();

        if (!empty($rows)) {
            echo json_encode($rows);
        } else {
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

        if (!empty($rows)) {
            echo json_encode($rows);
        } else {
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

        if (!empty($rows)) {
            echo json_encode($rows);
        } else {
            echo json_encode("error");
        }
    }

    public function getProductsReachedReorderLevel()
    {
//        if(!Auth::logged_in()){
//            $this->redirect('login');
//        }

        $inventory = new Product_Inventory();
        $rows = $inventory->getItemsReachedReorderLevel();

        if (!empty($rows)) {
            echo json_encode($rows);
        } else {
            echo json_encode("error");
        }
    }

    public function getPendingIssues()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $issue = new Issues();
        $rows = $issue->getPendingIssuesCount()[0];

        if (!empty($rows)) {
            echo json_encode($rows);
        } else {
            echo json_encode(['Count' => 0]);
        }
    }

    public function getPendingDesigns()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $design = new Design();
        $rows = $design->getPendingDesignsCount()[0];

        if (!empty($rows)) {
            echo json_encode($rows);
        } else {
            echo json_encode(['Count' => 0]);
        }
    }

    public function getActiveDiscounts()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $discount = new Discounts();
        $rows = $discount->getActiveDiscounts();

        if (!empty($rows)) {
            $stm = '';

            foreach ($rows as $row) {
                $stm .= "
                    <tr>
                        <td>" . $row->Name . "</td>
                        <td>" . $row->Discount_percentage . "%</td>
                        <td>" . explode(' ', $row->Created_at)[0] . "</td>
                        <td>" . explode(' ', $row->Expired_at)[0] . "</td>
                    </tr>
                ";
            }

            echo $stm;
        } else {
            echo "No Active Discounts";
        }
    }

    public function getSoldOutRefurnishedProducts()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $advertisement = new Advertisements();
        $rows = $advertisement->getSoldOutRefurnishedProducts();

        if (!empty($rows)) {
            $stm = '';

            foreach ($rows as $row) {
                $stm .= "
                    <tr>
                        <td>" . $row->AdvertisementID . "</td>
                        <td>" . $row->Name . "</td>
                    </tr>
                ";
            }

            echo $stm;
        } else {
            echo "No Sold Out Refurnished Products";
        }
    }

    public function getOrdersForDateRange()
    {

        $data['date1'] = $_POST['date1'];
        $data['date2'] = $_POST['date2'];
        $orders = new orders;
        $ordercount = $orders->getOrderByDateRange($data['date1'], $data['date2']);
        if ($ordercount == false) {
            $ordercount = [];
        }
        $data['ordercount'] = $ordercount;
        $labels = $this->getDateLabels($data['date1'], $data['date2']);
        $data['labels'] = $labels;
        $s = [];
        for ($i = 0; $i < count($labels); $i++) {
            $s[$i] = 0;
            for ($j = 0; $j < count($ordercount); $j++) {
                if ($labels[$i] == $ordercount[$j]->order_date) {
                    $s[$i] = $ordercount[$j]->order_count;
                    break;
                }
            }
        }

        $data['values'] = $s;
        echo json_encode($data);

    }

    public function getDateLabels($date1, $date2)
    {
        $startDate = new DateTime($date1); // start date
        $endDate = new DateTime($date2); // end date
        $labels = [];

        while ($startDate <= $endDate) {
            array_push($labels, $startDate->format('Y-m-d'));
            $startDate->modify('+1 day');
        }

        return $labels;
    }

    public function orderlists()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $q = "SELECT 
    o.Date AS 'Date',
    o.OrderID AS 'OrderID',
    o.Order_status AS 'Status',
    CONCAT(o.Firstname, ' ', o.Lastname) AS 'Customer',
    GROUP_CONCAT(i.Name SEPARATOR ', ') AS 'Products',
    SUM(i.Quantity) AS 'ItemsSold',
    SUM(i.Quantity * i.Cost) AS 'NetSales'
FROM 
    orders o
INNER JOIN 
    order_item i ON o.OrderID = i.OrderID
WHERE
    o.Date BETWEEN '" . $_POST['date1'] . "' AND '" . $_POST['date2'] . "'
GROUP BY 
    o.OrderID
ORDER BY 
    o.Date DESC;

";
            $orders = new Orders();
            echo json_encode($orders->query($q, []));
        }
    }

    public function catergoryDetails($date1,$date2)
    {
        $q = "SELECT 
    c.CategoryID AS `CatergoryID`,
    c.Category_name AS `Catergory`,
    COALESCE(SUM(sub.Quantity), 0) AS `ItemsSold`,
    COALESCE(SUM(sub.Quantity * f.Cost), 0) AS `NetSales`,
    COUNT(DISTINCT sub.OrderID) AS `Orders`
FROM
    categories c
LEFT JOIN
    furniture f ON c.CategoryID = f.CategoryID
LEFT JOIN
    (SELECT oi.ProductID, oi.Quantity, oi.OrderID
     FROM order_item oi
     JOIN orders o ON oi.OrderID = o.OrderID
     WHERE o.Order_status IN ('Delivered', 'Dispatched', 'paid')
       AND o.Date >= '".$date1."'
       AND o.Date <  '".$date2."'
    ) as sub ON f.ProductID = sub.ProductID
GROUP BY
    c.CategoryID,
    c.Category_name
";

        $catergory = new Categories();
        echo json_encode($catergory->query($q, []));
    }

    public function CatergoryDist()
    {
        $q = "SELECT c.CategoryID AS CategoryID, COALESCE(SUM(i.Quantity),0) AS Quantity from categories c LEFT JOIN furniture f ON c.CategoryID = f.CategoryID LEFT JOIN inventory i ON f.ProductID = i.ProductID GROUP BY c.CategoryID;";
        $catergories = new Categories();
        echo json_encode($catergories->query($q, []));
    }

}


