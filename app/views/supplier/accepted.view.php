<?php $this->view('supplier/includes/header') ?>
<div class="inventory-body content">
    <div class="sec2">
        <div class="inventory-data" id="panel">

            <div style="display:flex; justify-content:space-between">
                <h3 style="font-weight:500;">Accepted Orders</h3>
                <input type="text" name="search" onkeyup="myFunction()" id="myInput" placeholder="Search Orders">
            </div>

            <table id="myTable">
                <tr>
                    <th>Order ID</th>
                    <th>Product SKU</th>
                    <th>Quantity</th>
                    <th>Date</th>
                    <th>Order Status</th>

                </tr>

                <?php foreach ($data['acceptedorders'] as $order) : ?>
                    <tr>
                        <td><?= $order->OrderID ?></td>
                        <td><?= $order->ProductID ?></td>
                        <td><?= $order->Quantity ?></td>
                        <td><?= $order->Date ?></td>

                        <td><?= ucfirst($order->OrderStatus) ?></td>
                        <td> <?php if ($order->OrderStatus != 'complete') : ?>
                                <a href="<?= ROOT ?>/supplier/CompleteOrder/<?= $order->OrderID ?>"><button style="background-color: green;">
                                        Complete
                                    </button></a>
                                <button style="background-color: red;">
                                    Cancel
                                </button>

                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
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
            </script>
        </div>
    </div>

</div>
<script src="<?= ROOT ?>/assets/javascript/header/header.js"></script>
</body>

</html>