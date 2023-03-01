<?php $this->view('manager/includes/header') ?>

<body class="manager">
<?php $this->view('manager/includes/manager_header') ?>
    <div class="manager-body content">
        <div class="ref-fur-container">
            <div class="ref-fur-slider">
                <img class="ref-fur-primary-img" src="<?=ROOT?>/<?= $primary_image[0]->Image?>" alt="">
                <div class="ref-fur-secondary-imgs">
                    <img src="<?=ROOT?>/<?= $secondary_images[0]->Image?>" alt="">
                    <img src="<?=ROOT?>/<?= $secondary_images[1]->Image?>" alt="">
                </div>
            </div>
            <div class = "ref-fur-details">
                <h1><?=$furniture->Product_name?></h1>
                <span><?=$furniture->AdvertisementID?></span>
                <h2>Rs. <?=$furniture->Price?>.00</h2>
                <h2>Quantity: <?=$furniture->Quantity?></h2>
                <pre>
                    <?=$furniture->Description?>
                </pre>
            </div>
        </div>
    </div>
    <script src="<?=ROOT?>/assets/javascript/slider.js"></script>
</body>
</html>