<?php

class Login3 extends Controller
{
    public function index()
    {
        $data['errors'] = [];
        $employee = new Employees();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $row = $employee->where('Email', $_POST['Email']);


            if ($row) {
                if (password_verify($_POST['Password'], $row[0]->Password)) {
                    Auth::authenticate($row[0]);
                    $this->redirect('cashier');
                }
            }
            $data['errors']['Email'] = "Wrong Email or Password";
        }

        $this->view('login3', $data);
    }
}