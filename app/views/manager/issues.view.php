<?php $this->view('manager/includes/header') ?>

<body class="manager">
<?php $this->view('manager/includes/manager_header') ?>
    <div class="content manager-body ">
        <div class="dashboard">
            <div class="posts">
                <div class="ads-heading">
                    <h1 class="post-heading">Issues</h1>
                    <button onclick = "openPopup()">History</button>
                    <div class="popup advertisement-popup" id="popup">
                        <div class="popup-heading">
                            <h2>All Issues</h2>
                            <img src="<?=ROOT?>/assets/images/customer/close.png" alt="Close" onclick="closePopup()">
                        </div>
                    </div>
                </div>

                

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