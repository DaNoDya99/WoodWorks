<h3 class="text"> ORDERS DETAILS</h3><br>

<div class="tbox" >
    <table class="content-table">
        <thead>
            <tr>
                <th class="th">Order ID</th>
                <th class="th">Payment Type</th>
                <th class="th">Total Amount</th>
                <th class="th">Date</th>
                <th class="th">Order Status</th>
                <th class="th">Customer Address</th>
                <th class="th">Customer Name</th>
                <th class="th">Customer Mobile No</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row):?>
                <form method="post" action="/woodworks/public/driver_home/order" hidden>
                    <input type="text" name="OrderID" value="<?=$row->OrderID?>" hidden>
                    <tr>
                        <td><?=esc($row->OrderID)?></td>
                        <td><?=esc($row->PaymentType)?></td>
                        <td><?=esc($row->TotalAmount)?></td>
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
                                            if ($value == esc($row->OrderStatus)) {
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
