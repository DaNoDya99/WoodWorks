<?php $this->view('designer/includes/header') ?>

<body class="designer">
<div class=" designer-body">
    <?php $this->view('designer/includes/designer_header') ?>
    <div class="content dashboard">

        <div class="add-des-bar">
            <a class="go-back" href="<?=ROOT?>/designer/view_design_categories">
                <img src="<?=ROOT?>/assets/images/designer/back.png" alt="Back Button">
                <h1>Back</h1>
            </a>
        </div>

        <div class="des_category-body">
            <h1>New Designs</h1>
            <div class="des_categories">
                <?php if(!empty($rows)): ?>
                <?php foreach ($rows as $row) :?>
                    <a href="<?=ROOT?>/designer/view_design/<?=$row->DesignID?>">
                        <div class="des_category-card">
                            <img src="<?=ROOT?>/<?=$row->Image?>" alt="design image" loading="lazy">
                            <p><?=$row->Name?><br><?=$row->DesignID?><br><?=$row->Date?></p>
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
