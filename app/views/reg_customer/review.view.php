<?php $data['row'] = $row; $this->view('reg_customer/includes/header',$data); ?>

<div class="reviews-body-container">
    <div class="review-order-container">
        <h2>Order Items</h2>

        <?php foreach ($orderItems as $item): ?>
            <div class="order-details" onclick="getProductDetails('<?= $item->OrderID ?>','<?= $item->ProductID ?>')">
                <div class="lhs-details">
                    <h4 class="lhs-details-item"><?= $item->Name ?> - <?= $item->ProductID ?></h4>
                    <span class="lhs-details-item">Rs. <?= $item->Cost ?>.00</span>
                    <span class="lhs-details-item"><?= $item->Quantity ?> Items</span>
                </div>
                <div class="rhs-details item-image">
                    <img src="<?=ROOT?>/<?= $item->Image ?>" alt="">
                </div>
            </div>
        <?php endforeach; ?>

    </div>

    <div class="review-order-item-container" id="item-container">
        <?php if(isset($reviews[$orderItems[0]->ProductID])): ?>
            <h2><?= $orderItems[0]->Name ?> - <?= $orderItems[0]->ProductID ?></h2>
            <div class="review-fur-img">
                <img src="<?=ROOT?>/<?= $orderItems[0]->Image ?>" alt="">
                <div class="current-rating">
                    <h2>Current Ratings</h2>
                    <span><?= number_format($orderItems[0]->Rate,2) ?></span>
                    <div>
                        <div class="stars-outer">
                            <div class="stars-inner" style="width: <?= $orderItems[0]->Rating ?>"></div>
                        </div>
                        <span class="number-rating"></span>
                    </div>
                </div>
                <div class="your-rating">
                    <h2>Rate Product</h2>

                    <div class="star-widget">
                        <input type="radio" name="rate" id="rate-5" value="5" <?php if($reviews[$orderItems[0]->ProductID]->Rating == 5) echo "checked" ?>>
                        <label for="rate-5" class="fas fa-star" onclick="setRate(5)" ></label>
                        <input type="radio" name="rate" id="rate-4" value="4" <?php if($reviews[$orderItems[0]->ProductID]->Rating == 4) echo "checked" ?>>
                        <label for="rate-4" class="fas fa-star" onclick="setRate(4)"></label>
                        <input type="radio" name="rate" id="rate-3" value="3" <?php if($reviews[$orderItems[0]->ProductID]->Rating == 3) echo "checked" ?>>
                        <label for="rate-3" class="fas fa-star" onclick="setRate(3)"></label>
                        <input type="radio" name="rate" id="rate-2" value="2" <?php if($reviews[$orderItems[0]->ProductID]->Rating == 2) echo "checked" ?>>
                        <label for="rate-2" class="fas fa-star" onclick="setRate(2)"></label>
                        <input type="radio" name="rate" id="rate-1" value="1" <?php if($reviews[$orderItems[0]->ProductID]->Rating == 1) echo "checked" ?>>
                        <label for="rate-1" class="fas fa-star" onclick="setRate(1)"></label>
                    </div>
                    <span class="error" id="error-rate"></span>
                </div>
            </div>
            <div class="write-review">
                <div class="header-error">
                    <h2>Write a review</h2>
                    <span class="error" id="error-review"></span>
                </div>

                <textarea id="review" cols="30" rows="10" maxlength="1024" placeholder="Describe Your Experience..."
                ><?=$reviews[$orderItems[0]->ProductID]->Reviews?></textarea>
            </div>
            <div class="review-btn-container">
                <button class="review-btn" onclick="saveReview('<?= $orderItems[0]->ProductID ?>')">Post Review</button>
            </div>
        <?php else: ?>
            <h2><?= $orderItems[0]->Name ?> - <?= $orderItems[0]->ProductID ?></h2>
            <div class="review-fur-img">
                <img src="<?=ROOT?>/<?= $orderItems[0]->Image ?>" alt="">
                <div class="current-rating">
                    <h2>Current Ratings</h2>
                    <span><?= number_format($orderItems[0]->Rate,2) ?></span>
                    <div>
                        <div class="stars-outer">
                            <div class="stars-inner" style="width :<?= $orderItems[0]->Rating ?>"></div>
                        </div>
                        <span class="number-rating"></span>
                    </div>
                </div>
                <div class="your-rating">
                    <h2>Rate Product</h2>

                    <div class="star-widget">
                        <input type="radio" name="rate" id="rate-5">
                        <label for="rate-5" class="fas fa-star" onclick="setRate(5)" ></label>
                        <input type="radio" name="rate" id="rate-4">
                        <label for="rate-4" class="fas fa-star" onclick="setRate(4)"></label>
                        <input type="radio" name="rate" id="rate-3">
                        <label for="rate-3" class="fas fa-star" onclick="setRate(3)"></label>
                        <input type="radio" name="rate" id="rate-2">
                        <label for="rate-2" class="fas fa-star" onclick="setRate(2)"></label>
                        <input type="radio" name="rate" id="rate-1">
                        <label for="rate-1" class="fas fa-star" onclick="setRate(1)"></label>
                    </div>
                    <span class="error" id="error-rate"></span>
                </div>
            </div>
            <div class="write-review">
                <div class="header-error">
                    <h2>Write a review</h2>
                    <span class="error" id="error-review"></span>
                </div>

                <textarea id="review" cols="30" rows="10" maxlength="1024" placeholder="Describe Your Experience..."
                ></textarea>
            </div>
            <div class="review-btn-container">
                <button class="review-btn" onclick="saveReview('<?= $orderItems[0]->ProductID ?>')">Post Review</button>
            </div>
        <?php endif; ?>

    </div>
</div>

<div class="cat-response" id="response">

</div>

<script src="<?=ROOT?>/assets/javascript/review.js"></script>
<?php $this->view('reg_customer/includes/footer'); ?>
