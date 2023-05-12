<?php $this->view('supplier/includes/header') ?>

<div class="inventory-body content">
    <div class="sec2">
        <div class="inventory-data" id="panel">

            <div style="display:flex; justify-content:space-between">
                <h3 style="font-weight:500;">Accepted Orders</h3>
                <input type="text" name="search" onkeyup="myFunction()" id="myInput" placeholder="Search Orders">
            </div>

            <table id="company-order-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Order ID</th>
                        <th>Date Submitted</th>
                        <th>ManagerID</th>

                        <th>Accepted Date</th>

                        <th>Order Status</th>
                        <th>Actions</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0; ?>
                    <?php foreach ($data['acceptedorders'] as $order) : ?>
                        <tr>
                            <td><small><?= ++$i ?></small></td>
                            <td><?= $order->OrderID ?></td>
                            <td><?= $order->Date ?></td>
                            <td><?= $order->ManagerID ?></td>
                            <td><?= $order->Responded_date ?></td>

                            <td><?= ucfirst($order->OrderStatus) ?></td>
                            <!--                        <td> --><?php //if ($order->OrderStatus != 'complete') : 
                                                                ?>
                            <!--                                <a href="--><?php //= ROOT 
                                                                            ?><!--/supplier/CompleteOrder/-->
                            <?php //= $order->OrderID 
                            ?><!--"><button style="background-color: green;">-->
                            <!--                                        Complete-->
                            <!--                                    </button></a>-->
                            <!--                                <button style="background-color: red;">-->
                            <!--                                    Cancel-->
                            <!--                                </button>-->
                            <!---->
                            <!--                            --><?php //endif; 
                                                                ?>
                            <!--                        </td>-->
                            <td>
                                <div class="table-actions">
                                    <button>Update Status</button><button>View Details</button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
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