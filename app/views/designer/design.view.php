<?php $this->view('designer/includes/header') ?>

<body class="designer">
<div class="designer-body">
    <?php $this->view('designer/includes/designer_sidebar') ?>
    <div class="dashboard">

        <div class="dashboard-nav">
            <div class="nav-item-page-name">
                <h1><?= $title ?></h1>
            </div>
            <div class="nav-item-user">
                <img src="<?=ROOT?>/<?=$row[0]->Image?>" alt="Profile picture">
                <div class="nav-vr"></div>
                <h1>Hi, <?=ucfirst(substr(Auth::getFirstname(),0,1))?>.<?=Auth::getLastname()?></h1>
                <div class="nav-vr"></div>
                <a href="<?=ROOT?>/logout3">
                    <h1>Logout</h1>
                </a>
            </div>
        </div>

        <div class="des_category-body">
            <h1>Your Designs</h1>
            <div class="des_categories">
                <?php if(!empty($rows)): ?>
                <?php foreach ($rows as $row) :?>
                    <a href="<?=ROOT?>/designer/view_design/<?=$row->DesignID?>">
                        <div class="des_category-card">
                            <img src="<?=ROOT?>/<?=$row->Image?>" alt="design image" loading="lazy">
                            <p><?=$row->Name?><br><?=$row->Date?></p>
                        </div>
                    </a>
                <?php endforeach;?>
                <?php else :?>
                <h1>No designs to show.</h1>
                <?php endif; ?>
            </div>
            <?php $pager->display()?>
        </div>

    </div>
</div>
</body>

<?php $this->view('designer/includes/footer'); ?>