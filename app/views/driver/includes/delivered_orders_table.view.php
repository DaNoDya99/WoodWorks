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
                <form class="order-form">
                    <input type="search" name="delivered_items"  id="myInput" placeholder="Orders details">
                    <button type="submit" name="order_date">
                        <img src="<?=ROOT?>/assets/images/driver/search.png" alt="Search">
                    </button>
                </form>
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

                    <?php if(!empty($records1)) :?>
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

                                    $dateObject = DateTime::createFromFormat('d/m/Y', $orderDate);
                                    $dateObject->add(new DateInterval('P7D'));
                                    $estimatedDeliveryDate = $dateObject->format('d/m/Y');

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
                                    <button  onclick="openDocumentPopup('<?=$row->OrderID?>','<?=($row->Firstname)?>','<?=($row->Image)?>','<?=$deliveredDate?>','<?=$estimatedDeliveryDate?>',event)"><img src="<?=ROOT?>/assets/images/driver/pdf.png" alt="PDF image"></button>
                                </td>
                            </tr>
                        </form>
                        <?php endforeach;?>
                    <?php else:?>
                        <tr><td colspan="8" style="text-align: center">There are no delivered Orders</td></tr>
                    <?php endif;?>
                    </tbody>
                </table>
            </div>

            <div id="upl-doc" class="upload-document">
                <img class="close-btn" onclick="closeDocumentPopup()" src="<?=ROOT?>/assets/images/driver/close.png" alt="close button">
                <h2>Upload Confirmation Image</h2>
                <form id="edit-doc-form" method="post">
                    <div class="doc-img">
                        <img id="edit-doc-img" src="<?=ROOT?>/assets/images/driver/No_image.jpg" alt="No Image">
                        <label>
                            Upload
                            <input onchange="load_doc_image(this.files[0])" type="file" name="Image">
                        </label>
                    </div>
                    <div class="doc-inputs">
                        <div class="doc-form-field">
                            <label>Order ID</label>
                            <p id="header1"></p>
                        </div>
                        <div class="doc-form-field">
                            <label>Customer Name</label>
                            <p id="header2"></p>
                        </div>
                        <div class="doc-form-field">
                            <label>Estimated Delivery Date</label>
                            <p id="header3"></p>
                        </div>
                        <div class="doc-form-field">
                            <label>Delivered Date</label>
                            <p id="header4"></p>
                        </div>
<!--                        <div class="doc-form-field">-->
<!--                            <label>If delivery was delayed then,<br>Give the reason for late delivery</label>-->
<!--                            <textarea id="doc-field" name="Reason" placeholder="Enter the Reason"></textarea>-->
<!--                        </div>-->
                        <div class="submit-btn">
                            <button id="doc-btn" type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<div class="cat-response" id="response">

</div>
</body>

<script src="<?=ROOT?>/assets/javascript/driver/orders_tabs.js"></script>
<script src="<?=ROOT?>/assets/javascript/driver/upload_document.js"></script>
</html>
