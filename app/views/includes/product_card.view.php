<div class="product-card">
    <?php if (!empty($row->Discount_percentage)) : ?>
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
                5.0 &nbsp;
                <img src="<?= ROOT ?>/assets/images/customer/star.png" alt="Star">
                <img src="<?= ROOT ?>/assets/images/customer/star.png" alt="Star">
                <img src="<?= ROOT ?>/assets/images/customer/star.png" alt="Star">
                <img src="<?= ROOT ?>/assets/images/customer/star.png" alt="Star">
                <img src="<?= ROOT ?>/assets/images/customer/star.png" alt="Star">

            </div>
            <?php if (isset($row->Sub_category_name)) : ?>
                <h2 class="catergory"><?= $row->Sub_category_name ?></h2>
            <?php endif ?>

            <h2><?= $row->Name ?></h2>

            <h3 class="cost">Rs. <?= $row->Cost ?>.00</h3>
            <div>

            </div>

        </div>
        <div class="product-card-buttons">

            <a href="<?= ROOT ?>/login">
                <img src="<?= ROOT ?>/assets/images/customer/shopping-cart.png" alt="Cart Image">
            </a>
            <a href="<?= ROOT ?>/login">
                <img src="<?= ROOT ?>/assets/images/customer/heart.svg" alt="Heart Image">
            </a>
        </div>
    </div>

</div>