<?php

class supplier extends Controller
{

    public function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect('Login');
        }
        $orders = new CompanyOrderModel();
        $data['neworders'] = $orders->getneworders();
        $this->view('supplier/dash', $data);
    }

    public function getneworders()
    {
        $orders = new CompanyOrderModel();

        $furnitures = new Furnitures();

        $order_item = new CompanyOrderItems();
        $data['neworders'] = $orders->getneworders();
        echo json_encode($data);
    }

    public function getItemsByOrderID($id)
    {
        $order_item = new CompanyOrderItems();
        $furnitures = new Furnitures();

        $data['items'] = $order_item->getItemsByOrderID($id);
        if (count((array)$data['items']) == 0) {
            echo json_encode(['status' => 'error', 'message' => 'No items found.']);
            return;
        } else {
            for ($i = 0; $i < count((array)$data['items']); $i++) {
                $data['items'][$i]->image = $furnitures->getDisplayImage($data['items'][$i]->ProductID)[0]->Image;
            }
            echo json_encode($data);
        }

    }

    public function accepted()
    {
        if (!Auth::logged_in()) {
            $this->redirect('Login');
        }
        $orders = new CompanyOrderModel();
        $data['acceptedorders'] = $orders->getacceptedorders();

        $this->view('supplier/accepted', $data);
    }

    public function changeOrderStatus($id, $status)
    {
        $orders = new CompanyOrderModel();
        if ($orders->findOrder($id)) {
            $orders->changeOrderStatus($id, $status);
            echo json_encode(['status' => 'success', 'message' => 'Order status changed successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Order does not exist.']);
        }
    }

    public function acceptOrder($id)
    {
        $orders = new CompanyOrderModel();
        $orders->update($id, ['OrderID' => $id, 'OrderStatus' => 'accepted']);
        echo json_encode(['status' => 'success']);
    }

    public function CompleteOrder($id)
    {
        $orders = new CompanyOrderModel();
        $orders->update($id, ['OrderID' => $id, 'OrderStatus' => 'complete']);
        $this->redirect('supplier/accepted');
    }

    public function profile($id = null)
    {

        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $id = $id ?? Auth::SupplierID();
        $supplier = new Suppliers();
        $data['row'] = $row = $supplier->where('SupplierID', $id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $row) {
            $folder = "uploads/images/";
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
                file_put_contents($folder . "index.php", "<?php Access Denied.");
                file_put_contents("uploads/index.php", "<?php Access Denied.");
            }

            if ($supplier->edit_validate($_POST, $id)) {
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
                            $supplier->errors['image'] = "This file type is not allowed.";
                        }
                    } else {
                        $supplier->errors['image'] = "Could not upload image.";
                    }
                }

                $_POST['SupplierID'] = $id;
                $supplier->update($id, $_POST);
                $this->redirect('supplier/profile/' . $id);
            }
        }
        $this->view('supplier/profile', $data);
    }

    public function add()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $supplier = new Suppliers();
            if ($supplier->validate($_POST)) {
                $supplier->insert($_POST);
            } else {
                $errors = $supplier->errors;
            }
        }

        if (empty($errors)) {
            echo "Supplier Added Successfully";
        } else {
            echo json_encode($errors);
        }
    }

    public function getSupplier($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $supplier = new Suppliers();

        $row = $supplier->where('SupplierID', $id);

        if ($row) {
            echo json_encode($row[0]);
        } else {
            echo "Supplier Not Found";
        }
    }

    public function delete($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $supplier = new Suppliers();

        if (!$supplier->deleteSupplier($id)) {
            echo "<div class='cat-success cat-deletion'>
                  <h3>Supplier Deleted Successfully!</h3>
              </div>";
        } else {
            echo "Supplier Not Found";
        }
    }

    public function getAllOrders(){
//        if (!Auth::logged_in()) {
//            $this->redirect('login');
//        }

        $orders = new CompanyOrderModel();

        $data['orders'] = $orders->getAllOrders();

        echo json_encode($data);
    }

    public function save($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $supplier = new Suppliers();

        $_POST['SupplierID'] = $id;

        if (!$supplier->updateSupplier($_POST)) {
            echo "<div class='cat-success'>
                  <h3>Supplier Updated Successfully!</h3>
              </div>";
        } else {
            echo "Supplier Not Found";
        }

    }
}
