<?php $this->view('driver/includes/header') ?>

<body class="driver">
<div class="driver-body">
    <?php $this->view('driver/includes/driver_header') ?>

    <form method="post" action="<?=ROOT?>/driver_home/availability">
        <select name="Availability" required onchange="this.form.submit()" class="select-available">
            <?php
            $arr = array("Available", "Not Available");

            foreach ($arr as $value) {
                if ($value == esc($row[0]->Availability)) {
                    show($value);
                    echo "<option value=$value selected>$value</option>";
                } else {
                    echo "<option value=$value>$value</option>";
                }
            }
            ?>
        </select>
    </form>

    <div class="content dashboard">

        <div class="containers">

            <div class="box" id="chart-container" onclick="location.href='<?=ROOT?>/driver_home/order';">
                <canvas id="myPie" width="100" height="100"> </canvas>
            </div>

            <!--            <div class="box" id="chart-container3"">-->
            <!--                <canvas id="myLine" height="400" width="300"></canvas>-->
            <!--            </div>-->

            <div class="driver-tbox" onclick="location.href='<?=ROOT?>/driver_home/order';">
                <h1>New Orders</h1>
                <table class="driver-content-table">
                    <thead>

                    <th class="th">Payment Type</th>
                    <th class="th">Order Status</th>
                    <th class="th">Date</th>

                    </thead>
                    <tbody>
                    <?php foreach ($rows as $row):?>
                        <tr class="orders-table-rows">
                            <td><?=esc($row->Payment_type)?></td>
                            <td><?=esc($row->Order_status)?></td>
                            <?php
                            $date = $row->Date;
                            $newDate = date("d/m/Y", strtotime($date));
                            ?>
                            <td><?=$newDate?></td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>

            </div>

            <div class="box" id="chart-container2" onclick="location.href='<?=ROOT?>/driver_home/order';">
                <canvas id="myBar" width="300" height="400"> </canvas>
            </div>

        </div>
    </div>
</div>
</body>

</html>