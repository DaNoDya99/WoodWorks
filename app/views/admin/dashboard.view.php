<?php $this->view('admin/includes/header') ?>
<script src="<?=ROOT?>/assets/javascript/chart.umd.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<body class="admin">
    <div class="admin-body">
        <?php $this->view('admin/includes/admin.header') ?>
        <div class="content">
            
            <div class="dashboard-container">
                <div>
                    <div class="chart-container">
                        <canvas id="myChart1" ></canvas>
                    </div>

                    <div class="chart-container">
                        <canvas id="myChart2" style="z-index: 1;"></canvas>
                    </div>
                </div>
                <div class="dashboard-rhs">
                    <div class="rhs-container">
                        <div>
                            <div class="ofs-list">
                                <h1>Out Of Stock Furniture</h1>
                                <div class="ofs-table-container">
                                    <table class="list-table">
                                        <tr>
                                            <th>SKU</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                        </tr>

                                        <?php if(!empty($furniture)): ?>
                                            <?php foreach ($furniture as $row): ?>

                                                <tr>
                                                    <td><?=$row->ProductID?></td>
                                                    <td><img src="<?=ROOT?>/<?=$row->Image?>" alt="Product Image"></td>
                                                    <td><?=$row->Name?></td>
                                                </tr>

                                            <?php endforeach;?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="3">No Out of Stock Furniture</td>
                                            </tr>
                                        <?php endif; ?>

                                    </table>
                                </div>
                            </div>

                            <div class="pie-chart-container">
                                <span id="pie-title"></span>
                                <canvas id="myChart3" ></canvas>
                            </div>
                        </div>
                        <div>
                            <div class="delivery-rates-container">
                                <div class="rates-title">
                                    <span>Delivery Rates (per km)</span>
                                    <button id="add-delivery-rate-btn" onclick="addRatesPopup()">Add Delivery Rate</button>
                                </div>
                                <table class="delivery-rates-table" id="delivery-rates">


                                </table>
                            </div>
                            <div class="pie-chart-container pie-width">
                                <canvas id="myChart4" ></canvas>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>

        <div class="popup delivery-rate-popup" id="add-popup">
            <div class="popup-heading">
                <h2>Add Delivery Rate</span></h2>
                <img src="<?= ROOT ?>/assets/images/customer/close.png" alt="Close" onclick="closeAddRatesPopup()">
            </div>

            <form action="" id="add-form">
                <div class="name-field">
                    <div class="field dis-field">
                        <label>Distance From (km)</label>
                        <p class="error font-vsm" id="distance-from-error"></p>
                        <input class="" type="text" name="Distance_from" id="distance-from" placeholder="Enter Distance">
                    </div>
                    <div class="field dis-field">
                        <label>Distance To (km)</label>
                        <p class="error font-vsm" id="distance-to-error"></p>
                        <input type="text" name="Distance_to" id="distance-to" placeholder="Enter Distance">
                    </div>
                </div>
                <div class="field dis-outer-field">
                    <label>Cost per km (Rs)</label>
                    <p class="error font-vsm" id="cost-per-km-error"></p>
                    <input type="text" name="Cost_per_km" id="cost-per-km" placeholder="Enter Cost">
                </div>
                <div class="add-delivery-btn">
                    <button type="button" onclick="addDeliveryRate()">Add</button>
                </div>
            </form>
        </div>

        <div class="popup delivery-rate-popup" id="edit-popup">
            <div class="popup-heading">
                <h2>Edit Delivery Rate</span></h2>
                <img src="<?= ROOT ?>/assets/images/customer/close.png" alt="Close" onclick="closeEditRatesPopup()">
            </div>

            <form action="" id="edit-form">
                <div class="name-field">
                    <div class="field dis-field">
                        <label>Distance From (km)</label>
                        <p class="error font-vsm" id="distance-from-error"></p>
                        <input class="" type="text" name="Distance_from" id="distance-from-edit">
                    </div>
                    <div class="field dis-field">
                        <label>Distance To (km)</label>
                        <p class="error font-vsm" id="distance-to-error"></p>
                        <input type="text" name="Distance_to" id="distance-to-edit">
                    </div>
                </div>
                <div class="field dis-outer-field">
                    <label>Cost per km (Rs)</label>
                    <p class="error font-vsm" id="cost-per-km-error"></p>
                    <input type="text" name="Cost_per_km" id="cost-per-km-edit" >
                </div>
                <div class="add-delivery-btn">
                    <button type="button" onclick="saveDeliveryRate()">Save</button>
                </div>
            </form>

        </div>

    </div>

    <div class="cat-response" id="response">

    </div>
</body>
<script src="<?=ROOT?>/assets/javascript/admin_dashboard.js"></script>
</html>