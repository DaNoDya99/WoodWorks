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

    public function generateIssueID() {
        $prefix = 'ISSUE';
        $unique_id = mt_rand(1000, 9999);
        $timestamp = substr(date('YmdHis'), 8, 6);
        return $prefix . '-' . $unique_id . '-' . $timestamp;
    }

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

    public function getissuehistory()
    {
        $query = "select `IssueID`, `OrderID`, `Problem_statement`, `Response` from $this->table where Response != 'null';";
        return $this->query($query);
    }

    public function getPendingIssuesCount()
    {
        $query = "SELECT COUNT(IssueID) AS Count FROM $this->table WHERE Response IS NULL;";

        return $this->query($query);
    }

    public function insertImages($IssueID, $images)
    {
        foreach ($images as $image) {
            $query = "insert into issue_image (`IssueID`, `Image`) values (:IssueID,:Image);";
            $data = [
                'IssueID' => $IssueID,
                'Image' => $image,
            ];

            $this->query($query, $data);
        }
    }

}