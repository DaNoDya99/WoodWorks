<?php $this->view('cashier/includes/header') ?>
<div class="inventory-body content">
<div class=" sec2 ">
    <div class="inventory-data" id="panel">
        <!-- <hr> -->
        <div style="display:flex; justify-content:space-between">
            <h3 style="font-weight:500;">Orders</h3>

            <input type="text" name="search" onkeyup="myFunction()" id="myInput" placeholder="Search Orders">


        </div>

        <table id="myTable">
            <tr>
                <th>Payment Type</th>
                <th>Total Amount</th>
                <th>Date</th>
                <th>Delivery Method</th>
                <th>Order Status</th>
                <th>Address</th>
            </tr>
            <?php foreach ($data['orderdata'] as $order) : ?>
                <tr>
                    <td><?= $order->Payment_type ?></td>
                    <td><?= $order->Total_amount ?></td>
                    <td><?= $order->Deliver_method ?></td>
                    <td><?= $order->Order_status ?></td>
                    <td><?= $order->Address ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

    </div>
</div>

</div>
<script>
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    // function timedelload() {
    //     setTimeout(function() {
    //         document.getElementById("panel").style.opacity = 1;
    //         document.getElementById("panel").style.marginTop = "130px";
    //     }, 200);
    // }

    // function timedelexit() {
    //     setTimeout(function() {
    //         document.getElementById("panel").style.opacity = 0;
    //         document.getElementById("panel").style.marginTop = "150px";
    //     }, 200);
    // }

    function delay(URL) {
        setTimeout(function() {
            window.location = URL
        }, 0);
    }
</script>
</body>

</html> 