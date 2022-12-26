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
                    <a href="<?=ROOT?>/logout">
                        <h1>Logout</h1>
                    </a>
                </div>
            </div>
            <div>
                <div class="review-container">
                    <div class="review-header">
                        <h1><?=$name[0]->Name?></h1>
                        <img src="<?=ROOT?>/<?=$image[0]->Image?>" alt="Product Image">
                    </div>
                    <div class="reviews">
                        <?php if(!empty($furniture)): ?>
                            <?php foreach($furniture as $row): ?>
                                <div class="review">
                                    <div>
                                        <div class="rate">
                                            <h1><?=$row->Rating?></h1>
                                            <img src="<?=ROOT?>/assets/images/customer/star.png" alt="Star">
                                        </div>
                                        <h2><?=$row->Date?></h2>
                                    </div>
                                    <p><?=$row->Reviews?></p>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="review-err">
                                <h1>No Reviews Yet!</h1>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>