<?php $this->view('driver/includes/header') ?>

<body class="driver">
<div class="driver-body">
    <?php $this->view('driver/includes/driver_sidebar') ?>
    <div class="dashboard">
        <div class="dashboard-nav">
            <div class="nav-item-page-name">
                <h1><?= $title ?></h1>
            </div>
            <div class="nav-item-user">
                <img src="<?=ROOT?>/<?=$details[0]->Image?>" alt="Profile picture">
                <div class="nav-vr"></div>
                <h1>Hi, <?=ucfirst(substr(Auth::getFirstname(),0,1))?>.<?=Auth::getLastname()?></h1>
                <div class="nav-vr"></div>
                <form method="post" action="<?=ROOT?>/driver_home/availability">
                    <select name="Availability" required onchange="this.form.submit()" class="select-available">
                        <?php
                        $arr = array("Available", "Not Available");

                        foreach ($arr as $value) {
                            if ($value == esc($row[0]->Availability)) {
                                echo "<option value=$value selected>$value</option>";
                            } else {
                                echo "<option value=$value>$value</option>";
                            }
                        }
                        ?>
                    </select>
                </form>
                <div class="nav-vr"></div>
                <a href="<?=ROOT?>/logout3">
                    <h1>Logout</h1>
                </a>
            </div>
        </div>


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
<?php $this->view('driver/includes/footer'); ?>
</html>