<?php
class Issues extends Model
{
    public $errors = [];
    protected $table = "issues";

    protected $allowedcolumns = [

        'IssueID',	
        'Problem_statement',	
        'CustomerID',	
        'OrderID',	
        'ManagerID',	
        'Response',
    ];

    public function get_issue()
    {
        $query = "SELECT `OrderID`, `Problem_statement`, `Response` FROM $this->table WHERE Response='null';";
        return $this->query($query);
    }

}