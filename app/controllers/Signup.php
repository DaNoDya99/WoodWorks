<?php
require "../app/models/Customer.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require '../vendor/autoload.php';

class Signup extends Controller
{
    protected $message = '';

    public function index()
    {

        $customer = new Customer();
        $chats = new Messages();

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $folder = "uploads/images/";

            if ($customer->validate($_POST)) {
                $destination = $folder . "user.png";

                if (!file_exists(ROOT . "/assets/images/admin/user.png")) {
                    if (copy(ROOT . "/assets/images/admin/user.png", $destination)) {
                        $this->message = "Image cannot be copied.";
                    } else {
                        $this->message = "Image copied successfully.";
                    }
                }

                $_POST['Image'] = $destination;
                $chat = [
                    'username' => $_POST['Firstname'] . " " . $_POST['Lastname'],
                    'customerID' => $_POST['CustomerID'],
                    'status' => 'offline'
                ];
                $customer->insert($_POST);
                $chats->createChatAccount($chat);
                $_SESSION['Email'] = $_POST['Email'];
                $this->redirect('Verify');
            }
        }

        $data['errors'] = $customer->errors;

        $this->view('signup', $data);
    }
}