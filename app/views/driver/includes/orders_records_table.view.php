<?php $this->view('driver/includes/header') ?>

<body class="driver">
<div class="driver-body">
    <?php $this->view('driver/includes/driver_header') ?>
    <div class="content dashboard">

        <div class="tbox">

            <div class="tab_box">
                <a href="<?=ROOT?>/driver_home/order"><button class="tab_btn" id="tab1">Orders Details</button></a>
                <a href="<?=ROOT?>/driver_home/delivered_orders"><button class="tab_btn" id="tab2">Delivered Orders</button></a>
                <a href="<?=ROOT?>/driver_home/orders_records"><button class="tab_btn" id="tab3">Delivered History</button></a>
                <div class="line"></div>
            </div>

            <div class="orders_view_header">
                <h1> DELIVERED HISTORY </h1>

                <form method="post" action="<?=ROOT?>/driver_home/orders_records" class="filterDate">
                    <label for="from-date">From:</label>
                    <input type="date" id="from-date" name="from_date">
                    <label for="to-date">To:</label>
                    <input type="date" id="to-date" name="to_date">
                    <button type="submit" name="dateFilter">Filter</button>
                </form>

            </div>

            <div class="order-details-tbl">
                <table class="content-table" id="myTable">
                    <thead>
                    <tr>
                        <th class="th">Order ID</th>
                        <th class="th">Customer Name</th>
                        <th class="th">Order Date</th>
                        <th class="th">Estimated Delivery Date</th>
                        <th class="th">Dispatched Date</th>
                        <th class="th">Delivered Date</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($records2 as $row):?>
                        <tr>
                            <td><?=esc($row->OrderID)?></td>
                            <td><?=esc($row->Firstname)?> <?=esc($row->Lastname)?></td>
                            <?php
                                $date1 = $row->Date;
                                $date2 = $row->Dispatched_date;
                                $date3 = $row->Delivered_date;
                                $orderDate = date("d/m/Y", strtotime($date1));
                                if(!empty($date2))
                                {
                                    $dispatchedDate = date("d/m/Y", strtotime($date2));

                                }else{
                                    $dispatchedDate = "Not Dispatched";

                                }

                                if(!empty($date3))
                                {
                                    $deliveredDate = date("d/m/Y", strtotime($date3));
                                }else{
                                    $deliveredDate = "Not Delivered";
                                }

                                ?>
                            <td><?=$orderDate?></td>
                            <td></td>
                            <td><?=$dispatchedDate?></td>
                            <td><?=$deliveredDate?></td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
<script src="<?=ROOT?>/assets/javascript/driver/orders_tabs.js"></script>
<script src="<?=ROOT?>/assets/javascript/driver/filter_date.js"></script>
</html>
