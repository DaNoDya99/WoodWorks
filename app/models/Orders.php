<?php

class Orders extends Model
{
    public $errors = [];
    protected $table = "orders";

    protected $allowedColumns = [
        'OrderID',
        'Firstname',
        'Lastname',
        'Email',
        'Contactno',
        'Payment_type',
        'Total_amount',
        'Date',
        'Dispatched_date',
        'Delivered_date',
        'Deliver_method',
        'Estimated_date',
        'Image',
        'Reasons',
        'Order_status',
        'Vehicle_type',
        'Address',
        'CustomerID',
        'DriverID',
        'Is_preparing',
        'Shipping_cost',
        'Discount_obtained',
        'SessionID'
    ];

    public function update_Image($where, $data)
    {
        if(!empty($this->allowedColumns))
        {
            foreach ($data as $key => $value){
                if(!in_array($key,$this->allowedColumns))
                {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);
        $id = array_search($where['OrderID'], $where);

        $query = "update ".$this->table." set ";
        foreach ($keys as $key)
        {
            $query .= $key . "=:" . $key . ",";
        }
        $query = trim($query,",");
        $query .= " where OrderID = :id";

        $data['id'] = $where['OrderID'];
        $this->query($query,$data);
    }

    public function update_Reason($where, $data)
    {
        if(!empty($this->allowedColumns))
        {
            foreach ($data as $key => $value){
                if(!in_array($key,$this->allowedColumns))
                {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);
        $id = array_search($where['OrderID'], $where);

        $query = "update ".$this->table." set ";
        foreach ($keys as $key)
        {
            $query .= $key . "=:" . $key . ",";
        }
        $query = trim($query,",");
        $query .= " where OrderID = :id";

        $data['id'] = $where['OrderID'];
        $this->query($query,$data);
    }

    public function findOrders($column,$value)
    {
        $startOfWeek = date('Y-m-d', strtotime('this week Monday'));
        $endOfWeek = date('Y-m-d', strtotime('this week Sunday'));

        $query = "SELECT * FROM $this->table WHERE DATE >= :startOfWeek AND DATE <= :endOfWeek AND $column = :value AND `Order_status` != 'Delivered' ORDER BY DATE DESC LIMIT 7";

        $params = ['startOfWeek' => $startOfWeek, 'endOfWeek' => $endOfWeek, 'value' => $value];

//        echo "Query: $query\n";
//        echo "Params: " . json_encode($params) . "\n";

        return $this->query($query, $params);
    }

    public function findThisWeekCompletedOrders($column,$value)
    {
        $startOfWeek = date('Y-m-d', strtotime('this week Monday'));
        $endOfWeek = date('Y-m-d', strtotime('this week Sunday'));

        $query = "SELECT count(OrderID) AS 'NumOfCompletedOrdres' FROM $this->table WHERE DATE >= :startOfWeek AND DATE <= :endOfWeek AND $column = :value AND `Order_status` = 'Delivered'";

        $params = ['startOfWeek' => $startOfWeek, 'endOfWeek' => $endOfWeek, 'value' => $value];

        return $this->query($query, $params);
    }


    public function findThisMonthDelayedOrders($column, $value)
    {
        $currentMonth = date('m');
        $query = "SELECT COUNT(OrderID) AS 'NumOfDelayedOrders'FROM $this->table 
              WHERE MONTH(Estimated_date) = :currentMonth 
                AND $column = :value 
                AND `Order_status` = 'Delivered' 
                AND `Delivered_date` > `Estimated_date`";

        $params = ['currentMonth' => $currentMonth, 'value' => $value];

        return $this->query($query, $params);
    }


    

    //function to return orders based on date range
    public function findOrdersByDate($date1, $date2)
    {
        $query = "select * from $this->table where Order_status = 'delivered' or is_preparing = 0 and Date between '$date1' and '$date2' order by DATE";
        return $this->query($query);
    }
    public function findOrdersSumByDate($date1, $date2)
    {
        $query = "select SUM(Total_amount) as total,COUNT(OrderID) as OrderCount, CONVERT(Date, Date) AS DATE from $this->table WHERE Order_status IN ('Paid', 'Dispatched', 'Delivered') or is_preparing = 0 and Date between '$date1' and '$date2' group by DATE ORDER BY Date;";
        return $this->query($query);
    }
 
    //get products sold

    public function findProductsSold($date1, $date2)
    {
        $query = "select SUM(Quantity) as total from orders where OrderID in (select OrderID from orders where Order_status = 'delivered' or is_preparing = 0 and Date between '$date1' and '$date2')";
        return $this->query($query);
    }

    // public function getDetailedProductInfo($offset, $date1, $date2)
    // {
    //     $query = "SELECT a.Name, a.ProductID,a.Cost, COALESCE(b.Quantity,0) AS Quantity, COALESCE(a.Cost * b.Quantity,0) AS Revenue, COALESCE(b.COUNT1,0) AS COUNT1, a.CategoryID, a.Availability FROM furniture a LEFT JOIN( SELECT ProductID, COUNT(OrderID) AS COUNT1, SUM(Quantity) AS Quantity FROM order_item WHERE OrderID IN(SELECT OrderID FROM orders WHERE is_preparing = 0 and Order_status = 'Completed' and Date BETWEEN '" . $date1 . "' and '" . $date2 . "') GROUP BY ProductID) b ON a.ProductID = b.ProductID ORDER BY `a`.`ProductID` LIMIT 5 OFFSET " . 5 * $offset - 5 . ";";

    //     return $this->query($query);
    // }
    public function getDetailedProductReport($date1, $date2)
{
    $query = "SELECT a.Name, a.ProductID,a.Cost, COALESCE(b.Quantity,0) AS Quantity, COALESCE(a.Cost * b.Quantity,0) AS Revenue, COALESCE(b.COUNT1,0) AS COUNT1, a.CategoryID, a.Availability FROM furniture a LEFT JOIN( SELECT ProductID, COUNT(OrderID) AS COUNT1, SUM(Quantity) AS Quantity FROM order_item WHERE OrderID IN(SELECT OrderID FROM orders WHERE is_preparing = 0 and Order_status in ('paid', 'Delivered', 'Dispatched') and Date BETWEEN '" . $date1 . "' and '" . $date2 . "') GROUP BY ProductID) b ON a.ProductID = b.ProductID ORDER BY `a`.`ProductID`;";
    return $this->query($query);
}

    public function getCompletedOrders($date1, $date2)
    {
        $query = "select count(OrderID) as count from $this->table where (Order_status = 'Delivered' or Order_status = 'Dispatched' or Order_status = 'paid') and is_preparing = 0 and Date between '$date1' and '$date2'";
        return $this->query($query);
    }

    
    public function getCustomerOrders($id)
    {
        $query = "select * from $this->table where CustomerID = :id && Is_preparing = :Is_preparing order by DATE desc";

        return $this->query($query, ['id' => $id, 'Is_preparing' => 0]);
    }

    public function displayOrders($column, $value)
    {
        $query = "select * from $this->table WHERE `Deliver_method` = 'Delivery' && $column = :value && `Order_status` != 'Delivered' limit 15";
        return $this->query($query,['value'=>$value]);
    }

    public function displayDeliveredOrders($column,$value)
    {
        $query = "select * from $this->table WHERE `Deliver_method` = 'Delivery' && $column = :value && `Order_status` = 'Delivered' limit 15";
        return $this->query($query,['value'=>$value]);
    
    }

    public function searchOrdersDetails($column, $value, $orders_items)
    {
        $query = "select * from $this->table  WHERE DATE_FORMAT(Date, '%d/%m/%Y') like '%$orders_items%'  or Payment_type like '%$orders_items%' or Address like '%$orders_items%' or Total_amount like '%$orders_items%' AND $column = :value LIMIT 15 ";
        return $this->query($query, ['value' => $value]);
    }


    public function searchDeliveredOrdersDetails($column,$value,$orders_items)
    {
        $query = "select * from $this->table  WHERE DATE_FORMAT(Date, '%d/%m/%Y') like '%$orders_items%'  or OrderID like '%$orders_items%' or DATE_FORMAT(Dispatched_date, '%d/%m/%Y') like '%$orders_items%' or DATE_FORMAT(Delivered_date, '%d/%m/%Y') like '%$orders_items%'or Firstname like '%$orders_items%' or Lastname like '%$orders_items%' AND $column = :value LIMIT 15 ";
        return $this->query($query,['value'=>$value]);

    }

    public function filterStatus($column,$value,$id)
    {
        $query = "select OrderID,Payment_type,Total_amount,Order_status,Address,Firstname,Lastname,Contactno,Date from $this->table  WHERE `Deliver_method` = 'Delivery' && $column = :value  && `DriverID` = '$id' limit 15";
        return $this->query($query, ['value' => $value]);
    }

    public function filterDate($from_date, $to_date)
    {
        $query = "select OrderID,Dispatched_date,Delivered_date,Order_status,Address,Firstname,Lastname,Contactno,Date from $this->table  WHERE `Deliver_method` = 'Delivery' && Delivered_date BETWEEN '$from_date' AND '$to_date' limit 15";
        return $this->query($query);
    }

    public function pieGraph()
    {
        $query = "SELECT COUNT(OrderID) AS numOrders,Order_status FROM $this->table GROUP BY Order_status ";
        return $this->query($query);
    }

    public function barGraph()
    {
        $query = "SELECT cast(Date as date) AS Date, count(OrderID) AS numOrders FROM $this->table WHERE NOT Order_status = 'delivered' GROUP BY cast(Date as date)";
        return $this->query($query);
    }

    public function update_status($OrderID, $data)
    {
        if (!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);
        //$OrderID = array_search($OrderID,$data);
        $data['OrderID'] = $OrderID;

        $query = "update " . $this->table . " set ";
        foreach ($keys as $key) {
            $query .= $key . "=:" . $key . ",";
        }
        $query = trim($query, ",");
        $query .= " where OrderID = :OrderID";

        return $this->query($query, $data);
    }

    public function checkIsPreparingInStore($id)
    {
        $query = "select OrderID from $this->table where CustomerID = :CustomerID && Is_preparing = :Is_preparing && in_store = :in_store;";

        return $this->query($query, ['CustomerID' => $id, 'Is_preparing' => 1]);
    }

    //check is preparing and in store

    public function setOrder($id)
    {
        $data = [
            'OrderID' => $this->make_order_id(),
            'Is_preparing' => 1,
            'CustomerID' => $id
        ];

        $this->insert($data);
        return $data['OrderID'];
    }

    public function getOrderByID($id)
    {
        $query = "select * from $this->table where OrderID = :OrderID";
        return $this->query($query, ['OrderID' => $id]);
    }

    public function make_order_id()
    {

//        $orderID = $this->random_string(60);
//        $result = $this->where('OrderID',$orderID);
//        while ($result){
//            $result = $this->where('OrderID',$orderID);
//            $orderID = $this->random_string(60);
//        }

        $prefix = 'ORD';
        $unique_id = mt_rand(1000, 9999);
        $timestamp = substr(date('YmdHis'), 8, 6);
        $orderID = $prefix . '-' . $unique_id . '-' . $timestamp;

        return $orderID;
    }

    public function random_string($length)
    {
        $array = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
        $text = "";
        for ($x = 0; $x < $length; $x++) {
            $random = rand(0, 61);
            $text .= $array[$random];
        }

        return $text;
    }

    public function setBillOrder()
    {
        $data = [
            'OrderID' => $this->make_order_id(),
            'Firstname' => $_SESSION['CustomerDetails'][0]->Firstname,
            'Lastname' => $_SESSION['CustomerDetails'][0]->Lastname,
            'Email' => $_SESSION['CustomerDetails'][0]->Email,
            'Contactno' => $_SESSION['CustomerDetails'][0]->Mobileno,
        //    'Address' => $_SESSION['CustomerDetails'][0]->Address,
            'Payment_type' => 'Cash',
            'Total_amount' => 0,
            'Deliver_method' => 'Delivery',
            'Order_status' => 'Pending',
            'Is_preparing' => 1,
            'CustomerID' => $_SESSION['CustomerDetails'][0]->CustomerID,
            'in_store' => 1 
        ];

        $this->insert($data);
        return $data['OrderID'];
    }

    public function closeOrder($CustomerID, $payment_type, $total_amount, $deliver_method,)
    {
        $OrderID = $this->checkIsPreparing($CustomerID)[0]->OrderID;
        $query = "update $this->table set Is_preparing = :Is_preparing, Payment_type = :Payment_type, Total_amount = :Total_amount, Deliver_method = :Deliver_method where CustomerID = :CustomerID && OrderID = :OrderID";
        $this->query($query, ['Is_preparing' => 0, 'Payment_type' => $payment_type, 'Total_amount' => $total_amount, 'Deliver_method' => $deliver_method, 'CustomerID' => $CustomerID, 'OrderID' => $OrderID]);
    }

    public function checkIsPreparing($id)
    {
        $query = "select OrderID from $this->table where CustomerID = :CustomerID && Is_preparing = :Is_preparing;";

        return $this->query($query, ['CustomerID' => $id, 'Is_preparing' => 1]);
    }

    public function getNewOrders()
    {
        $query = "select * from $this->table where DriverId IS NULL && Is_preparing = :Is_preparing;";
        return $this->query($query,['Is_preparing' => 0]);
    }

    public function getOrderItems($id = null)
    {
        $query = "SELECT * FROM `order_item` WHERE OrderID = :OrderID;";

        return $this->query($query, ['OrderID' => $id]);
    }

    public function deliveryOrderDetails($id = null)
    {
        $query = "SELECT OrderID, Contactno,Address,Total_amount,Order_status,Shipping_cost,Discount_obtained FROM orders WHERE OrderID = :OrderID;";

        return $this->query($query, ['OrderID' => $id]);
    }


    public function assignDriver($orderID, $driverID)
    {
        $query = 'UPDATE `orders` SET DriverID= :DriverID WHERE OrderID = :OrderID;';

        return $this->query($query, ['OrderID' => $orderID, 'DriverID' => $driverID]);
    }

    public function updateSessionID($orderID, $sessionID, $status)
    {
        $query = "UPDATE `orders` SET `SessionID` = :SessionID, `Order_status` = :Order_status WHERE `OrderID` = :OrderID;";

        return $this->query($query, ['OrderID' => $orderID, 'SessionID' => $sessionID, 'Order_status' => $status]);
    }

    public function getOrderByTheOrderID($orderId)
    {
        $query = "SELECT * FROM `orders` WHERE OrderID = :OrderID && Order_status = :Order_status;";

        return $this->query($query,['OrderID' => $orderId, 'Order_status' => 'unpaid']);
    }

    public function getPaidOrderDetails($orderId)
    {
        $query = "SELECT * FROM `orders` WHERE OrderID = :OrderID && Order_status = :Order_status;";

        return $this->query($query,['OrderID' => $orderId, 'Order_status' => 'paid']);
    }

    public function updateIsPreparing($orderId)
    {
        $query = "UPDATE $this->table SET Is_preparing = :Is_preparing,Deliver_method = :Deliver_method WHERE OrderID = :OrderID && Is_preparing = 1;";

        return $this->query($query, ['Is_preparing' => 0,'OrderID' => $orderId,'Deliver_method' => 'Delivery']);
    }

    public function removeIncompletedOrders($id)
    {
        $query = "DELETE FROM $this->table WHERE CustomerID = :CustomerID && Is_preparing = :Is_preparing;";

        return $this->query($query,['CustomerID' => $id, 'Is_preparing' => 1]);
    }

    public function getOrderDetails($orderId)
    {
        $query = "SELECT * FROM `orders` WHERE OrderID = :OrderID;";

        return $this->query($query,['OrderID' => $orderId]);
    }

    


    public function getOrderByDateRange($date1,$date2){
        $q = "SELECT DATE(Date) AS order_date, COUNT(*) AS order_count FROM orders WHERE Date BETWEEN '".$date1."' AND '".$date2."'GROUP BY DATE(Date) ORDER BY order_date ASC";
        return $this->query($q,[]);
    }
}
