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
                <div class="ref-fur-details-heading">
                    <h1><?=$furniture->Product_name?> - </h1>
                    <span><?=$furniture->AdvertisementID?></span>
                </div>

                <h3 class="price-section">Unit Price:  <span style="font-weight: normal;font-size: 1.2rem;">Rs. <?=$furniture->Price?>.00</span></h3>
                <h3 >Quantity:  <span style="font-weight: normal;font-size: 1.2rem;"><?=$furniture->Quantity?></span></h3>
<!--                <h2>Quantity: --><?php //=$furniture->Quantity?><!--</h2>-->
                <h3 class="price-section">Product Description</h3>
                <p class="ref-fur-description">
                    <?=$furniture->Description?>
                </p>
            </div>
        </div>
    </div>
    <script src="<?=ROOT?>/assets/javascript/slider.js"></script>
</body>
</html>