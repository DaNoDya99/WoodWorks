<?php $this->view('manager/includes/header') ?>

<body class="manager">
<?php $this->view('manager/includes/manager_header') ?>
    <div class="content manager-body ">
        <div class="dashboard">
        
            <div class="posts">
                <h1 class="post-heading">Issues</h1>
                <div class="posts-table-container">
                <table class="issue-table">
                    <tr>
                        <th class="issue_table-head">Order ID</th>
                        <th>Problem Statement</th>
                        <th></th>
                    </tr>

                    <?php if(!empty($issue)): ?>
                        <?php foreach($issue as $data): ?>
                            <tr>
                                <td class="order-ID"><?= $data->OrderID ?></td>
                                <td><?= $data->Problem_statement ?></td>
                                <td>
                                    <a href="<?= ROOT ?>/issue/get_issues_details/<?= $data->IssueID ?>">Details</a>
                                    <a href="#">Response</a>
                                </td>  
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <h1>Empty.</h1>
                    <?php endif; ?>
                    
                    
                    

                </table>
                </div>
                
            </div>
        </div>
    </div>
</body>
</html>