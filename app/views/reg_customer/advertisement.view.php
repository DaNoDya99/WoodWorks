<?php
$cost = '';

if(!empty($furniture[0]->Discount_percentage) && $furniture[0]->Active === 1){
    $cost = round($furniture[0]->Cost*(100 - $furniture[0]->Discount_percentage)/100);
}else{
    $cost = $furniture[0]->Cost;
}
?>


<?php $data['row'] = $row; $this->view('reg_customer/includes/header',$data); ?>

<div class="product-view" style="padding-bottom: 20vh">
    <div class="product-desc-section">
        <div class="product-img">
            <div class="slide-show-container">
                <div class="my-slides fade">
                    <div class="number-text">1 / 3</div>
                    <img src="<?=ROOT?>/<?=$images[0]->Image?>" alt="">
                </div>
                <div class="my-slides fade">
                    <div class="number-text">2 / 3</div>
                    <img src="<?=ROOT?>/<?=$images[1]->Image?>" alt="">
                </div>
                <div class="my-slides fade">
                    <div class="number-text">3 / 3</div>
                    <img src="<?=ROOT?>/<?=$images[2]->Image?>" alt="">
                </div>

                <a class="prev" onclick="plusSlides(-1)">&#10094</a>
                <a class="next" onclick="plusSlides(1)">&#10095</a>
            </div>
            <br>
        </div>
        <div class="product-desc">
            <h2><?=$furniture[0]->Name?></h2>

            <?php if(!empty($furniture[0]->Discount_percentage)  && $furniture[0]->Active === 1) : ?>
                <div class="product-discount"><h2>Discount: <?=$furniture[0]->Discount_percentage?>%</h2></div>
                <div class="product-costs">
                    <h1 class="line-through">Rs. <?=$furniture[0]->Cost?>.00</h1>
                    <h1>Rs. <?= round($furniture[0]->Cost*(100 - $furniture[0]->Discount_percentage)/100) ?>.00</h1>
                </div>
            <?php else: ?>
                <h1>Rs. <?=$furniture[0]->Cost?>.00</h1>
            <?php endif; ?>

            <p><?=$furniture[0]->Description?></p>
            <div class="product-details">
                <p class="product-detail"><?=$furniture[0]->Availability == 1 ? "In Stock" : "Out of Stock";?></p>
                <p class="product-detail"><?=$furniture[0]->Warrenty_period?> Warrenty</p>
            </div>
            <div>
<!--                <a href="#">-->
                    <button style="display: none" onclick="addToCart('<?=$furniture[0]->ProductID?>',<?=$cost?>)">Add to cart</button>
<!--                </a>-->
            </div>
        </div>
    </div>

</div>

<div class="cat-response" id="response">

</div>
    <script src="<?=ROOT?>/assets/javascript/advertisement.js"></script>
    <script src="<?=ROOT?>/assets/javascript/slider.js"></script>
<?php $this->view('reg_customer/includes/footer'); ?>