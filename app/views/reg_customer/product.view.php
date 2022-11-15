<?php $this->view('reg_customer/includes/header'); ?>

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
            <h2><?=$row[0]->Name?></h2>
            <h1>Rs. <?=$row[0]->Cost?>.00</h1>
            <p>Wood Type : <?=$row[0]->Wood_type?></p>
            <p><?=$row[0]->Description?></p>
            <div class="product-details">
                <p class="product-detail"><?=$row[0]->Availability == 1 ? "In Stock" : "Out of Stock";?></p>
                <p class="product-detail"><?=$row[0]->Warrenty_period?> Warrenty</p>
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
        <div class="comments-sec">
            <div class="commenter-header">
                <div class="commenter-info">
                    <img src="<?=ROOT?>/assets/images/customer/user.png" alt="">
                    <h2>Anonymous</h2>
                </div>
                <p>01/01/2022</p>
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aliquam fuga nesciunt odit quas, voluptates. Facilis nihil qui quibusdam. Accusamus architecto atque aut blanditiis cumque deserunt, doloremque dolores doloribus et excepturi labore minus pariatur perferendis porro praesentium quae sed similique, tempore temporibus ullam unde voluptate voluptatum. Eos nihil optio sint.</p>
        </div>
        <div class="comments-sec">
            <div class="commenter-header">
                <div class="commenter-info">
                    <img src="<?=ROOT?>/assets/images/customer/user.png" alt="">
                    <h2>Anonymous</h2>
                </div>
                <p>01/01/2022</p>
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aliquam fuga nesciunt odit quas, voluptates. Facilis nihil qui quibusdam. Accusamus architecto atque aut blanditiis cumque deserunt, doloremque dolores doloribus et excepturi labore minus pariatur perferendis porro praesentium quae sed similique, tempore temporibus ullam unde voluptate voluptatum. Eos nihil optio sint.</p>
        </div>
        <div class="comments-sec">
            <div class="commenter-header">
                <div class="commenter-info">
                    <img src="<?=ROOT?>/assets/images/customer/user.png" alt="">
                    <h2>Anonymous</h2>
                </div>
                <p>01/01/2022</p>
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aliquam fuga nesciunt odit quas, voluptates. Facilis nihil qui quibusdam. Accusamus architecto atque aut blanditiis cumque deserunt, doloremque dolores doloribus et excepturi labore minus pariatur perferendis porro praesentium quae sed similique, tempore temporibus ullam unde voluptate voluptatum. Eos nihil optio sint.</p>
        </div>
    </div>
</div>

<?php $this->view('reg_customer/includes/footer'); ?>