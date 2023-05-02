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
                    <canvas id="myChart4"></canvas>
                </div>
            </div>

            <div class="dashboard-cols">
                <div class="chart-container">
                    <canvas id="myChart5"></canvas>
                </div>
                <div class="chart-container">
                    <canvas id="myChart6"></canvas>
                </div>
            </div>

        </div>
        
    </div>
    
</body>
<script src="<?=ROOT?>/assets/javascript/manager_dashboard.js"></script>
</html>