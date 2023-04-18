<?php

class Issue extends Controller
{
    public function index(){

    }
    
    public function get_issues_details($id=null)
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        // $issue = new Issues();
        // $data['issues'] = $issue->getIssuesDetails($id);

        $this->view('manager/issuedetails');
        

    }
    
    
}

