<?php $this->view('driver/includes/header') ?>

<body class="driver">
<div class="driver-body">
    <?php $this->view('driver/includes/driver_sidebar') ?>
    <div class="dashboard">

        <div class="dashboard-nav">
            <div class="nav-item-page-name">
                <h1><?= $title ?></h1>
            </div>
            <div class="nav-item-user">
                <img src="<?=ROOT?>/<?=$details[0]->Image?>" alt="Profile picture">
                <div class="nav-vr"></div>
                <h1>Hi, <?=ucfirst(substr(Auth::getFirstname(),0,1))?>.<?=Auth::getLastname()?></h1>
                <div class="nav-vr"></div>
                <a href="<?=ROOT?>/logout">
                    <h1>Logout</h1>
                </a>
            </div>
        </div>

        <?php if(!empty($errors)):?>
            <div class="error-txt signup-error">
                <ul>
                    <?php foreach ($errors as $key => $value):?>
                        <li><?=$errors[$key]?></li>
                    <?php endforeach;?>
                </ul>
            </div>
        <?php endif;?>

        <?php $data['rows'] = $row; $this->view('driver/includes/order_table',$data) ?>
    </div>
</div>
<?php $this->view('driver/includes/footer'); ?>
</body>
</html>
