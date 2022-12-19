<?php

class cashier extends Controller
{
    private function getUser()
    {
        $employee = new Employees();
        $id = Auth::getEmployeeID();
        return $employee->where('EmployeeID', $id);
    }


    public function index()
    {
        $products = new Furnitures();
        $data['products'] = $products->getInventory();
        foreach ($data['products'] as $product) {
            $product->image = $products->getDisplayImage($product->ProductID)[0]->Image;
        }


        $data['row'] = $row = $this->getUser();

        $cart = new Carts();
        $cart_id = $cart->getCart('5lhHfqCRtAdbMxdEl69oEq1F0ywitBClYh3fF927If44CB4eaXFKGSgp4K0k')[0]->CartID;
        $order_item = new Order_Items();


        if (empty($cart->getCart($row[0]->EmployeeID))) {
            $cart->setCart($row[0]->EmployeeID);
        }

        $data['cart'] = $order_item->getCustomerCartDetails($cart_id);

        if (empty($data['cart'])) {
            $data['error'] = "The cart is empty.";
        }


        $this->view('cashier/dash', $data);
    }

    public function increaseQuantity($cartID, $productID, $quantity, $cost)
    {

        if (!Auth::logged_in()) {
            $this->redirect('login1');
        }

        $cart = new Carts();
        $order_item = new Order_Items();
        $order_item->updateQuantity($cartID, $productID, (int)$quantity + 1);
        $cart->updateTotalAmountToIncrease($cartID, $cost);
        $this->redirect('cashier/dash');
    }


    public function Profile($id = null)
    {

        if (!Auth::logged_in()) {
            $this->redirect('login1');
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
                $this->redirect('cashier/profile/' . $id);
            }
        }
        $this->view('cashier/profile', $data);
    }
    public function inventory()
    {

        $products = new Furnitures();
        $data['products'] = $products->getInventory();
        foreach ($data['products'] as $product) {
            $product->image = $products->getDisplayImage($product->ProductID)[0]->Image;
        }



        $this->view('cashier/inventory', $data);
    }
    public function billing()
    {

        $orders = new Orders_Supplier();
        $data['orderdata'] = $orders->where(1, 1);

        $this->view('cashier/orders', $data);
    }
    public function add_to_cart($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login7');
        }

        $order = new Orders_Supplier();
        $furniture = new Furnitures();
        $cart = new Carts();
        $order_items = new Order_Items();
        $cus_id = '5lhHfqCRtAdbMxdEl69oEq1F0ywitBClYh3fF927If44CB4eaXFKGSgp4K0k';
        $orderID = '';

        if (empty($cart->getCart($cus_id))) {
            $cart->setCart($cus_id);
        }

        if (empty($order->checkIsPreparing($cus_id))) {
            $orderID = $order->setOrder($cus_id);
        } else {
            $orderID = $order->checkIsPreparing($cus_id)[0]->OrderID;
        }
        $q = "Select * from order_item where CartID = :CartID and ProductID = :ProductID";
        $res = $order_items->query($q, ['CartID' => $cart->getCart($cus_id)[0]->CartID, 'ProductID' => $id]);
        $info = $furniture->getFurniture($id);

        if (!empty($res)) {
            $order_items->updateQuantity($cart->getCart($cus_id)[0]->CartID, $id, $res[0]->Quantity + 1);
            $cart->updateTotalAmountToIncrease($cart->getCart($cus_id)[0]->CartID, $info[0]->Cost);

            $this->redirect("cashier/dash");
        }

        $info = $furniture->getFurniture($id);
        $image = $furniture->getDisplayImage($id);

        $data = [
            'ProductID' => $id,
            'Name' => $info[0]->Name,
            'Quantity' => 1,
            'Cost' => $info[0]->Cost,
            'OrderID' => $orderID,
            'CartID' => $cart->getCart($cus_id)[0]->CartID,
            'Image' => $image[0]->Image
        ];


        $cart->updateTotalAmountToIncrease($data['CartID'], $info[0]->Cost);

        $order_items->insert($data);

        $this->redirect("cashier/dash");
    }

    public function decreaseQuantity($cartID, $productID, $quantity, $cost)
    {

        if (!Auth::logged_in()) {
            $this->redirect('login1');
        }

        $cart = new Carts();
        $order_item = new Order_Items();
        if ($quantity > 1) {
            $order_item->updateQuantity($cartID, $productID, (int)$quantity - 1);
            $cart->updateTotalAmountToDecrease($cartID, $cost);
        }


        $this->redirect('cashier/dash');
    }

    public function removeItem($cartID, $productID, $cost, $quantity)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $cart = new Carts();
        $order_item = new Order_Items();
        $order_item->deleteItem($cartID, $productID);
        $cart->updateTotalAmountToDecrease($cartID, $cost * $quantity);

        $this->redirect('cashier/dash');
    }
}
