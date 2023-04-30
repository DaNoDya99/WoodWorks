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

        <div class="popups">
            <div class="popups-heading">
                <h2>MORE DETAILS</h2>
                <img src="<?=ROOT?>/assets/images/driver/close.png" alt="Close" onclick="location.href='<?=ROOT?>/driver_home/order'">
            </div>

            <table class="details-table">
                <thead>
                    <tr>
                        <th class="th">Product Name</th>
                        <th class="th">Quantity</th>
                        <th class="th">Cost</th>
                        <th class="th">Image</th>
                    </tr>
                </thead>
                <tbody>
                <?php if(!empty($rows)):?>
                <?php foreach ($rows as $row):?>
                <tr>

                    <td><?=esc($row->Name)?></td>
                    <td><?=esc($row->Quantity)?></td>
                    <td>Rs. <?=esc($row->Cost)?>.00</td>
                    <td><img src="<?=ROOT?>/<?=$row->Image?>" alt="Product Image"></td>
                </tr>

                <?php endforeach;?>
                <?php else: ?>
                    <tr>
                        <td>N/A</td>
                        <td>N/A</td>
                        <td>N/A</td>
                        <td>N/A</td>
                    </tr>
                <?php endif;?>
                </tbody>

        </div>
    </div>
</div>

</body>
</html>

