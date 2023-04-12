<?php $data['row'] = $row; $this->view('reg_customer/includes/header',$data); ?>

<div class="orders-container">
    <div class="orders">
        <h1>Order History</h1>

        <?php foreach ($orders as $order): ?>
            <div class="order-details selected-order" onclick="getOrderDetails('<?= $order->OrderID?>')">
                <div class="lhs-details">
                    <h4 class="lhs-details-item">#<?= substr($order->OrderID,0,8)?></h4>
                    <span class="lhs-details-item">Rs. <?=$order->Total_amount?>.00</span>
                    <span class="lhs-details-item"><?=$order->items?> Items</span>
                </div>
                <div class="rhs-details">
                    <span><?= $order->Date ?></span>
                    <div class="progress">
                        <img src="<?=ROOT?>/assets/images/customer/delivery-svgrepo-com.svg" alt="Vehicle">
                        <span class="progress"><?= $order->Order_status?></span>
                    </div>
                    <div class="delivery-status-container">
                        <div class="delivery-status"></div>
                        <div class="delivery-status"></div>
                        <div class="delivery-status"></div>
                        <div class="delivery-status"></div>
                        <div class="delivery-status"></div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>

    <div class="order">
        <h1>Order</h1>
        <div class="order-items-container">

            <div id="order-items">

            </div>
        </div>
    </div>
</div>

<script src="<?=ROOT?>/assets/javascript/orders.js"></script>
<?php $this->view('reg_customer/includes/footer'); ?>