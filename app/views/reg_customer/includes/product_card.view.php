<div class="product-card">
    <?php if(!empty($row->Discount_percentage)): ?>
        <div onclick="calDiscount()" class="product-card-discount">
            <p><?=$row->Discount_percentage?>% Discount</p>
        </div>
    <?php endif; ?>
        <div class="product-card-img">
            <img src="<?=ROOT?>/<?=$row->Image?>" alt="Product Image">
        </div>
        <div>
            <h2><?=$row->Name?></h2>
            <div class="product-card-details">
                <h3>Rs. <?=$row->Cost?>.00</h3>
                <div>
                    <img src="<?=ROOT?>/assets/images/customer/star.png" alt="Star">
                    <img src="<?=ROOT?>/assets/images/customer/star.png" alt="Star">
                    <img src="<?=ROOT?>/assets/images/customer/star.png" alt="Star">
                    <img src="<?=ROOT?>/assets/images/customer/star.png" alt="Star">
                    <img src="<?=ROOT?>/assets/images/customer/star.png" alt="Star">
                    <h3>5.0</h3>
                </div>
            </div>
            <div class="product-card-buttons">
                <a href="<?=ROOT?>/furniture/view_product/<?=$row->ProductID?>">
                    <button>More Details</button>
                </a>
                <a href="<?=ROOT?>/customer_home/add_to_cart/<?=$row->ProductID?>">
                    <img src="<?=ROOT?>/assets/images/customer/shopping-cart.png" alt="Cart Image">
                </a>
            </div>
        </div>

</div>



