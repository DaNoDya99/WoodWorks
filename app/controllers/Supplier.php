<?php

class supplier extends Controller
{

    public function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect('Login2');
        }
        $orders = new CompanyOrderModel();
        $data['neworders']=$orders->getneworders();
        $this->view('supplier/dash', $data);
    }
    public function accepted()
    {
        if (!Auth::logged_in()) {
            $this->redirect('Login2');
        }
        $orders = new CompanyOrderModel();
        $data['acceptedorders']=$orders->getacceptedorders();

        $this->view('supplier/accepted',$data);
    }

    public function acceptOrder($id)
    {
        $orders = new CompanyOrderModel();
        $orders->update($id, ['OrderID' => $id, 'OrderStatus' => 'accepted']);
        $this->redirect('supplier/dash');
    }

    public function CompleteOrder($id)
    {
        $orders = new CompanyOrderModel();
        $orders->update($id, ['OrderID' => $id, 'OrderStatus' => 'complete']);
        $this->redirect('supplier/accpeted');
    }

    public function profile($id = null)
    {

        if (!Auth::logged_in()) {
            $this->redirect('login1');
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
                            show(move_uploaded_file($_FILES['Image']['tmp_name'], $destination));
                            die;
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
}
