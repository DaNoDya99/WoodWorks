<?php $this->view('manager/includes/header') ?>

<body class="manager">
<div class="manager-body ">
    <?php $this->view('manager/includes/manager_header') ?>
    <div class="content manager-content">

            <div class="issues-container">
                <div class="ads-heading">
                    <h2>Pending Issues</h2>
                    <a href="#" onclick="openPopup()"><button>Responded Issues</button></a>
                </div>

                <div class="posts-table-container">
                    <table class="issue-table">
                        <thead>
                            <tr>
                                <th>Issue ID</th>
                                <th>Order ID</th>
                                <th>Customer Name</th>
                                <th>Customer Contact</th>
                                <th>Customer Email</th>
                                <th>Reported Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($issues)): ?>
                                <?php foreach($issues as $issue): ?>
                                    <tr>
                                        <td><?=$issue->IssueID?></td>
                                        <td><?=$issue->OrderID,0,8?></td>
                                        <td><?=$issue->First_name?> <?=$issue->Last_name?></td>
                                        <td><?=$issue->Contact_number?></td>
                                        <td><?=$issue->Email?></td>
                                        <td><?=$issue->Reported_date?></td>
                                        <td>

                                            <div class='inv-table-btns manager-btns'>
                                                <button onclick="getIssueInfo('<?=$issue->IssueID?>')"><img src='http://localhost/WoodWorks/public/assets/images/manager/info-svgrepo-com.svg' alt=''></button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7">No Pending Issues Found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                        
                    </table>
                </div>
                
            </div>
        </div>
    </div>

    <div class="popup responded-issues-popup" id="responded-issues-popup">
        <div class="popup-heading">
            <h2>Responded Issues</h2>
            <img src="<?=ROOT?>/assets/images/customer/close.png" alt="Close" onclick="closePopup()">
        </div>

        <div class="posts-table-container">
            <table class="issue-table">
                <thead>
                <tr>
                    <th>Issue ID</th>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Customer Contact</th>
                    <th>Customer Email</th>
                    <th>Reported Date</th>
                    <th>Responded Date</th>
                    <th>Responded Manager</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="t-body">

                </tbody>
            </table>
        </div>
    </div>

    <div class="popup issues-info-popup" id="issues-info-popup">
        <div class="popup-heading">
            <h2 id="issue-id"></h2>
            <img src="<?=ROOT?>/assets/images/customer/close.png" alt="Close" onclick="closeIssueInfoPopup()">
        </div>

        <div class="issue-details-container" id="issue-details">

        </div>

    </div>

<div class="cat-response" id="response">

</div>

    <script src="<?=ROOT?>/assets/javascript/issuedetails.js"></script>
</body>
</html>