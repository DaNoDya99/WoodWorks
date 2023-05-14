<?php

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require '../vendor/autoload.php';

class Email extends Controller
{

    function otp($otpcode, $email)
    {
        ob_start();

        include('../public/assets/templates/otp.php');

        $content = ob_get_clean(); // Get the buffered contents and clean the buffer

        $this->send($email, 'Sign-up Verification', $content);
    }

    function bill($email)
    {
        ob_start();

        include('../public/assets/templates/bill.php');
        $content =  ob_get_clean();
        $this->send($email, 'Sign-up Verification', $content);
    }

    function send($emailTo, $subject, $body): void
    {
        $mail = new PHPMailer();

        $mail->isSMTP();
        $mail->SMTPDebug = false;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->SMTPAuth = true;
        $mail->Username = 'woodworks.cs07@gmail.com';
        $mail->Password = 'hqhwbabdlbyduclq';
        $mail->setFrom('woodworks.cs07@gmail.com', 'WoodWorks Mail Service');
        $mail->addReplyTo('woodworks.cs07@gmail.com', 'WoodWorks Mail Service');
        $mail->addAddress($emailTo, 'John Doe');
        $mail->Subject = $subject;
        $mail->msgHTML($body);
        if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message sent!';
        }
    }
}