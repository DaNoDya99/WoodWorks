<?php $this->view('manager/includes/header') ?>

<body class="manager">
<?php $this->view('manager/includes/manager_header') ?>
<div class="content manager-body ">
    <div class="select-reports">
        <ul>
            <li id="overview-link" class="select-link active-section" onclick="changeSection('overview')">Overview</li>
            <li id="products-link" class="select-link" onclick="changeSection('products')">Products</li>
            <li id="inventory-link" class="select-link" onclick="changeSection('inventory')">Inventory</li>
            <li id="orders-link" class="select-link" onclick="changeSection('orders')">Orders</li>
            <li id="catergories-link" class="select-link" onclick="changeSection('catergories')">Catergories</li>
            <li id="coupons-link" class="select-link" onclick="changeSection('coupons')">Coupons</li>

        </ul>
    </div>
    <div class="reports">
        <div class="dashboard">

            <label for="">Date Range:</label><br><br>
            <div id="date-range" class="dropdown date-range dashboard" onclick="toggleDropdown()">
                <p id="date-range-label">Select</p><img id="dropdown-icon"
                                                        src="<?= ROOT ?>/assets/images/manager/chevron-down-solid.svg"
                                                        alt="">

                <div id="date-overlay" class="dropdown-content date-overlay ">
                    <p>Select Range </p>
                    <a class="closebtn" onclick="toggleDropdown()"><img style="height:20px"
                                                                        src="<?= ROOT ?>/assets/images/manager/xmark-solid.svg"
                                                                        alt=""></a>
                    <form id="form" action="">
                        <label for="date1">From</label>
                        <input name="date1" type="date" value="<?php echo date('Y-m-01'); ?>">
                        <label for="date2">To</label>
                        <input name="date2" type="date" value="<?php echo date('Y-m-d'); ?>">
                        <br><br>
                        <div class="submit-reset-buttons">
                            <input type="submit" value="Submit">
                            <input type="reset" value="Reset">
                        </div>

                    </form>

                </div>
            </div>
            <div class="variable-section">
                <div class="overview-section">
                    <div>
                        <div class="widget-header">
                            <h2>Performance</h2>
                        </div>
                        <div class="widget-holder">
                            <div class="performance-widget">
                                <div class="widget-title-area">
                                    <h3>Total Sales</h3>
                                    <img src="<?= ROOT ?>/assets/images/manager/info.svg" alt=""
                                         onmouseover="tooltip(1)" onmouseleave="tooltipoff(1)">
                                    <div class="tooltip tooltip1 hidden-section">Revenue from Sales</div>
                                </div>
                                <h2 id="total-sales-value"><i style="color:grey">Select Range</i></h2>
                            </div>
                            <div class="performance-widget">
                                <div class="widget-title-area">
                                    <h3>Orders</h3>
                                    <img src="<?= ROOT ?>/assets/images/manager/info.svg" alt=""
                                         onmouseover="tooltip(2)" onmouseleave="tooltipoff(2)">
                                    <div class="tooltip tooltip2 hidden-section">Revenue from Sales</div>

                                </div>
                                <h2 id="total-order-count"><i style="color:grey">Select Range</i></h2>
                            </div>
                            <div class="performance-widget">
                                <div class="widget-title-area">
                                    <h3>Products Sold</h3>
                                    <img src="<?= ROOT ?>/assets/images/manager/info.svg" alt=""
                                         onmouseover="tooltip(3)" onmouseleave="tooltipoff(3)">
                                    <div class="tooltip tooltip3 hidden-section">Revenue from Sales</div>

                                </div>
                                <h2 id="total-products-sold"><i style="color:grey">Select Range</i></h2>
                            </div>
                        </div>
                    </div>
                    <h2>Charts</h2>
                    <div class="charts">
                        <div class="chart-container">
                            <div class="chart-component">
                                <canvas id="mainSalesChart"></canvas>
                            </div>
                            <div class="chart-component">
                                <canvas id="ordercount"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Section -->
                <div class="products-section hidden-section">


                    <div class="charts">
                        <div class="chart-container">
                            <div class="chart-component">
                                <canvas id="SalesChart2"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="list product-list">
                        <div class="product-list-header">
                            <h3>Products</h3>
                            <select id="paymentStatus">
                                <option value="paid">Paid</option>
                                <option value="unpaid">Unpaid</option>
                            </select>

                            <div>
                                <!-- <input type="text" id="searchInput" placeholder="Search by Name" onkeyup="searchProducts()"style="height:40px; width:300px; padding:10px; border-radius:5px; border:1px solid grey; margin-right:10px;"> -->
                                <a id="exporttocsv" onclick="exportCSV('product_sold')">Export to CSV</a>
                            </div>

                        </div>

                        <table id="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Product ID</th>
                                <th>Items Sold</th>
                                <th>Net Sales</th>
                                <th>Orders</th>
                                <th>Catergories</th>
                                <th>Stock</th>
                            </tr>
                            </thead>
                            <tbody id="tableBody">
                            <!-- Table rows will be populated dynamically using JavaScript -->
                            </tbody>
                        </table>
                        <div class="pagination" id="pagination">
                            <!-- Pagination buttons will be populated dynamically using JavaScript -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="inventory-section hidden-section">
                <div class="list product-list">
                    <div class="inventory-list-header">
                        <h3>Inventory</h3>
                        <select id="">
                            <option value="paid">Paid</option>
                            <option value="unpaid">Unpaid</option>
                        </select>

                        <div>
                            <a id="exporttocsv" onclick="exportCSV('product_sold')">Export to CSV</a>
                        </div>

                    </div>

                    <table id="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Product ID</th>
                            <th>Quantity In Stock</th>
                            <th>Reorder Point</th>
                            <th>Last Ordered</th>
                            <th>Last Recieved</th>

                        </tr>
                        </thead>
                        <tbody id="tableBody">
                        <!-- Table rows will be populated dynamically using JavaScript -->
                        </tbody>
                    </table>
                    <div class="pagination" id="pagination">
                        <!-- Pagination buttons will be populated dynamically using JavaScript -->
                    </div>
                </div>
            </div>
            <div class="orders-section hidden-section">

            </div>

            <div class="catergories-section hidden-section">

            </div>
            <div class="coupons-section hidden-section">
            </div>
        </div>


    </div>

</div>
<script src="<?= ROOT ?>/assets/javascript/manager/reports.js"></script>
</body>

</html>