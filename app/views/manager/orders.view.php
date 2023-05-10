<?php $this->view('manager/includes/header') ?>

<body class="manager">
<div class="manager-body ">
    <?php $this->view('manager/includes/manager_header') ?>
    <div class="content manager-content">

        <div class="comp-orders-container">
            <div class="comp-order-title-container">
                <h2>Company Orders</h2>
                <button onclick="openOrderDetailsPopup()">Order Details</button>
            </div>
            <div class="supplier-heading">
                <h3 id="supplier-name"><?=$suppliers[0]->SupplierID?> - <?=$suppliers[0]->Company_name?><span id="supplier-error" class="dis-err"></span></h3>
                <div class="supplier-field">
                    <label for="">Change Supplier</label>
                    <select name="Supplier" id="select-supplier">
                        <option value="<?=$suppliers[0]->SupplierID?> - <?=$suppliers[0]->Company_name?>" selected><?=$suppliers[0]->SupplierID?> - <?=$suppliers[0]->Company_name?></option>
                        <?php unset($suppliers[0]) ?>
                        <?php foreach($suppliers as $supplier): ?>
                            <option value="<?=$supplier->SupplierID?> - <?=$supplier->Company_name?>"><?=$supplier->SupplierID?> - <?=$supplier->Company_name?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="supplier-items">
                    <div class="supplier-items-heading">
                        <h4>Product List Supplied By The Supplier</h4>
                        <button onclick="getSelectedProducts()">Select</button>
                    </div>
                    <div class="tbody">
                        <table >
                            <thead>
                            <tr>
                                <th class="checkbox"></th>
                                <th>Product ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Reorder Level</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                            </tr>
                            </thead>
                            <tbody id="t-body">

                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="company-order-form">

                    <form action="" id="reorder-form">

                        <div class="selected-products">
                            <span id="product-error" class="dis-err"></span>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Product ID</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Reorder Quantity</th>
                                    </tr>
                                </thead>
                                <tbody id="company-order-tbody">
                                    <tr id="no-item">
                                        <td colspan="4" class="text-center">No Products Selected</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="order-form-field">
                            <label for="">Comments<span id="comment-error" class="dis-err"></span></label>
                            <textarea name="Comments" id="comments" cols="30" rows="7"></textarea>
                        </div>

                        <div class="order-form-btn">
                            <button type="submit" id="submit-order" onclick="placeOrder()">Place Order</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <div class="popup orders-info-popup" id="orders-info-popup">
            <div class="popup-heading">
                <h2>Company Order Details</h2>
                <img src="<?= ROOT ?>/assets/images/customer/close.png" alt="Close" onclick="closeOrderDetailsPopup()">
            </div>

            <div class="order-selections">
                <div class="selector" id="accepted" onclick="getAcceptedOrders()">Accepted Orders</div>
                <div class="selector" id="pending" onclick="getPendingOrders()">Pending Orders</div>
                <div class="selector" id="rejected" onclick="getRejectedOrders()">Rejected Orders</div>
                <div class="selector" id="completed" onclick="getCompletedOrders()">Completed Orders</div>
                <div class="selector" id="received" onclick="getReceivedOrders()">Received Orders</div>
            </div>

            <div id="details-table">

            </div>

        </div>

        <div class="popup orders-edit-popup" id="order-edit-popup" >
            <div class="popup-heading" style="margin-bottom: unset">
                <h2>Company Order - <span id="order-id"></span></h2>
                <img src="<?= ROOT ?>/assets/images/customer/close.png" alt="Close" onclick="closeEditCompanyOrderPopup()">
            </div>

            <div id="edit-form-container">

            </div>

        </div>

        <div class="popup orders-edit-popup" id="order-details-popup" >
            <div class="popup-heading" style="margin-bottom: unset">
                <h2>Company Order - <span id="order-id-details"></span></h2>
                <img src="<?= ROOT ?>/assets/images/customer/close.png" alt="Close" onclick="closeCompanyOrderDetailsPopup()">
            </div>

            <div id="order-info-container">

            </div>

        </div>

        <div class="cat-response" id="response">

        </div>

    </div>
    <script src="<?=ROOT?>/assets/javascript/company_order.js"></script>
</body>
</html>