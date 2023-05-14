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
                    echo "<option value='$value' selected>$value</option>";
                } else {
                    echo "<option value='$value'>$value</option>";
                }
            }
            ?>

        </select>
    </form>

<!--    <form method="post" class="vehicle-form" action="/woodworks/public/driver_home/index" hidden>-->
<!--        <select name="vehicle" required onchange="this.form.submit()">-->
<!--            <option>----Vehicle Type ---</option>-->
<!--            --><?php
//            $arr = array("CargoVan", "BoxTruck", "MovingTruck", "FlatbedTruck");
//
//            foreach ($arr as $value) {
//                if ($value == $_POST['vehicle']) {
//                    echo "<option value=$value >$value</option>";//selected
//                } else {
//                    echo "<option value=$value>$value</option>";
//                }
//            }
//            ?>
<!--        </select>-->
<!--    </form>-->

    <div class="content dashboard">

        <div class="containers">

            <div class="driver-tbox">
                <div class="recentOrders">
                    <div class="driver-tbox-header">
                        <h1>Recent Orders</h1>
                        <button onclick="location.href='<?=ROOT?>/driver_home/order';">View All</button>
                    </div>
                    <table class="driver-content-table">
                        <thead>
                        <th class="th">Order Status</th>
                        <th class="th">Order Date</th>
                        <th class="th">Estimated<br> Delivery Date</th>

                        </thead>
                        <tbody>
                        <?php foreach ($rows as $row):?>
                            <tr class="orders-table-rows">

                                <?php if($row->Order_status == "Processing"):?>
                                    <td><img src="<?=ROOT?>/assets/images/driver/redcircle.png" alt="Processing" id="statusCircle"><?=esc($row->Order_status)?></td>
                                <?php elseif($row->Order_status == "Dispatched"):?>
                                    <td><img src="<?=ROOT?>/assets/images/driver/greencircle.png" alt="Dispatched" id="statusCircle"><?=esc($row->Order_status)?></td>
                                <?php endif;?>
                                <?php
                                $date = $row->Date;
                                $newDate1 = date("d/m/Y", strtotime($date));
                                $newDate2 = date("d/m/Y", strtotime($row->Estimated_date));

//                                $dateObject = DateTime::createFromFormat('d/m/Y', $newDate);
//                                $dateObject->add(new DateInterval('P7D'));
//                                $estimatedDeliveryDate = $dateObject->format('d/m/Y');
                                ?>
                                <td><?=$newDate1?></td>
                                <td><?=$newDate2?></td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="chart-container3">

                <div class="box" id="chart-container" onclick="location.href='<?=ROOT?>/driver_home/order';">
                    <canvas id="myPie" width="80" height="80"> </canvas>
                </div>
                <div class="cardBox">
                    <div class="cards" onclick="location.href='<?=ROOT?>/driver_home/order';">
                        <div>
                            <div class="numbers"><?=$data['completedOrders'][0]->NumOfCompletedOrdres?></div>
                            <div class="cardsName">This week Completed Orders</div>
                        </div>

                        <div class="iconBx">
                            <img src="<?= ROOT ?>/assets/images/driver/completedOrder.png">
                        </div>
                    </div>

                    <div class="cards" onclick="location.href='<?=ROOT?>/driver_home/order';">
                        <div>
                            <div class="numbers"><?=$data['delayedOrders'][0]->NumOfDelayedOrders?></div>
                            <div class="cardsName">This Month Delayed Deliveries</div>
                        </div>

                        <div class="iconBx">
                            <img src="<?= ROOT ?>/assets/images/driver/delay.png">
                        </div>
                    </div>
                </div>

            </div>

            <div class="box" id="chart-container2" onclick="location.href='<?=ROOT?>/driver_home/order';">
                <canvas id="myBar" width="340" height="440"> </canvas>
            </div>

        </div>
    </div>
</div>
</body>

</html>