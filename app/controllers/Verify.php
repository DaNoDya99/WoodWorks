<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require_once 'Email.php';

require '../vendor/autoload.php';


class Verify extends Controller
{
    public function index()
    {
        $otp = new Otp();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($otp->validateOTP($_SESSION['Email'], $_POST['otp'])) {
                $customer = new Customer;
                $customer->activate_profile();
                $errors = ['msg' => 'success'];
                $this->redirect('login');
            } else {
                echo("failed");
            }
        }

        $this->view('verify');
    }

    public function resend_OTP()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $otp = new Otp();
            $otp = $otp->setOTP($_POST['Email']);
            $_SESSION['Email'] = $_POST['Email'];
            $mail = new Email();
            $mail->otp($otp, $_SESSION['Email']);

            $this->redirect('verify');
        }

        $this->view('verifyemail');
    }

    public
    function sendOTP()
    {
        $otp = new Otp();
        show($_SESSION['Email']);
        $otp = $otp->setOTP($_SESSION['Email']);

        $mail = new Email();

        #send otp to email
        $mail->otp($otp, $_SESSION['Email']);

        $this->redirect('verify');
    }
}
