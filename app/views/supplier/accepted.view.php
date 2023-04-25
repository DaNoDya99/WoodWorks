<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accepted Orders - Woodworks</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/supplier/style.css">
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
</head>

<body>
    <?php $this->view('supplier/supplier.header', $data) ?>


    <div class="content">
        <div class="data" id="panel">
            <hr>
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
    <script src="<?= ROOT ?>/assets/javascript/header/header.js"></script>
</body>

</html>