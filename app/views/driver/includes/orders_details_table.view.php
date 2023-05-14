<div class="tbox">

    <div class="tab_box">
        <a href="<?=ROOT?>/driver_home/order"><button class="tab_btn" id="tab1">Orders Details</button></a>
        <a href="<?=ROOT?>/driver_home/delivered_orders"><button class="tab_btn" id="tab2">Delivered Orders</button></a>
        <a href="<?=ROOT?>/driver_home/orders_records"><button class="tab_btn" id="tab3">Delivered History</button></a>
        <div class="line"></div>
    </div>
    <div id="response">

    </div>


    <div class="orders_view_header">
        <h1> ORDERS DETAILS</h1>
        <form method="post" class="order-form" action="<?=ROOT?>/driver_home/order" hidden>

            <select onchange="this.form.submit()" name="Status">
                <option>All</option>
                <?php
                    $arr = array("Processing", "Dispatched");

                    foreach ($arr as $value) {
                        if ($value == $_POST['Status']) {
                            echo "<option value=$value selected>$value</option>";
                        } else {
                            echo "<option value=$value>$value</option>";
                        }
                    }
                    ?>
            </select>
            <button type="submit">
                <img src="<?=ROOT?>/assets/images/driver/filter.png" alt="Filter">
            </button>
        </form>

        <form class="order-form">
            <input type="search" name="orders_items"  id="myInput" placeholder="Orders details">
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
                <th class="th">Payment Type</th>
                <th class="th">Total Amount</th>
                <th class="th">Delivery Fee</th>
                <th class="th">Order Date</th>
                <th class="th">Estimated Date</th>
                <th class="th">Order Status</th>
                <th class="th">Customer Address</th>
                <th class="th">Customer Name</th>
                <th class="th">Customer Mobile No</th>
                <th class="th"></th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($rows as $row):?>

                <form method="post" action="<?=ROOT?>/driver_home/order" hidden>
                    <input type="text" name="OrderID" value="<?=$row->OrderID?>" hidden>
                    <tr>

                        <td><?=esc($row->OrderID)?></td>
                        <td><?=esc($row->Payment_type)?></td>
                        <td>Rs. <?=esc($row->Total_amount)?>.00</td>
                        <td>Rs. <?=esc($row->Shipping_cost)?>.00</td>
                        <?php
                            $date = $row->Date;
                            $newDate = date("d/m/Y", strtotime($date));
                            $newDate2 = date("d/m/Y", strtotime($row->Estimated_date));
                            ?>
                        <td><?=$newDate?></td>
                        <td><?=$newDate2?></td>

                        <td>
                            <select name="status" required onchange="changeStatus('<?=$row->OrderID?>')" class="select">
                            <?php
                                    $arr = array("Processing", "Dispatched", "Delivered");

                                    foreach ($arr as $value) {
                                        if ($value == esc($row->Order_status)) {
                                            echo "<option value=$value selected>$value</option>";
                                        } else {
                                            echo "<option value=$value>$value</option>";
                                        }
                                    }
                                    ?>
                            </select>
                        </td>
                        <td><?=esc($row->Address)?></td>
                        <td><?=esc($row->Firstname)?> <?=esc($row->Lastname)?></td>
                        <td><?=esc($row->Contactno)?></td>
                        <td>
                            <div class="order-btn-sec">
                                <button onclick="openDocumentPopups('<?=$row->OrderID?>',event)" id="doc-btn">More</button>
                            </div>
                        </td>
                    </tr>
                </form>

            <?php endforeach;?>
            </tbody>
        </table>
    </div>



    <div id="popups">
        <div class="popups-heading">
            <img class="close-btn" onclick="closeDocumentPopups()" src="<?=ROOT?>/assets/images/driver/close.png" alt="close button">
            <h1>More Details</h1>
            <h2 id="order_id"></h2>
        </div>

        <table class="details-table">
            <thead>
                <tr>
                    <th class="th">Product Name</th>
                    <th class="th">Quantity</th>
                    <th class="th">Cost</th>
                    <th class="th">Image</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
    </div>

</div>
