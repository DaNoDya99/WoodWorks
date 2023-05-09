<?php

class Order extends Controller
{
    public function index(){

    }

    public function orderDetails($id)
    {

        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $orders = new Orders();
        $rows = $orders->getOrderItems($id);
        $str = '<div  class="delivery-order-items">';
        foreach ($rows as $row) {
            $str .= "
                <div class='order-item deliver-order-item'>
                    <img src='http://localhost/WoodWorks/public/" . $row->Image . "' alt=''>
                    <div class='ordered-product-details'>
                        <div class='ordered-product-details-lhs'>
                            <div class='row5'>
                                <h4>" . $row->Name . "</h4>
                            </div>
                 
                            <div class='row4'>
                                <span>" . $row->Quantity . " item</span>
                                <span>" . $row->ProductID . "</span>
                            </div>
                        </div>
                    
                        <div class='price'>
                            <span>Rs. " . $row->Cost . ".00</span>
                        </div>
                    </div>
                </div>
            ";
        }

        $order = $orders->deliveryOrderDetails($id)[0];

        $str .= '</div>';
        $str .= "
             <div class='order-payment-details deliver-order-details' >
                        <h2>Order Details</h2>
                        <div class='order-detail'>
                            <h4>Order ID</h4>
                            <span>" . $order->OrderID . "</span>
                        </div>
                        <div class='order-detail'>
                            <h4>Phone Number</h4>
                            <span>" . $order->Contactno . "</span>
                        </div>
                        <div class='order-detail'>
                            <h4>Delivery Address</h4>
                            <span>" . $order->Address . "</span>
                        </div>
                        <div class='order-detail order-final-detail'>
                        </div>
                        <div class='order-detail order-total delivery-order-total'>
                            <h4>Total Amount</h4>
                            <span>Rs. " . $order->Total_amount . ".00</span>
                        </div>
                    </div>
        ";

        echo $str;
    }

    public function getOrderItem($orderID,$productId)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $order_item = new Order_Items();
        $reviews = new Reviews();
        $id = Auth::getCustomerID();
        $row = $order_item->getOrderItem($orderID,$productId)[0];

        $rate = $reviews->getProductRating($productId)[0]->Average;

        if($rate == null){
            $rate = 0;
            $rating = '0.0%';
        }else{
            $rating = round($rate/5*100);
            $rating = $rating.'%';
        }


        $str = '';

        if($reviews->getProductReviews($productId,$id)){
            $review = $reviews->getProductReviews($productId,$id)[0];

            $str = "
            <h2>".$row->Name." - ".$row->ProductID."</h2>
            <div class='review-fur-img'>
                <img src='http://localhost/WoodWorks/public/".$row->Image."' alt=''>
            <div class='current-rating'>
                <h2>Current Ratings</h2>
                <span>".$rate."</span>
                <div>
                    <div class='stars-outer'>
                        <div class='stars-inner' style='width: ".$rating."'></div>
                    </div>
                    <span class='number-rating'></span>
                </div>
            </div>
            <div class='your-rating'>
                <h2>Rate Product</h2>
            
                <div class='star-widget'>";

                if($review->Rating == 5){
                    $str .= "
                    <input type='radio' name='rate' id='rate-5' value='5' checked>
                    <label for='rate-5' class='fas fa-star' onclick='setRate(5)'></label>
                    <input type='radio' name='rate' id='rate-4' value='4' >
                    <label for='rate-4' class='fas fa-star' onclick='setRate(4)'></label>
                    <input type='radio' name='rate' id='rate-3' value='3'>
                    <label for='rate-3' class='fas fa-star' onclick='setRate(3)'></label>
                    <input type='radio' name='rate' id='rate-2' value='2'>
                    <label for='rate-2' class='fas fa-star' onclick='setRate(2)'></label>
                    <input type='radio' name='rate' id='rate-1' value='1'>
                    <label for='rate-1' class='fas fa-star' onclick='setRate(1)'></label>";
                }else if($review->Rating == 4){
                    $str .= "
                    <input type='radio' name='rate' id='rate-5' value='5'>
                    <label for='rate-5' class='fas fa-star' onclick='setRate(5)'></label>
                    <input type='radio' name='rate' id='rate-4' value='4' checked>
                    <label for='rate-4' class='fas fa-star' onclick='setRate(4)'></label>
                    <input type='radio' name='rate' id='rate-3' value='3'>
                    <label for='rate-3' class='fas fa-star' onclick='setRate(3)'></label>
                    <input type='radio' name='rate' id='rate-2' value='2'>
                    <label for='rate-2' class='fas fa-star' onclick='setRate(2)'></label>
                    <input type='radio' name='rate' id='rate-1' value='1'>
                    <label for='rate-1' class='fas fa-star' onclick='setRate(1)'></label>";
                }else if($review->Rating == 3){
                    $str .= "
                    <input type='radio' name='rate' id='rate-5' value='5'>
                    <label for='rate-5' class='fas fa-star' onclick='setRate(5)'></label>
                    <input type='radio' name='rate' id='rate-4' value='4' >
                    <label for='rate-4' class='fas fa-star' onclick='setRate(4)'></label>
                    <input type='radio' name='rate' id='rate-3' value='3' checked>
                    <label for='rate-3' class='fas fa-star' onclick='setRate(3)'></label>
                    <input type='radio' name='rate' id='rate-2' value='2'>
                    <label for='rate-2' class='fas fa-star' onclick='setRate(2)'></label>
                    <input type='radio' name='rate' id='rate-1' value='1'>
                    <label for='rate-1' class='fas fa-star' onclick='setRate(1)'></label>";
                }else if($review->Rating == 2){
                    $str .= "
                    <input type='radio' name='rate' id='rate-5' value='5'>
                    <label for='rate-5' class='fas fa-star' onclick='setRate(5)'></label>
                    <input type='radio' name='rate' id='rate-4' value='4' >
                    <label for='rate-4' class='fas fa-star' onclick='setRate(4)'></label>
                    <input type='radio' name='rate' id='rate-3' value='3'>
                    <label for='rate-3' class='fas fa-star' onclick='setRate(3)'></label>
                    <input type='radio' name='rate' id='rate-2' value='2' checked>
                    <label for='rate-2' class='fas fa-star' onclick='setRate(2)'></label>
                    <input type='radio' name='rate' id='rate-1' value='1'>
                    <label for='rate-1' class='fas fa-star' onclick='setRate(1)'></label>";
                }else if($review->Rating == 1){
                    $str .= "
                    <input type='radio' name='rate' id='rate-5' value='5'>
                    <label for='rate-5' class='fas fa-star' onclick='setRate(5)'></label>
                    <input type='radio' name='rate' id='rate-4' value='4' >
                    <label for='rate-4' class='fas fa-star' onclick='setRate(4)'></label>
                    <input type='radio' name='rate' id='rate-3' value='3'>
                    <label for='rate-3' class='fas fa-star' onclick='setRate(3)'></label>
                    <input type='radio' name='rate' id='rate-2' value='2'>
                    <label for='rate-2' class='fas fa-star' onclick='setRate(2)'></label>
                    <input type='radio' name='rate' id='rate-1' value='1' checked>
                    <label for='rate-1' class='fas fa-star' onclick='setRate(1)'></label>";
                }
                $str .= "
                        </div>
                        <span class='error' id='error-rate'></span>
                    </div>
                    </div>
                    <div class='write-review'>
                        <div class='header-error'>
                        <h2>Write a review</h2>
                            <span class='error' id='error-review'></span>
                        </div>
                        <textarea id='review' cols='30' rows='10' maxlength='1024' placeholder='Describe Your Experience...'>".$review->Reviews."</textarea>
                    </div>
                    <div class='review-btn-container'>
                        <button class='review-btn' onclick='saveReview(`".$row->ProductID."`)'>Post Review</button>
                    </div>
                ";
        }else {
                $str = "
                <h2>" . $row->Name . " - " . $row->ProductID . "</h2>
                <div class='review-fur-img'>
                    <img src='http://localhost/WoodWorks/public/" . $row->Image . "' alt=''>
                <div class='current-rating'>
                    <h2>Current Ratings</h2>
                    <span>$rate</span>
                    <div>
                        <div class='stars-outer'>
                            <div class='stars-inner' style='width: ".$rating."'></div>
                        </div>
                        <span class='number-rating'></span>
                    </div>
                </div>
                <div class='your-rating'>
                    <h2>Rate Product</h2>
                
                    <div class='star-widget'>
                        <input type='radio' name='rate' id='rate-5' value='5'>
                        <label for='rate-5' class='fas fa-star' onclick='setRate(5)'></label>
                        <input type='radio' name='rate' id='rate-4' value='4'>
                        <label for='rate-4' class='fas fa-star' onclick='setRate(4)'></label>
                        <input type='radio' name='rate' id='rate-3' value='3'>
                        <label for='rate-3' class='fas fa-star' onclick='setRate(3)'></label>
                        <input type='radio' name='rate' id='rate-2' value='2'>
                        <label for='rate-2' class='fas fa-star' onclick='setRate(2)'></label>
                        <input type='radio' name='rate' id='rate-1' value='1'>
                        <label for='rate-1' class='fas fa-star' onclick='setRate(1)'></label>
                    </div>
                    <span class='error' id='error-rate'></span>
                </div>
                </div>
                <div class='write-review'>
                    <div class='header-error'>
                    <h2>Write a review</h2>
                        <span class='error' id='error-review'></span>
                    </div>
                    <textarea id='review' cols='30' rows='10' maxlength='1024' placeholder='Describe Your Experience...'></textarea>
                </div>
                <div class='review-btn-container'>
                    <button class='review-btn' onclick='saveReview(`" . $row->ProductID . "`)'>Post Review</button>
                </div>
            ";
        }

        echo $str;
    }

    public function getSelectedProducts()
    {
        if(!Auth::logged_in()){
            $this->redirect('login');
        }

        $selected = json_decode($_POST['selected']);
        $furniture = new Furnitures();

        $stm = '';

        foreach ($selected as $value) {
            $row = $furniture->getFurnitureByID($value)[0];
            $row->Image = $furniture->getDisplayImage($row->ProductID)[0]->Image;

            $stm .= "
                <tr>
                    <td>$value</td>
                    <td><img src='http://localhost/WoodWorks/public/".$row->Image."' alt=''></td>
                    <td>$row->Name</td>
                    <td><input type='number' name='".$value."' id='quantity' min='1' value='1'></td>
                </tr>
            ";
        }

        echo $stm;
    }

    public function placeCompanyOrder()
    {
        if(!Auth::logged_in()){
            $this->redirect('login');
        }

        $company_order = new CompanyOrderModel();
        $order_items = new Company_order_items();

        $order_id = $company_order->generateOrderID();

        $order = [
            'OrderID' => $order_id,
            'OrderStatus' => 'Pending',
            'ManagerID' => Auth::getEmployeeID(),
            'SupplierID' => $_POST['supplier'],
            'Comments' => $_POST['Comments'],
        ];

        $company_order->insert($order);

        unset($_POST['supplier']);
        unset($_POST['Comments']);
        unset($_POST['products']);

        $products = $_POST;

        foreach ($products as $key => $value) {
            $order_items->insertItem($order_id, $key, $value);
        }

        echo 'success';

    }

    public function getCompanyPendingOrders()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $company_order = new CompanyOrderModel();

        $orders = $company_order->getSupplierOrdersByStatus('Pending');

        $stm = "
            <table class='orders-info-table'>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Supplier Name</th>
                        <th>Company</th>
                        <th>Manager</th>
                        <th>Ordered Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
        ";

        if(empty($orders))
        {
            $stm .= "
                <tr>
                    <td colspan='6'>No Pending Orders Yet</td>
                </tr>
                </tbody>
                </table>
            ";

            echo $stm;
            return;
        }

        $suppliers = new Suppliers();
        $employees = new Employees();

        foreach ($orders as $order) {
            $supplier = $suppliers->getSupplier($order->SupplierID)[0];

            $supplier_name = $supplier->Firstname . ' ' . $supplier->Lastname;

            $employee = $employees->getEmployeeByID($order->ManagerID)[0];

            $manager_name = $employee->Firstname . ' ' . $employee->Lastname;

            $stm .= "
                <tr>
                    <td>$order->OrderID</td>
                    <td>$supplier_name</td>
                    <td>$supplier->Company_name</td>
                    <td>$manager_name</td>
                    <td>$order->Date</td>
                    <td>
                        <div class='inv-table-btns manager-btns'>
                            <button onclick='editCompanyOrder(`".$order->OrderID."`)'><img src='http://localhost/WoodWorks/public/assets/images/admin/edit-4-svgrepo-com.svg' alt=''></button>
                            <button onclick='deleteCompanyOrder(`".$order->OrderID."`)'><img src='http://localhost/WoodWorks/public/assets/images/admin/delete-svgrepo-com.svg' alt=''></button>
                            <button onclick='getCompanyOrderInfo(`".$order->OrderID."`)'><img src='http://localhost/WoodWorks/public/assets/images/manager/info-svgrepo-com.svg' alt=''></button>
                        </div>   
                    </td>
                </tr>
            ";
        }

        $stm .= "
                </tbody>
            </table>";

        echo $stm;
    }

    public function getCompanyCompletedOrders()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $company_order = new CompanyOrderModel();

        $orders = $company_order->getSupplierOrdersByStatus('Completed');

        $stm = "
            <table class='orders-info-table'>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Supplier Name</th>
                        <th>Company</th>
                        <th>Manager</th>
                        <th>Ordered Date</th>
                        <th>Accepted Date</th>
                        <th>Completed Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>";

        if(empty($orders))
        {
            $stm .= "
                <tr>
                    <td colspan='8'>No Completed Orders Yet</td>
                </tr>
                </tbody>
                </table>
            ";

            echo $stm;
            return;
        }

        $suppliers = new Suppliers();
        $employees = new Employees();

        foreach ($orders as $order) {
            $supplier = $suppliers->getSupplier($order->SupplierID)[0];

            $supplier_name = $supplier->Firstname . ' ' . $supplier->Lastname;

            $employee = $employees->getEmployeeByID($order->ManagerID)[0];

            $manager_name = $employee->Firstname . ' ' . $employee->Lastname;

            $stm .= "
                <tr>
                    <td>$order->OrderID</td>
                    <td>$supplier_name</td>
                    <td>$supplier->Company_name</td>
                    <td>$manager_name</td>
                    <td>$order->Date</td>
                    <td>$order->Responded_date</td>
                    <td>$order->Completed_date</td>
                    <td>
                        <div class='inv-table-btns manager-btns'>
                            <button onclick='orderReceived(`".$order->OrderID."`)'><img src='http://localhost/WoodWorks/public/assets/images/manager/active-svgrepo-com(1).svg' alt=''></button>
                            <button onclick='getCompanyOrderInfo(`".$order->OrderID."`)'><img src='http://localhost/WoodWorks/public/assets/images/manager/info-svgrepo-com.svg' alt=''></button>
                        </div>   
                    </td>
                </tr>
            ";
        }

        $stm .= "
                </tbody>
            </table>";

        echo $stm;
    }

    public function getCompanyRejectedOrders()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $company_order = new CompanyOrderModel();

        $orders = $company_order->getSupplierOrdersByStatus('Rejected');

        $stm = "
            <table class='orders-info-table'>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Supplier Name</th>
                        <th>Company</th>
                        <th>Manager</th>
                        <th>Ordered Date</th>
                        <th>Rejected Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>";

        if(empty($orders))
        {
            $stm .= "
                <tr>
                    <td colspan='7'>No Rejected Orders Yet</td>
                </tr>
                </tbody>
                </table>
            ";

            echo $stm;
            return;
        }

        $suppliers = new Suppliers();
        $employees = new Employees();

        foreach ($orders as $order) {
            $supplier = $suppliers->getSupplier($order->SupplierID)[0];

            $supplier_name = $supplier->Firstname . ' ' . $supplier->Lastname;

            $employee = $employees->getEmployeeByID($order->ManagerID)[0];

            $manager_name = $employee->Firstname . ' ' . $employee->Lastname;

            $stm .= "
                <tr>
                    <td>$order->OrderID</td>
                    <td>$supplier_name</td>
                    <td>$supplier->Company_name</td>
                    <td>$manager_name</td>
                    <td>$order->Date</td>
                    <td>$order->Responded_date</td>
                    <td>
                        <div class='inv-table-btns manager-btns'>
                            <button class='deletion-btn' onclick='deleteCompanyOrder(`".$order->OrderID."`)'><img src='http://localhost/WoodWorks/public/assets/images/admin/delete-svgrepo-com.svg' alt=''></button>
                            <button onclick='getCompanyOrderInfo(`".$order->OrderID."`)'><img src='http://localhost/WoodWorks/public/assets/images/manager/info-svgrepo-com.svg' alt=''></button>
                        </div>   
                    </td>
                </tr>
            ";
        }

        $stm .= "
                </tbody>
            </table>";

        echo $stm;
    }

    public function getCompanyAcceptedOrders()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $company_order = new CompanyOrderModel();

        $orders = $company_order->getSupplierOrdersByStatus('Accepted');

        $stm = "
            <table class='orders-info-table'>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Supplier Name</th>
                        <th>Company</th>
                        <th>Manager</th>
                        <th>Ordered Date</th>
                        <th>Accepted Date</th>
                        <th>Actions</th>
                </tr>
                </thead>
                <tbody>
        ";

        if(empty($orders))
        {
            $stm .= "
                <tr>
                    <td colspan='7'>No Accepted Orders Yet</td>
                </tr>
                </tbody>
                </table>
            ";

            echo $stm;
            return;
        }

        $suppliers = new Suppliers();
        $employees = new Employees();

        foreach ($orders as $order) {
            $supplier = $suppliers->getSupplier($order->SupplierID)[0];

            $supplier_name = $supplier->Firstname . ' ' . $supplier->Lastname;

            $employee = $employees->getEmployeeByID($order->ManagerID)[0];

            $manager_name = $employee->Firstname . ' ' . $employee->Lastname;

            $stm .= "
                <tr>
                    <td>$order->OrderID</td>
                    <td>$supplier_name</td>
                    <td>$supplier->Company_name</td>
                    <td>$manager_name</td>
                    <td>$order->Date</td>
                    <td>$order->Responded_date</td>
                    <td>
                        <div class='inv-table-btns manager-btns'>
                            <button onclick='getCompanyOrderInfo(`".$order->OrderID."`)'><img src='http://localhost/WoodWorks/public/assets/images/manager/info-svgrepo-com.svg' alt=''></button>
                        </div>   
                    </td>
                </tr>
            ";
        }

        $stm .= "
                </tbody>
            </table>  ";

        echo $stm;

    }

    function getCompanyReceivedOrders()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $company_order = new CompanyOrderModel();

        $orders = $company_order->getSupplierOrdersByStatus('Received');

        $stm = "
            <table class='orders-info-table'>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Supplier Name</th>
                        <th>Company</th>
                        <th>Manager</th>
                        <th>Ordered Date</th>
                        <th>Accepted Date</th>
                        <th>Completed Date</th>
                        <th>Received Date</th>
                        <th>Actions</th>
                </tr>
                </thead>
                <tbody>
        ";

        if(empty($orders))
        {
            $stm .= "
                <tr>
                    <td colspan='9'>No Received Orders Yet</td>
                </tr>
                </tbody>
                </table>
            ";

            echo $stm;
            return;
        }

        $suppliers = new Suppliers();
        $employees = new Employees();

        foreach ($orders as $order) {
            $supplier = $suppliers->getSupplier($order->SupplierID)[0];

            $supplier_name = $supplier->Firstname . ' ' . $supplier->Lastname;

            $employee = $employees->getEmployeeByID($order->ManagerID)[0];

            $manager_name = $employee->Firstname . ' ' . $employee->Lastname;

            $stm .= "
                <tr>
                    <td>$order->OrderID</td>
                    <td>$supplier_name</td>
                    <td>$supplier->Company_name</td>
                    <td>$manager_name</td>
                    <td>$order->Date</td>
                    <td>$order->Responded_date</td>
                    <td>$order->Completed_date</td>
                    <td>$order->Received_date</td>
                    <td>
                        <div class='inv-table-btns manager-btns'>
                            <button class='deletion-btn' onclick='deleteCompanyOrder(`".$order->OrderID."`)'><img src='http://localhost/WoodWorks/public/assets/images/admin/delete-svgrepo-com.svg' alt=''></button>
                            <button onclick='getCompanyOrderInfo(`".$order->OrderID."`)'><img src='http://localhost/WoodWorks/public/assets/images/manager/info-svgrepo-com.svg' alt=''></button>
                        </div>   
                    </td>
                </tr>
            ";
        }

        $stm .= "
                </tbody>
            </table>  ";

        echo $stm;
    }

    public function deleteCompanyOrder($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $company_order = new CompanyOrderModel();

        if(empty($company_order->deleteOrder($id)))
        {
            echo "success";
        }
        else
        {
            echo "failed";
        }

    }

    function orderReceived($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $company_order = new CompanyOrderModel();

        if(empty($company_order->orderReceived($id)))
        {
            echo "success";
        }
        else
        {
            echo "failed";
        }
    }

    public function editCompanyOrder($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $company_order = new CompanyOrderModel();
        $order_items = new Company_order_items();

        $order = $company_order->getOrder($id)[0];
        $items = $order_items->getOrderItems($id);

        $stm = "
            <span class='dis-err' id='quantity-error'></span>
            <form action='' id='order-edit-form'>
                <div class='edit-info-table-container'>
                    <table class='orders-info-table edit-table'>
                        <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Quantity</th>
                        </tr>
                        </thead>
    
                        <tbody id='order-edit-tbody'>
        ";

        $furniture = new Furnitures();

        foreach ($items as $item) {
            $product = $furniture->getFurniture($item->ProductID)[0];
            $image = $furniture->getDisplayImage($item->ProductID)[0]->Image;

            $stm .= "
                    <tr>
                        <td>$item->ProductID</td>
                        <td><img src='http://localhost/WoodWorks/public/$image' alt=''></td>
                        <td>$product->Name</td>
                        <td><input type='number' min='1' name='$item->ProductID' value='$item->Quantity'></td>
                    </tr>
            ";
        }

        $stm .= "
                    </tbody>
                </table>
            </div>";

        $stm .= "
                <div class='field'>
                    <label for=''>Comments</label>
                    <textarea name='Comments' cols='30' rows='6'>$order->Comments</textarea>
                </div>

                <div>
                    <button onclick='updateCompanyOrder(`$id`)'>Save</button>
                </div>
            </form>
        ";

        echo $stm;
    }

    public function updateCompanyOrder($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $company_order = new CompanyOrderModel();
        $order_items = new Company_order_items();

        $company_order->updateComment($id, $_POST['Comments']);

        unset($_POST['Comments']);

        foreach ($_POST as $key => $value) {
            $order_items->updateQuantities($id, $key, $value);
        }

        echo "success";
    }

    public function getCompanyOrderDetails($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $company_order = new CompanyOrderModel();
        $order_items = new Company_order_items();

        $order = $company_order->getOrder($id)[0];
        $items = $order_items->getOrderItems($id);

        $stm = "
                <div class='edit-info-table-container'>
                    <table class='orders-info-table edit-table'>
                        <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Quantity</th>
                        </tr>
                        </thead>
    
                        <tbody id='order-edit-tbody'>
        ";

        $furniture = new Furnitures();

        foreach ($items as $item) {
            $product = $furniture->getFurniture($item->ProductID)[0];
            $image = $furniture->getDisplayImage($item->ProductID)[0]->Image;

            $stm .= "
                    <tr>
                        <td>$item->ProductID</td>
                        <td><img src='http://localhost/WoodWorks/public/$image' alt=''></td>
                        <td>$product->Name</td>
                        <td>$item->Quantity</td>
                    </tr>
            ";
        }

        $stm .= "
                    </tbody>
                </table>
            </div>";

        $stm .= "
                <div class='order-comment'>
                    <h4>Comments:</h4>
                    <p class='comment'>
                        $order->Comments
                    </p>
                </div>
        ";

        echo $stm;
    }
}