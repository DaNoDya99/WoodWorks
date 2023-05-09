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
        'Reported_date',
        'Responded_date',
    ];

    public function generateIssueID() {
        $prefix = 'ISSUE';
        $unique_id = mt_rand(1000, 9999);
        $timestamp = substr(date('YmdHis'), 8, 6);
        return $prefix . '-' . $unique_id . '-' . $timestamp;
    }

    public function get_issue()
    {
        $query = "SELECT * FROM $this->table WHERE Response IS NULL ORDER BY Reported_date DESC;";
        return $this->query($query);
    }

    public function getIssuesDetails($id=null)
    {
        $query = "select * from issues where IssueID = :IssueID;";
        return $this->query($query,['IssueID' => $id]);

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

    public function getIssuesReportedForTheOrder($id)
    {
        $query = "SELECT * FROM $this->table WHERE OrderID = :OrderID ORDER BY Reported_date DESC;";
        return $this->query($query, ['OrderID' => $id]);
    }

    public function getIssueImages($id)
    {
        $query = "SELECT Image FROM issue_image WHERE IssueID = :IssueID;";

        return $this->query($query, ['IssueID' => $id]);
    }

    public function getIssueDetails($id)
    {
        $query = "SELECT * FROM $this->table WHERE IssueID = :IssueID;";
        return $this->query($query, ['IssueID' => $id]);
    }

    public function deleteIssue($id)
    {
        $query = "DELETE FROM $this->table WHERE IssueID = :IssueID;";

        return $this->query($query, ['IssueID' => $id]);
    }

    public function saveResponse($post)
    {
        $query = "UPDATE $this->table SET Response = :Response, Responded_date = :Responded_date,ManagerID = :ManagerID WHERE IssueID = :IssueID;";

        $data = [
            'Response' => $post['response'],
            'Responded_date' => date('Y-m-d H:i:s'),
            'IssueID' => $post['id'],
            'ManagerID' => $post['ManagerID'],
        ];

        return $this->query($query, $data);
    }

    public function getRespondedIssues()
    {
        $query = "SELECT * FROM $this->table WHERE Response IS NOT NULL ORDER BY Reported_date DESC;";

        return $this->query($query);
    }

}