<?php $this->view('driver/includes/header') ?>

<body class="driver">
<div class="driver-body">
    <?php $this->view('driver/includes/driver_header') ?>
    <div class="content dashboard">

        <div class="tbox">

            <!-- Tab buttons to switch between different views -->
            <div class="tab_box">
                <a href="<?=ROOT?>/driver_home/order"><button class="tab_btn" id="tab1">Orders Details</button></a>
                <a href="<?=ROOT?>/driver_home/delivered_orders"><button class="tab_btn" id="tab2">Delivered Orders</button></a>
                <a href="<?=ROOT?>/driver_home/orders_records"><button class="tab_btn" id="tab3">Delivered History</button></a>
                <div class="line"></div>
            </div>

            <!-- Delivered History Header -->
            <div class="orders_view_header">
                <h1> DELIVERED HISTORY </h1>

                <!-- Form for filtering the date range -->
                <form method="post" action="<?=ROOT?>/driver_home/orders_records" class="filterDate">
                    <select onchange="this.form.submit()" name="Status">
                        <option value="All" <?= !isset($_POST['Status']) || $_POST['Status'] == 'All' ? 'selected' : '' ?>>All</option>
                        <option value="Dispatched_date" <?= isset($_POST['Status']) && $_POST['Status'] == 'Dispatched_date' ? 'selected' : '' ?>>Dispatched Date</option>
                        <option value="Delivered_date" <?= isset($_POST['Status']) && $_POST['Status'] == 'Delivered_date' ? 'selected' : '' ?>>Delivered Date</option>
                        <option value="Estimated_date" <?= isset($_POST['Status']) && $_POST['Status'] == 'Estimated_date' ? 'selected' : '' ?>>Estimated Date</option>
                    </select>

                    <label for="from-date">From:</label>
                    <input type="date" id="from-date" name="from_date" value="<?= $_POST['from_date'] ?? '' ?>">
                    <label for="to-date">To:</label>
                    <input type="date" id="to-date" name="to_date" value="<?= $_POST['to_date'] ?? '' ?>">
                    <button type="submit" name="dateFilter">Filter</button>
                </form>

            </div>

            <!-- Table containing the delivered orders records -->
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
                    <?php if(!empty($records2)) :?>
                    <?php foreach ($records2 as $row):?>
                        <tr>
                            <td><?=esc($row->OrderID)?></td>
                            <td><?=esc($row->Firstname)?> <?=esc($row->Lastname)?></td>
                            <?php
                                $date1 = $row->Date;
                                $date2 = $row->Dispatched_date;
                                $date3 = $row->Delivered_date;
                                $date4 = $row->Estimated_date;

                                $orderDate = date("d/m/Y", strtotime($date1));


//                                $dateObject = DateTime::createFromFormat('d/m/Y', $orderDate);
//                                $dateObject->add(new DateInterval('P7D'));
//                                $estimatedDeliveryDate = $dateObject->format('d/m/Y');

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

                                if(!empty($date4))
                                {
                                    $estimatedDate = date("d/m/Y", strtotime($date4));
                                }else{
                                    $estimatedDate = "Not exist";
                                }

                                ?>
                            <td><?=$orderDate?></td>
                            <td><?=$estimatedDate?></td>
                            <td><?=$dispatchedDate?></td>
                            <td><?=$deliveredDate?></td>
                        </tr>
                    <?php endforeach;?>
                    <?php else:?>
                        <tr><td>There are no delivered Orders</td></tr>
                    <?php endif;?>
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
