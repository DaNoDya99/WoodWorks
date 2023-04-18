<?php $data['row'] = $row; $this->view('reg_customer/includes/header',$data); ?>

<div class="orders-container">
    <div class="orders">
        <h1>Order History</h1>

        <?php if(!empty($orders)): ?>

            <div id="first" class="order-details selected-order" onclick="getOrderDetails('<?= $orders[0]->OrderID?>')">
                <div class="lhs-details">
                    <h4 class="lhs-details-item">#<?= substr($orders[0]->OrderID,0,8)?></h4>
                    <span class="lhs-details-item">Rs. <?=$orders[0]->Total_amount?>.00</span>
                    <span class="lhs-details-item"><?=$orders[0]->items?> Items</span>
                </div>
                <div class="rhs-details">
                    <span><?= $orders[0]->Date ?></span>
                    <div class="progress">
                        <img src="<?=ROOT?>/assets/images/customer/delivery-svgrepo-com.svg" alt="Vehicle">
                        <span class="progress"><?= $orders[0]->Order_status?></span>
                    </div>
                    <div class="delivery-status-container">
                        <?php if($orders[0]->Order_status == 'paid'): ?>
                        <div class="delivery-status"></div>
                        <?php elseif($orders[0]->Order_status == 'Processing'): ?>
                        <div class="delivery-status"></div>
                        <div class="delivery-status"></div>
                        <?php elseif($orders[0]->Order_status == 'Dispatched'): ?>
                        <div class="delivery-status"></div>
                        <div class="delivery-status"></div>
                        <div class="delivery-status"></div>
                        <?php elseif($orders[0]->Order_status == 'Delivered'): ?>
                        <div class="delivery-status"></div>
                        <div class="delivery-status"></div>
                        <div class="delivery-status"></div>
                        <div class="delivery-status"></div>
                        <div class="delivery-status"></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <?php unset($orders[0]); ?>

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
                            <?php if($order->Order_status == 'paid'): ?>
                                <div class="delivery-status"></div>
                            <?php elseif($order->Order_status == 'Processing'): ?>
                                <div class="delivery-status"></div>
                                <div class="delivery-status"></div>
                            <?php elseif($order->Order_status == 'Dispatched'): ?>
                                <div class="delivery-status"></div>
                                <div class="delivery-status"></div>
                                <div class="delivery-status"></div>
                            <?php elseif($order->Order_status == 'Delivered'): ?>
                                <div class="delivery-status"></div>
                                <div class="delivery-status"></div>
                                <div class="delivery-status"></div>
                                <div class="delivery-status"></div>
                                <div class="delivery-status"></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <h2>No Orders Yet.</h2>
        <?php endif; ?>

    </div>

    <div class="order">
        <h1>Order</h1>
        <div class="order-items-container">

            <div id="order-items">
                <h2>Please Select An Order.</h2>
            </div>
        </div>
    </div>
</div>

<script src="<?=ROOT?>/assets/javascript/orders.js"></script>
<?php $this->view('reg_customer/includes/footer'); ?>