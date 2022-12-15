<div class="tbox" >
    <div class="orders_view_header">
        <h1> ORDERS DETAILS</h1>
    </div>
    <table class="content-table">
        <thead>

            <th class="th">Order ID</th>
            <th class="th">Payment Type</th>
            <th class="th">Total Amount</th>
            <th class="th">Date</th>
            <th class="th">Order Status</th>
            <th class="th">Customer Address</th>
            <th class="th">Customer Name</th>
            <th class="th">Customer Mobile No</th>

        </thead>
        <tbody>
            <?php foreach ($rows as $row):?>
                <form method="post" action="/woodworks/public/driver_home/order" hidden>
                    <input type="text" name="OrderID" value="<?=$row->OrderID?>" hidden>
                    <tr>
                        <td><?=esc($row->OrderID)?></td>
                        <td><?=esc($row->Payment_type)?></td>
                        <td><?=esc($row->Total_amount)?></td>
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
                        <td><?=esc($row->Mobileno)?></td>
                    </tr>

                </form>
            <?php endforeach;?>
        </tbody>
    </table>
</div>

