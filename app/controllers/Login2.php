<?php

class Login2 extends Controller
{
    public function index()
    {
        $data['errors'] = [];
        $employee = new Suppliers();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $row = $employee->where('Email', $_POST['Email']);


            if ($row) {
                if (password_verify($_POST['Password'], $row[0]->Password)) {
                    Auth::authenticate($row);

                    $this->redirect('supplier');
                }
            }
            $data['errors']['Email'] = "Wrong Email or Password";
        }

        $this->view('login2', $data);
    }
}
