<a href="<?=ROOT?>/furniture/view_product/<?=$row->ProductID?>">
    <div class="product-card">
        <?php if (!empty($row->Discount_percentage && $row->Active === 1)) : ?>
            <div class="product-card-discount">
                <p><?= $row->Discount_percentage ?>% Discount</p>
            </div>
        <?php endif; ?>
        <div class="product-card-img">
            <img src="<?= ROOT ?>/<?= $row->Image ?>" alt="Product Image">
        </div>
        <div class="card-pair">
            <div class="product-card-details">
                <div class="rating">
                    <span><?= $row->Rate ?></span>
                    <div>
                        <div class="stars-outer product-card-stars-outer">
                            <div class="stars-inner" style="width: <?= $row->Rating ?>"></div>
                        </div>
                        <span class="number-rating"></span>
                    </div>
                </div>

                <?php if (isset($row->Sub_category_name)) : ?>
                    <h2 class="catergory"><?= $row->Sub_category_name ?></h2>
                <?php endif ?>
                <h2><?= $row->Name ?></h2>

                <?php if(!empty($row->Discount_percentage) && $row->Active === 1): ?>
                    <h3 class="cost line-through">Rs. <?= $row->Cost ?>.00</h3>
                    <h4>Rs. <?=round(($row->Cost*(100 - $row->Discount_percentage))/100) ?>.00</h4>
                <?php else: ?>
                    <h3 class="cost">Rs. <?= $row->Cost ?>.00</h3>
                <?php endif; ?>

            </div>
            <div class="product-card-buttons">
                <a class="product-btn-link" href="<?= ROOT ?>/login">
                    <img src="<?= ROOT ?>/assets/images/customer/shopping-cart.png" alt="Cart Image">
                </a>
                <a class="product-btn-link" href="<?= ROOT ?>/login">
                    <img src="<?= ROOT ?>/assets/images/customer/heart.svg" alt="Heart Image">
                </a>
            </div>
        </div>

    </div>
</a>

<script src="<?=ROOT?>/assets/javascript/product_card.js"></script>


