<?php $this->view('admin/includes/header') ?>

<body class="admin">
    <div class="admin-body">
        <?php $this->view('admin/includes/admin_sidebar') ?>
        <div class="dashboard">
            <div class="dashboard-nav">
                <div class="nav-item-page-name">
                    <h1><?= $title ?></h1>
                </div>
                <div class="nav-item-user">
                    <img src="<?=ROOT?>/<?=$row[0]->Image?>" alt="Profile picture">
                    <div class="nav-vr"></div>
                    <h1>Hi, <?=Auth::getFirstname()?></h1>
                    <div class="nav-vr"></div>
                    <a href="<?=ROOT?>/logout1">
                        <h1>Logout</h1>
                    </a>
                </div>
            </div>
            <div class="dashboard-container">
                <div>
                    <div class="chart-container">
                        <canvas id="myChart1" ></canvas>
                    </div>

                    <div class="chart-container">
                        <canvas id="myChart2" ></canvas>
                    </div>

                    <script src="<?=ROOT?>/assets/javascript/chart.umd.js"></script>

                    <script>
                        const ctx1 = document.getElementById('myChart1');
                        const ctx2 = document.getElementById('myChart2');

                        const labels = ['P0002', 'P0010','P0008','P0003','P0004','P0001','P0005'];
                        const data = {
                            labels: labels,
                            datasets: [{
                                label: 'Products With Low Quantity.',

                                data: [5, 4, 3, 4, 2, 1, 5],

                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.3)',
                                    'rgba(255, 159, 64, 0.3)',
                                    'rgba(255, 205, 86, 0.3)',
                                    'rgba(75, 192, 192, 0.3)',
                                    'rgba(54, 162, 235, 0.3)',
                                    'rgba(153, 102, 255, 0.3)',
                                    'rgba(201, 203, 207, 0.3)',
                                    'rgba(201, 203, 207, 0.3)'
                                ],

                                borderColor: [
                                    'rgb(255, 99, 132)',
                                    'rgb(255, 159, 64)',
                                    'rgb(255, 205, 86)',
                                    'rgb(75, 192, 192)',
                                    'rgb(54, 162, 235)',
                                    'rgb(153, 102, 255)',
                                    'rgb(201, 203, 207)',
                                    'rgb(201, 203, 207)'
                                ],

                                borderWidth: 1

                            }]
                        };

                        const config = {
                            type: 'bar',
                            data: data,
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            },
                        };

                        new Chart(ctx1, config);
                        new Chart(ctx2,config);
                    </script>
                </div>
                <div class="ofs-list">
                    <h1>Out Of Stock Furniture</h1>
                    <div class="ofs-table-container">
                        <table class="list-table">
                            <tr>
                                <th>SKU</th>
                                <th>Image</th>
                                <th>Name</th>
                            </tr>
                            <tr>
                                <td>P0001</td>
                                <td><img src="<?=ROOT?>/assets/images/customer/chair.jpg" alt="Product Image"></td>
                                <td>Carta Side Table</td>
                            </tr>
                            <tr>
                                <td>P0001</td>
                                <td><img src="<?=ROOT?>/assets/images/customer/chair.jpg" alt="Product Image"></td>
                                <td>Carta Side Table</td>
                            </tr>
                            <tr>
                                <td>P0001</td>
                                <td><img src="<?=ROOT?>/assets/images/customer/chair.jpg" alt="Product Image"></td>
                                <td>Carta Side Table</td>
                            </tr>
                            <tr>
                                <td>P0001</td>
                                <td><img src="<?=ROOT?>/assets/images/customer/chair.jpg" alt="Product Image"></td>
                                <td>Carta Side Table</td>
                            </tr>
                            <tr>
                                <td>P0001</td>
                                <td><img src="<?=ROOT?>/assets/images/customer/chair.jpg" alt="Product Image"></td>
                                <td>Carta Side Table</td>
                            </tr>
                            <tr>
                                <td>P0001</td>
                                <td><img src="<?=ROOT?>/assets/images/customer/chair.jpg" alt="Product Image"></td>
                                <td>Carta Side Table</td>
                            </tr>
                            <tr>
                                <td>P0001</td>
                                <td><img src="<?=ROOT?>/assets/images/customer/chair.jpg" alt="Product Image"></td>
                                <td>Carta Side Table</td>
                            </tr>
                            <tr>
                                <td>P0001</td>
                                <td><img src="<?=ROOT?>/assets/images/customer/chair.jpg" alt="Product Image"></td>
                                <td>Carta Side Table</td>
                            </tr>
                            <tr>
                                <td>P0001</td>
                                <td><img src="<?=ROOT?>/assets/images/customer/chair.jpg" alt="Product Image"></td>
                                <td>Carta Side Table</td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>
</html>