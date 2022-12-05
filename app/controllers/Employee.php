<?php

class Employee extends Controller
{
    public function edit()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login1');
        }
    }

    public function delete($id = null)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login1');
        }

        $employee = new Employees();
        $employee->deleteEmployee($id);

        $this->redirect('admin/employees');
    }
}