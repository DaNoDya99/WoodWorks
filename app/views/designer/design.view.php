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
                <img src="<?=ROOT?>/assets/images/designer/user.png" alt="Profile picture">
                <div class="nav-vr"></div>
                <h1>Hi, <?=ucfirst(substr(Auth::getFirstname(),0,1))?>.<?=Auth::getLastname()?></h1>
                <div class="nav-vr"></div>
                <a href="<?=ROOT?>/logout3">
                    <h1>Logout</h1>
                </a>
            </div>
        </div>

        <div class="add-des-bar">
            <a href="<?=ROOT?>/designer/add_design">
                <button>Add New Design</button>
            </a>
            <h1>No of designs : <?="hi"?></h1>
        </div>

        <div>
            <section class="container">
                <?php foreach ($rows as $row):?>
                    <?php $data['row'] = $row; $this->view('designer/includes/design_card',$data) ?>
                <?php endforeach;?>
            </section>
        </div>

    </div>
</div>

</body>
</html>
