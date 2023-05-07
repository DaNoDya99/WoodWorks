<?php $this->view('driver/includes/header') ?>

<body class="driver">
<div class="driver-body">
    <?php $this->view('driver/includes/driver_header') ?>
    <div class="content dashboard">

        <?php if(!empty($errors)):?>
            <div class="error-txt signup-error">
                <ul>
                    <?php foreach ($errors as $key => $value):?>
                        <li><?=$errors[$key]?></li>
                    <?php endforeach;?>
                </ul>
            </div>
        <?php endif;?>

        <?php $data['rows'] = $row; $this->view('driver/includes/orders_details_table',$data) ?>
    </div>
</div>
</body>
<script src="<?=ROOT?>/assets/javascript/driver/orders_tabs.js"></script>
<script src="<?=ROOT?>/assets/javascript/driver/moreDetails.js"></script>
</html>
