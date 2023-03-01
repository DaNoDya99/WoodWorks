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
                            <td><button onclick = "openPopup()">Details</button></td>
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

                    <div class="delivery-order-items">
                        <div class="order-item deliver-order-item">
                            <img src="<?=ROOT?>/assets/images/customer/chair.jpg" alt="">

                            <div class="ordered-product-details">
                                <div class="ordered-product-details-lhs">
                                    <div class="row1">
                                        <h4>Study Table</h4>
                                        <span>P0001</span>
                                    </div>

                                    <div class="row2"><span>Teak</span></div>
                                    <div class="row3"><span>1 item</span></div>
                                </div>

                                <div class="price">
                                    <span>Rs.45000.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="order-item deliver-order-item">
                            <img src="<?=ROOT?>/assets/images/customer/chair.jpg" alt="">

                            <div class="ordered-product-details">
                                <div class="ordered-product-details-lhs">
                                    <div class="row1">
                                        <h4>Study Table</h4>
                                        <span>P0001</span>
                                    </div>

                                    <div class="row2"><span>Teak</span></div>
                                    <div class="row3"><span>1 item</span></div>
                                </div>

                                <div class="price">
                                    <span>Rs.45000.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="order-item deliver-order-item">
                            <img src="<?=ROOT?>/assets/images/customer/chair.jpg" alt="">

                            <div class="ordered-product-details">
                                <div class="ordered-product-details-lhs">
                                    <div class="row1">
                                        <h4>Study Table</h4>
                                        <span>P0001</span>
                                    </div>

                                    <div class="row2"><span>Teak</span></div>
                                    <div class="row3"><span>1 item</span></div>
                                </div>

                                <div class="price">
                                    <span>Rs.45000.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="order-item deliver-order-item">
                            <img src="<?=ROOT?>/assets/images/customer/chair.jpg" alt="">

                            <div class="ordered-product-details">
                                <div class="ordered-product-details-lhs">
                                    <div class="row1">
                                        <h4>Study Table</h4>
                                        <span>P0001</span>
                                    </div>

                                    <div class="row2"><span>Teak</span></div>
                                    <div class="row3"><span>1 item</span></div>
                                </div>

                                <div class="price">
                                    <span>Rs.45000.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="order-item deliver-order-item">
                            <img src="<?=ROOT?>/assets/images/customer/chair.jpg" alt="">

                            <div class="ordered-product-details">
                                <div class="ordered-product-details-lhs">
                                    <div class="row1">
                                        <h4>Study Table</h4>
                                        <span>P0001</span>
                                    </div>

                                    <div class="row2"><span>Teak</span></div>
                                    <div class="row3"><span>1 item</span></div>
                                </div>

                                <div class="price">
                                    <span>Rs.45000.00</span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="order-payment-details deliver-order-details" >
                        <h2>Order Details</h2>
                        <div class="order-detail">
                            <h4>Phone Number</h4>
                            <span>0766023645</span>
                        </div>
                        <div class="order-detail">
                            <h4>Delivery Address</h4>
                            <span>108/5 A, Weragama Road, Wadduwa</span>
                        </div>
                        <div class="order-detail order-final-detail">
                            <h4>Invoice Number</h4>
                            <span>12345</span>
                        </div>
                        <div class="order-detail order-total">
                            <h4>Total Amount</h4>
                            <span>Rs. 110500.00</span>
                        </div>
                    </div>
                </div>

            </table>
        </div>

    </div>

</div>
</body>
<script src="<?=ROOT?>/assets/javascript/admin-profile.js"></script>
</html>