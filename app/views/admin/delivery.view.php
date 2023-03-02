<?php $this->view('admin/includes/header') ?>

<body class="admin">
<div class="admin-body">
    <?php $this->view('admin/includes/admin.header') ?>
    <div class="dashboard content">

        <div class="delivery-orders-container">
            <h1>New Orders</h1>
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
                            <td>Rs <?= $order->Total_amount ?>.00</td>
                            <td><button onclick = "openPopupDelivery('<?=$order->OrderID?>')">Details</button></td>
                        </tr>
                    <?php endforeach;?>
                <?php else: ?>
                   <tr><td>No newly added orders.</td></tr>
                <?php endif; ?>

                <div class="popup delivery-popup" id="popup">
                    <div class="popup-heading">
                        <h2>Order Details</h2>
                        <img src="<?=ROOT?>/assets/images/customer/close.png" alt="Close" onclick="closePopup()">
                    </div>

                    <div id="order-items">

                    </div>


                </div>

            </table>
        </div>

    </div>

</div>
</body>
<script src="<?=ROOT?>/assets/javascript/delivery.js"></script>
</html>