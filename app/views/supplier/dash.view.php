<?php $this->view('supplier/includes/header') ?>
<div class="inventory-body content">
    <div class="sec2">
        <div class="inventory-data" id="panel">

            <div style="display:flex; justify-content:space-between">
                <h3 style="font-weight:500;">Orders</h3>

                <input type="text" name="search" onkeyup="myFunction()" id="myInput" placeholder="Search Orders">


            </div>

            <table id="myTable">
                <tr>
                    <th>Order ID</th>
                    <th>Product Description</th>
                    <th>Additional Comments</th>
                    <th>Order Status</th>

                </tr>
                <?php if (!empty($data['neworders'])) : ?>
                    <?php foreach ($data['neworders'] as $order) : ?>
                        <tr>
                            <td><?= $order->OrderID ?></td>
                            <td><?= $order->ProductID ?></td>
                            <td><?= $order->Comments ?></td>
                            <td <?php if ($order->OrderStatus == 'pending') : ?>style="color:red; font-weight:bold" <?php endif ?>><?= ucfirst($order->OrderStatus) ?></td>
                            <td><a href="<?= ROOT ?>/supplier/acceptOrder/<?= $order->OrderID ?>">
                                    <button
                                        style="background-color: #37ff37 ; color:black; padding: 10px 15px; border: 0px; border-radius: 5px">
                                        Accept
                                    </button>
                                </a></td>
                            <td>
                                <button
                                    style="background-color: #ff3535; color:white; padding: 10px 15px; border: 0px; border-radius: 5px">
                                    Reject
                                </button>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5" style="text-align:center; font-size:30px; color:#4444; height:60vh;">No Orders
                        </td>
                    </tr>
                <?php endif; ?>
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