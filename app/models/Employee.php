<?php

class Employee extends Model
{
    public $errors = [];
    protected $table = "employee";

    protected $allowedColumns = [
        'EmployeeId',
        'Firstname',
        'Lastname',
        'Email',
        'Password',
        'Role',
        'Contactno'
    ];
}