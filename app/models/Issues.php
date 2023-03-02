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
        $query = "SELECT `IssueID`,`OrderID`, `Problem_statement`, `Response` FROM $this->table WHERE Response='null';";
        return $this->query($query);
    }

    public function getIssuesDetails($id=null)
    {
        $query = "select * from issues where IssueID = :IssueID;";
        return $this->query($query,['Issue' => $id]);

    }

}