<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require '../vendor/autoload.php';


class Verify extends Controller
{
    public function index()
    {
            $otp = new Otp();
        if (1) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($otp->validateOTP($_SESSION['email'],$_POST['otp'])) {
                    $customer = new Customer;
                    $customer->activate_profile();
                    $errors = ['msg' => 'success'];
                    $this->redirect('login');
                } else {
                    echo ("failed");
                }
            }
        } else {
            $this->redirect('signup');
        }
        $this->view('verify');
    }
//    public function resendOTP()
//    {
//        $errors = [];
//        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//            $customer = new Customer();
//            $result_cus = $customer->where('Email', $_POST['Email']);
//            if ($result_cus) {
//                if ($result_cus[0]->status == 1) {
//                    $errors = ['msg' => 'Your account is already activated. Please <a href="' . ROOT . '/login">login</a>'];
//                } else {
//
//                    $otp = rand(100000, 999999);
//                    $_SESSION['otp'] = $otp;
//                    $_SESSION['email'] = $_POST['Email'];
//                    $mail = new PHPMailer();
//
//                    $mail->isSMTP();
//                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
//                    $mail->Host = 'smtp.gmail.com';
//                    $mail->Port = 465;
//                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
//                    $mail->SMTPAuth = true;
//                    $mail->Username = 'woodworks.cs07@gmail.com';
//                    $mail->Password = 'hqhwbabdlbyduclq';
//                    $mail->setFrom('woodworks.cs07@gmail.com', 'WoodWorks Mail Service');
//                    $mail->addReplyTo('woodworks.cs07@gmail.com', 'WoodWorks Mail Service');
//                    $mail->addAddress($_POST['Email']);
//                    $mail->Subject = 'Your verification code';
//                    $mail->Body = 'Your verification code is: ' . $otp;
//                    if (!$mail->send()) {
//                        echo 'Mailer Error: ' . $mail->ErrorInfo;
//                    } else {
//                        echo 'Message sent!';
//                    }
//
//                    $this->redirect('Verify');
//                }
//            } else {
//                $errors = ['msg' => 'E-mail Address not found. Please <a href="' . ROOT . '/signup">sign up</a> first.'];
//            }
//        }
//
//        $this->view('resendotp', $errors);
//    }

    public function sendOTP(){
            $otp = new Otp();
            show($_SESSION['Email']);
            $otp = $otp->setOTP($_SESSION['Email']);
            
            $_SESSION['email'] = $_SESSION['Email'];
            

            $this->redirect('verify');
    }
}
