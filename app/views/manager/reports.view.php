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
        </div>
    </div>

</body>
</html>