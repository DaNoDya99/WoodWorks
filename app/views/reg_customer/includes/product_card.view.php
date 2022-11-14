
    <div class="product-card">
        <div class="product-card-img">
            <img src="<?=ROOT?>/assets/images/customer/chair.jpg" alt="Product Image">
        </div>
        <h2><?=$row->Name?></h2>
        <div>
            <h3>Rs. <?=$row->Cost?></h3>
            <a href="<?=ROOT?>/furniture/view_product/<?=$row->ProductID?>">
                <button>Read More</button>
            </a>
        </div>
    </div>
