<?php $this->view('designer/includes/header') ?>

<body class="designer">
<div class="designer-body">
    <?php $this->view('designer/includes/designer_header') ?>
    <div class="content dashboard">

        <div class="containers-designer-chart ">

            <div class="designer-tbox">
                <div class="recentOrders">
                    <div class="driver-tbox-header">
                        <h1>Recent Designs</h1>
                        <button onclick="location.href='<?=ROOT?>/designer/view_design_categories';">View All</button>
                    </div>
                    <table class="designer-content-table">
                        <thead>

                        <th class="th">Design Name</th>
                        <th class="th">Image</th>
                        <th class="th">Type Of Category</th>
                        <th class="th">Added Date</th>

                        </thead>
                        <tbody>
                        <?php if (empty($rows)):?>
                            <tr class="designs-table-rows">
                                <td colspan="4"><h1>No Designs to show.</h1></td>
                            </tr>
                        <?php else :?>
                        <?php foreach ($rows as $row):?>

                            <tr class="designs-table-rows">
                                <td><?=esc($row->Name)?></td>
                                <td><img src="<?=ROOT?>/<?=$row->Image?>" alt="Design Image"></td>
                                <?php
                                $categories = new Categories();
                                $categoryDetail = $categories->getCategoryByID($row->CategoryID);
                                ?>
                                <td><?=$categoryDetail[0]->Category_name?></td>
                                <?php
                                    $newDate = date("d/m/Y", strtotime($row->Date));
                                ?>
                                <td><?=$newDate?></td>
                            </tr>

                        <?php endforeach;?>
                        <?php endif;?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="designer-box" id="chart-designer-container" onclick="location.href='<?=ROOT?>/designer/design';">
                <canvas id="designerBar" width="300" height="400"></canvas>
            </div>


        </div>

    </div>
</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.1.0/chartjs-plugin-datalabels.min.js" integrity="sha512-Tfw6etYMUhL4RTki37niav99C6OHwMDB2iBT5S5piyHO+ltK2YX8Hjy9TXxhE1Gm/TmAV0uaykSpnHKFIAif/A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="<?=ROOT?>/assets/javascript/designer/barChart.js"></script>

</html>