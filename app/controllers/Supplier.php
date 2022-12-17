<?php

class supplier extends Controller
{

    public function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect('Login2');
        }
        $orders = new CompanyOrderModel();
        $data['orderdata'] = $orders->where('SupplierID', Auth::getSupplierID());

        $this->view('supplier/dash', $data);
    }

    public function profile($id = null)
    {

        if (!Auth::logged_in()) {
            $this->redirect('Login2');
        }
        $id = $id ?? Auth::SupplierID();

        $user = new Suppliers();
        $data['row'] = $row = $user->where('SupplierID', $id)[0];
        $_SESSION['USER_DATA'] = $row;
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $row) {


            $folder = 'uploads/images/';
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
                file_put_contents($folder . "index.php", "<?php //silence");
                file_put_contents("uploads/index.php", "<?php //silence");
            }

            $allowed = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!empty($_FILES['image']['name'])) {
                if ($_FILES['image']['error'] == 0) {
                    if (in_array($_FILES['image']['type'], $allowed)) {
                        $destination = $folder . time() . $_FILES['image']['name'];
                        move_uploaded_file($_FILES['image']['tmp_name'], $destination);
                        $_POST['Image'] = $destination;
                    } else {
                        $user->errors['image'] = 'Invalid file type';
                    }
                } else {
                    $user->errors['image'] = 'Error uploading file';
                }
            }
            $_POST['SupplierID'] = $id;
            $user->update($row->SupplierID, $_POST);
            $this->redirect('supplier/profile/' . $row->SupplierID);
        }

        $this->view('supplier/profile', $data);
    }
}
