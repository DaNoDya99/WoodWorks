<?php $this->view('admin/includes/header') ?>

<body class="admin">
<div class="admin-body">
    <?php $this->view('admin/includes/admin.header') ?>
    <div class="dashboard content">

        <div class="delivery-orders-container">
            <div class="cat-heading">
                <h1>New Orders</h1>
                <button class="delivery-history-btn" onclick="openDeliveryHistoryPopup()">
                    Delivery Order History
                </button>
            </div>

            <table class="delivery-orders-table">
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Contact No</th>
                    <th>Order Date</th>
                    <th>Order Total</th>
                    <th></th>
                </tr>

                <?php if(!empty($orders)): ?>
                    <?php foreach($orders as $order): ?>
                        <tr>
                            <td class="order-id"><?= $order->OrderID ?></td>
                            <td><?= $order->Firstname ?> <?= $order->Lastname ?></td>
                            <td><?= $order->Email ?></td>
                            <td><?= $order->Address ?></td>
                            <td><?= $order->Contactno ?></td>
                            <td><?= $order->Date ?></td>
                            <td>Rs. <?= $order->Total_amount ?>.00</td>
                            <td>
                                <div class='inv-table-btns'>
                                    <button style="background-color: #2e69c4;" onclick="openPopupDelivery('<?= $order->OrderID ?>')"><img src='http://localhost/WoodWorks/public/assets/images/manager/info-svgrepo-com.svg' alt=''></button>
                                </div>
                            </td>
                        </tr>-
                    <?php endforeach;?>
                <?php else: ?>
                   <tr><td>No newly added orders.</td></tr>
                <?php endif; ?>

            </table>

                <div class="popup delivery-popup" id="popup">
                    <div class="popup-heading">
                        <h2>Order Details</h2>
                        <select class="select-driver" name="Driver" id="driver">

                        </select>
                        <img src="<?=ROOT?>/assets/images/customer/close.png" alt="Close" onclick="closePopup()">
                    </div>

                    <div id="order-items">

                    </div>
                </div>

                <div class="popup delivery-history-popup" id="delivery-history-popup">
                    <div class="popup-heading">
                        <h2>Delivery Order Details</h2>
                        <img src="<?=ROOT?>/assets/images/customer/close.png" alt="Close" onclick="closeDeliveryHistoryPopup()">
                    </div>

                    <div class="order-selections">
                        <div class="selector order-select" status="status" id="processing" onclick="getOrders('Processing')">Processing Orders</div>
                        <div class="selector order-select" status="status" id="dispatched" onclick="getOrders('Dispatched')">Dispatched Orders</div>
                        <div class="selector order-select" status="status" id="delivered" onclick="getDeliveredOrders('Delivered')">Delivered Orders</div>
                    </div>

                    <div  id="delivery-orders-table">

                    </div>

                </div>

                <div class="popup delivery-popup" id="order-details-popup">
                    <div class="popup-heading">
                        <h2 id="order-id"></h2>
                        <img src="<?=ROOT?>/assets/images/customer/close.png" alt="Close" onclick="closeOrderDetailsPopup()">
                    </div>

                    <div id="order-items-details">

                    </div>
                </div>
        </div>
    </div>
    <div class="cat-response" id="response">

    </div>

</div>
</body>
<script src="<?=ROOT?>/assets/javascript/delivery.js"></script>
</html>