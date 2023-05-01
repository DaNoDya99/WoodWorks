<?php

class Employee extends Controller
{

    public function delete($id = null)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login1');
        }

        $employee = new Employees();
        if(!$employee->deleteEmployee($id)){
            echo "success";
        }else{
            echo "error";
        }


    }

    public function getEmployee($id)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login1');
        }

        $employee = new Employees();
        $row = $employee->where('EmployeeID',$id)[0];

        echo json_encode($row);
    }

    public function editEmployee($id)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $employee = new Employees();
        $_POST['EmployeeID'] = $id;

        if($employee->edit_validate($_POST,$id))
        {
            $employee->updateEmployee($_POST);
            echo "success";
        }else{
            echo json_encode($employee->errors);
        }
    }
}