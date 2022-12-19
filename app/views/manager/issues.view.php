<?php $this->view('manager/includes/header') ?>

<body class="manager">
    <div class="manager-body">
        <?php $this->view('manager/includes/manager_sidebar') ?>
        <div class="dashboard">
            <div class="dashboard-nav">
                <div class="nav-item-page-name">
                    <h1><?= $title ?></h1>
                </div>
                <div class="nav-item-user">
                    <img src="<?=ROOT?>/assets/images/manager/user.png" alt="Profile picture">
                    <div class="nav-vr"></div>
                    <h1>Hi, <?=Auth::getFirstname()?></h1>
                    <div class="nav-vr"></div>
                    <a href="<?=ROOT?>/logout4">
                        <h1>Logout</h1>
                    </a>
                </div>
            </div>
            <div class="posts">
                <h1 class="post-heading">Issues</h1>
                <div class="posts-table-container">
                <table class="issue-table">
                    <tr>
                        <th>Order ID</th>
                        <th>Problem Statement</th>
                        <th></th>
                    </tr>
                    
                    <tr>
                        <td>ad45afg6j2bb5hy9uhbtre</td>
                        <td>I brought a index stool last month and its paint was gone.</td>
                        <td>
                            <a href="#">Details</a>
                            <a href="#">Response</a>
                        </td>  
                    </tr>
                    <tr>
                        <td>ef45afg6j2bb5hy9uhbdf</td>
                        <td>I brought a index stool last month and its paint was gone.</td>
                        <td>
                            <a href="#">Details</a>
                            <a href="#">Response</a>
                        </td>  
                    </tr>
                    <tr>
                        <td>cd45afg6j2bb5hy9uhabc</td>
                        <td>I brought a index stool last month and its paint was gone.</td>
                        <td>
                            <a href="#">Details</a>
                            <a href="#">Response</a>
                        </td>  
                    </tr>

                </table>
                </div>
                
            </div>
        </div>
    </div>
</body>
</html>