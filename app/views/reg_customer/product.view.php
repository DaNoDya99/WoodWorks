<?php $data['row'] = $row; $this->view('reg_customer/includes/header',$data); ?>

<div class="product-view">
    <div class="product-desc-section">
        <div class="product-img">
            <img src="<?=ROOT?>/assets/images/customer/chair.jpg" alt="product image">
            <div class="product-sub-img">
                <img src="<?=ROOT?>/assets/images/customer/chair.jpg" alt="product image">
                <img src="<?=ROOT?>/assets/images/customer/chair.jpg" alt="product image">
            </div>
        </div>
        <div class="product-desc">
            <h2><?=$furniture[0]->Name?></h2>
            <h1>Rs. <?=$furniture[0]->Cost?>.00</h1>
            <p>Wood Type : <?=$furniture[0]->Wood_type?></p>
            <p><?=$furniture[0]->Description?></p>
            <div class="product-details">
                <p class="product-detail"><?=$furniture[0]->Availability == 1 ? "In Stock" : "Out of Stock";?></p>
                <p class="product-detail"><?=$furniture[0]->Warrenty_period?> Warrenty</p>
            </div>
            <div>
                <button>Add to cart</button>
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

<?php $this->view('reg_customer/includes/footer'); ?>