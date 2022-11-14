<?php $this->view('reg_customer/includes/header'); ?>

<div class="product-desc-section">
    <div class="product-img">
        <img src="<?=ROOT?>/assets/images/customer/chair.jpg" alt="product image">
    </div>
    <div class="product-desc">
        <h2><?=$row[0]->Name?></h2>
        <h1>Rs. <?=$row[0]->Cost?>.00</h1>
        <h2>Wood Type : <?=$row[0]->Wood_type?></h2>
        <p><?=$row[0]->Description?></p>
        <p><?=$row[0]->Availability == 1 ? "In Stock" : "Out of Stock";?></p>

        <div>
            <button>Add to cart</button>
        </div>
    </div>
</div>

<?php $this->view('reg_customer/includes/footer'); ?>