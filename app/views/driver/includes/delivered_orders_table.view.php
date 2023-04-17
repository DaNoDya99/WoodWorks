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
                <h1> DELIVERED ORDERS </h1>
            </div>

            <div class="order-details-tbl">
                <table class="content-table" id="myTable">
                    <thead>
                    <tr>
                        <th class="th">Order ID</th>
                        <th class="th">Customer Name</th>
                        <th class="th">Order Date</th>
                        <th class="th">Dispatched Date</th>
                        <th class="th">Delivered Date</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($records1 as $row):?>
                        <form method="post" action="<?=ROOT?>/driver_home/order" hidden>
                            <input type="text" name="OrderID" value="<?=$row->OrderID?>" hidden>
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
                                <td><?=$dispatchedDate?></td>
                                <td><?=$deliveredDate?></td>
                                <td>
                                    <button  onclick="openDocumentPopup('<?=$row->OrderID?>',event)"><img src="<?=ROOT?>/assets/images/driver/pdf.png" alt="PDF image"></button>
                                </td>
                            </tr>
                        </form>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>

            <div id="edit-sub-cat">
                <h1 id="edit-sub-cat-header">hiiiiiii</h1>
                <img class="close-btn" onclick="closeDocumentPopup()" src="<?=ROOT?>/assets/images/driver/close.png" alt="">
                <form id="edit-sub-cat-form" method="post">
                    <div class="sub-cat-img">
                        <img id="edit-sub-cat-img" src="<?=ROOT?>/assets/images/driver/pdf.png" alt="No Image">
                        <label>
                            Upload Document
                        </label>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
</body>

<script src="<?=ROOT?>/assets/javascript/driver/orders_tabs.js"></script>
<script src="<?=ROOT?>/assets/javascript/driver/upload_document.js"></script>
</html>