<div class="tbox" >
    <div class="orders_view_header">
        <h1> ORDERS DETAILS</h1>
        <form method="post" class="order-form" action="/woodworks/public/driver_home/order" hidden>
            <select onchange="this.form.submit()" name="Status">
                <option>-- Filter --</option>
                <?php
                    $arr = array("Processing", "Dispatched", "Delivered");

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
    <table class="content-table" id="myTable">
        <thead>

            <th class="th">Order ID</th>
            <th class="th">Payment Type</th>
            <th class="th">Total Amount</th>
            <th class="th">Date</th>
            <th class="th">Order Status</th>
            <th class="th">Customer Address</th>
            <th class="th">Customer Name</th>
            <th class="th">Customer Mobile No</th>
            <th class="th"></th>

        </thead>
        <tbody>
            <?php foreach ($rows as $row):?>
                <form method="post" action="/woodworks/public/driver_home/order" hidden>
                    <input type="text" name="OrderID" value="<?=$row->OrderID?>" hidden>
                    <tr>
                        <td><?=esc($row->OrderID)?></td>
                        <td><?=esc($row->Payment_type)?></td>
                        <td>Rs. <?=esc($row->Total_amount)?>.00</td>
                        <?php
                        $date = $row->Date;
                        $newDate = date("d/m/Y", strtotime($date));
                        ?>
                        <td><?=$newDate?></td>

                            <td>
                                <select name="status" required onchange="this.form.submit()" class="select">
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
                            <div class ="order-btn-sec">
                                <button onclick="openPopup(event)">More</button>
                            </div>
                        </td>
                    </tr>

                </form>
            <?php endforeach;?>
        </tbody>
    </table>

    <div class="popup driver-popup" id="popup">
        <div class="popup-heading">
            <h2>MORE DETAILS</h2>
            <img src="<?=ROOT?>/assets/images/driver/close.png" alt="Close" onclick="closePopup()">
        </div>
        <form method="post" enctype="multipart/form-data">
            <?php

                $order_items = new Order_Items();
                $orderID = $row->OrderID;
                $results = $order_items->where('OrderID', $orderID);

            ?>
            <div class="image-field driver-edit-img">
            </div>
            <hr>
            <div class="name-field">
                <div class="edit-cus-field last-name">
                    <label>Product Name</label>
                    <?=$results[0]->Name?>
                </div>
            </div>
            <div class="edit-cus-field">
                <label>Quantity</label>
                <?=$results[0]->Quantity?>
            </div>
            <div class="edit-cus-field">
                <label>Cost</label>
                <?=$results[0]->Cost?>
            </div>
        </form>
    </div>

</div>




