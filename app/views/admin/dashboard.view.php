<?php $this->view('admin/includes/header') ?>

<body class="admin">
    <div class="admin-body">
        <?php $this->view('admin/includes/admin.header') ?>
        <div class="content">
            
            <div class="dashboard-container">
                <div>
                    <div class="chart-container">
                        <canvas id="myChart1" ></canvas>
                    </div>

                    <script src="<?=ROOT?>/assets/javascript/chart.umd.js"></script>

                    <script>
                        const ctx1 = document.getElementById('myChart1');

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
                    </script>
                    <div class="emp-cus-count">
                        <div class="count">
                            <div>
                                <h2># Employees</h2>
                                <img src="<?=ROOT?>/assets/images/admin/employee.png" alt="Image">
                            </div>
                            <h1><?=$emp_cnt[0]->count?></h1>
                        </div>
                        <div class="count">
                            <div>
                                <h2># Suppliers</h2>
                                <img src="<?=ROOT?>/assets/images/admin/supplier.png" alt="Image">
                            </div>
                            <h1><?=$sup_cnt[0]->count?></h1>
                        </div>
                    </div>
                    <div class="emp-cus-count">
                        <div class="count">
                            <div>
                                <h2># Furniture</h2>
                                <img src="<?=ROOT?>/assets/images/admin/furnitures.png" alt="Image">
                            </div>
                            <h1><?=$fur_cnt[0]->count?></h1>
                        </div>
                        <div class="count">
                            <div>
                                <h2># Out of Stock Furniture</h2>
                                <img src="<?=ROOT?>/assets/images/admin/out-of-stock.png" alt="Image">
                            </div>
                            <h1><?=$ots_fur_cnt[0]->count?></h1>
                        </div>
                    </div>
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

                            <?php if(!empty($furniture)): ?>
                                <?php foreach ($furniture as $row): ?>

                                    <tr>
                                        <td><?=$row->ProductID?></td>
                                        <td><img src="<?=ROOT?>/<?=$row->Image?>" alt="Product Image"></td>
                                        <td><?=$row->Name?></td>
                                    </tr>

                                <?php endforeach;?>
                            <?php else: ?>
                                <h1>No products to show.</h1>
                            <?php endif; ?>

                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>
</html>