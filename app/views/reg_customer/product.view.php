<?php
$cost = '';

if(!empty($furniture[0]->Discount_percentage)){
    $cost = $furniture[0]->Cost*(100 - $furniture[0]->Discount_percentage)/100;
}else{
    $cost = $furniture[0]->Cost;
}
?>


<?php $data['row'] = $row; $this->view('reg_customer/includes/header',$data); ?>

<div class="product-view">
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

            <?php if(!empty($furniture[0]->Discount_percentage)) : ?>
                <div class="product-discount"><h2>Discount: <?=$furniture[0]->Discount_percentage?>%</h2></div>
                <div class="product-costs">
                    <h1 class="line-through">Rs. <?=$furniture[0]->Cost?>.00</h1>
                    <h1>Rs. <?= $furniture[0]->Cost*(100 - $furniture[0]->Discount_percentage)/100 ?>.00</h1>
                </div>
            <?php else: ?>
                <h1>Rs. <?=$furniture[0]->Cost?>.00</h1>
            <?php endif; ?>

            <p>Wood Type : <?=$furniture[0]->Wood_type?></p>
            <p><?=$furniture[0]->Description?></p>
            <div class="product-details">
                <p class="product-detail"><?=$furniture[0]->Availability == 1 ? "In Stock" : "Out of Stock";?></p>
                <p class="product-detail"><?=$furniture[0]->Warrenty_period?> Warrenty</p>
            </div>
            <div>
<!--                <a href="#">-->
                    <button onclick="addToCart('<?=$furniture[0]->ProductID?>',<?=$cost?>)">Add to cart</button>
<!--                </a>-->
            </div>
        </div>
    </div>
    <div class="review-section">
        <div class="overall-rate-sec">
            <div class="rate-info">
                <img src="<?=ROOT?>/assets/images/customer/star.png" alt="Star">
                <h1>5.0</h1>
            </div>
            <p>(Based on last 10 customer reviews)</p>
        </div>
        <?php if(!empty($reviews)):?>
            <?php foreach ($reviews as $review):?>
                <div class="comments-sec">
                    <div class="commenter-header">
                        <div class="commenter-info">
                            <img src="<?=ROOT?>/<?=$review->Image?>" alt="">
                            <h2><?=$review->Firstname?> <?=$review->Lastname?></h2>
                        </div>
                        <p><?=$review->Date?></p>
                    </div>
                    <p><?=$review->Reviews?></p>
                </div>
            <?php endforeach;?>
        <?php endif;?>
    </div>
</div>

    <script src="<?=ROOT?>/assets/javascript/slider.js"></script>
<?php $this->view('reg_customer/includes/footer'); ?>