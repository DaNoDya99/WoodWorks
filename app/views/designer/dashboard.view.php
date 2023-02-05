<?php $this->view('designer/includes/header') ?>

<body class="designer">
<?php $this->view('designer/includes/designer_header') ?>
<div class="content designer-body">
    <div class="dashboard">


        <div class="containers-designer-chart " >

            <div class="designer-box" id="chart-designer-container" onclick="location.href='<?=ROOT?>/designer/design';">
                <canvas id="designerBar" width="300" height="400"></canvas>
            </div>

            <div class="designer-tbox" onclick="location.href='<?=ROOT?>/designer/design';">
                <h1>Newly Added Designs</h1>

                <table class="designer-content-table">
                    <thead>

                    <th class="th">Name</th>
                    <th class="th">Image</th>
                    <th class="th">Date</th>

                    </thead>
                    <tbody>
                    <?php foreach ($rows as $row):?>

                        <tr class="designs-table-rows">
                            <td><?=esc($row->Name)?></td>
                            <td><img src="<?=ROOT?>/<?=$row->Image?>" alt="Design Image"></td>
                            <td><?=$row->Date?></td>
                        </tr>

                    <?php endforeach;?>
                    </tbody>
                </table>

            </div>


        </div>

    </div>
</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.1.0/chartjs-plugin-datalabels.min.js" integrity="sha512-Tfw6etYMUhL4RTki37niav99C6OHwMDB2iBT5S5piyHO+ltK2YX8Hjy9TXxhE1Gm/TmAV0uaykSpnHKFIAif/A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="<?=ROOT?>/assets/javascript/designer/barChart.js"></script>

</html>