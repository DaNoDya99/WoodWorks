<?php

require_once 'Email.php';

class pw_reset extends Controller
{

    public function index()
    {
        $data = [];
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $customer = new Customer();
            $_SESSION['Email'] = $_POST['Email'];
            $result_cus = $customer->where('Email', $_POST['Email']);
            if (empty($result_cus)) {
                $errors = ['msg' => 'Account Does Not Exist'];
            } else {
                $otp = rand(100000, 999999);
                $_SESSION['otp'] = $otp;
                $_SESSION['email'] = $_POST['Email'];
                $email = new Email();
                $email->otp($otp, $_POST['Email']);
                $this->redirect('pw_reset/verify');
            }
            $this->view('pwreset', $errors);

        }
        $this->view('pwreset', $errors);

    }

    public
    function verify()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST['otp'] == $_SESSION['otp']) {
                $this->redirect('pw_reset/reset');
            } else {
                $errors = ['msg' => 'Invalid OTP'];
                $this->view('pwresetverify', $errors);
            }
        }
        $this->view('pwresetverify');
    }

    public function reset()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST['Password1'] == $_POST['Password2']) {
                $customer = new Customer();
                $customer->update($_SESSION['Email'], ['Email' => $_SESSION['Email'], 'Password' => password_hash($_POST['Password1'], PASSWORD_DEFAULT)]);
                $this->redirect('login');
            } else {
                $errors = ['msg' => 'Passwords do not match'];
                $this->view('pwresetpoint', $errors);
            }
        }
        $this->view('pwresetpoint');
    }

}