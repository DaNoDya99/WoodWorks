<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders - Woodworks</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/supplier/style.css">

</head>
<style>
    table button {
        background-color: #182422;
        color: white;
        border: none;
        padding: 15px 20px;
        border-radius: 5px;
        cursor: pointer;
    }
</style>

<body onload="timedelload()">
    <?php $this->view('supplier/supplier.header', $data) ?>

    <div class="content">
        <div class="data" id="panel">
            <hr>
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
                        <td <?php if ($order->OrderStatus == 'pending') : ?>style="color:red; font-weight:bold"<?php endif ?>><?= ucfirst($order->OrderStatus) ?></td>
                        <td><a href="<?=ROOT?>/supplier/acceptOrder/<?= $order->OrderID?>"><button style="background-color: green;">Accept</button></a></td>
                        <td><button style="background-color: red;">Reject</button></td>

                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align:center; font-size:30px; color:#4444">No Orders</td>
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

                function timedelload() {
                    setTimeout(function() {
                        document.getElementById("panel").style.opacity = 1;
                        document.getElementById("panel").style.marginTop = "130px";
                    }, 200);
                }

                function timedelexit() {
                    setTimeout(function() {
                        document.getElementById("panel").style.opacity = 0;
                        document.getElementById("panel").style.marginTop = "150px";
                    }, 200);
                }

                function delay(URL) {
                    setTimeout(function() {
                        window.location = URL
                    }, 500);
                }
            </script>

        </div>
    </div>
<script src="<?= ROOT ?>/assets/javascript/header/header.js"></script>
</body>
</html>