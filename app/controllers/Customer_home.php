<?php

class Customer_home extends Controller
{
    public function index()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login1');
        }

        $furniture = new Furnitures();
        $customer = new Customer();
        $id = Auth::getCustomerID();
        $data['row'] = $customer->where('CustomerID',$id);
        $data['furnitures'] =$rows= $furniture->getNewFurniture(['ProductID','Name','Cost']);

        foreach ($rows as $row)
        {
            if(!empty($furniture->getDisplayImage($row->ProductID)[0]->Image))
            {
                $row->Image = $furniture->getDisplayImage($row->ProductID)[0]->Image;
            }
        }

        $this->view('reg_customer/customer_home',$data);
    }

    public function profile($id = null){

        if(!Auth::logged_in()){
            $this->redirect('login1');
        }

        $customer = new Customer();
        $id = Auth::getCustomerID();
        $data['row'] = $row = $customer->where('CustomerID',$id);

        if($_SERVER['REQUEST_METHOD'] == 'POST' && $row)
        {
            $folder = "uploads/images/";
            if(!file_exists($folder)){
                mkdir($folder,0777,true);
                file_put_contents($folder."index.php","<?php Access Denied.");
                file_put_contents("uploads/index.php","<?php Access Denied.");
            }

            if($customer->edit_validate($_POST))
            {
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
                            $customer->errors['image'] = "This file type is not allowed.";
                        }
                    }else{
                        $customer->errors['image'] = "Could not upload image.";
                    }
                }

                $_POST['CustomerID'] = $id;

                $customer->update($id,$_POST);
                $this->redirect('customer_home/profile/'.$id);
            }
        }

        $data['errors'] = $customer->errors;

        $this->view('reg_customer/profile',$data);
    }

    public function add_to_cart($id){

        if(!Auth::logged_in()){
            $this->redirect('login1');
        }

        $order = new Orders();
        $furniture = new Furnitures();
        $cart = new Carts();
        $order_items = new Order_Items();
        $cus_id = Auth::getCustomerID();
        $orderID = '';

        if(empty($cart->getCart($cus_id)))
        {
            $cart->setCart($cus_id);
        }

        if(empty($order->checkIsPreparing($cus_id)))
        {
            $orderID = $order->setOrder($cus_id);
        }else
        {
            $orderID = $order->checkIsPreparing($cus_id)[0]->OrderID;
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

        $cart->updateTotalAmountToIncrease($data['CartID'],$info[0]->Cost);

        $order_items->insert($data);

        $this->redirect("furniture/view_product/".$id);
    }

    public function removeItem($cartID,$productID,$cost,$quantity)
    {
        $cart = new Carts();
        $order_item = new Order_Items();
        $order_item->deleteItem($cartID,$productID);
        $cart->updateTotalAmountToDecrease($cartID,$cost*$quantity);

        $this->redirect('cart');
    }

}