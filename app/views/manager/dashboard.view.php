<?php $this->view('manager/includes/header') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<body class="manager">
    <div class="manager-body ">
        <?php $this->view('manager/includes/manager_header') ?>
        <div class="content manager-content">

            <div class="dashboard-cols">
                <div class="chart-container">
                    <canvas id="myChart1"></canvas>
                </div>
                <div class="chart-container">
                    <canvas id="myChart2"></canvas>
                </div>
            </div>

            <div class="dashboard-cols">
                <div class="chart-container">
                    <canvas id="myChart3"></canvas>
                </div>
                <div class="chart-container">
                <canvas id="myChart6"></canvas>
                </div>
            </div>

            <div class="dashboard-cols">
                    <div class="chart-container discounts-list">
                        <h3>Active Discounts</h3>
                        <table>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Percentage</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                </tr>
                            </thead>
                            <tbody id="active-discounts">

                            </tbody>
                        </table>
                    </div>
                    <div class="chart-container shortcuts">
                        <div class="shortcut-cols">
                            <div class="shortcut" onclick="loadDesignsPage()">
                                <h2>No. of Pending Designs</h2>
                                <span id="designs"></span>
                            </div>
                            <div class="shortcut" onclick="loadIssuesPage()">
                                <h2>No. of Pending Issues</h2>
                                <span id="issues"></span>
                            </div>
                        </div>
                        <div class="ads-list discounts-list">
                            <h3>Sold Out Refurnished Furniture</h3>
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                    </tr>
                                </thead>
                                <tbody id="sold-out">

                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>

        </div>
        
    </div>
    
</body>
<script src="<?=ROOT?>/assets/javascript/manager_dashboard.js"></script>
</html>