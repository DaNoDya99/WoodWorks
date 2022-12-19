<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory - Woodworks</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/supplier/style.css">

</head>

<body onload="timedelload()">
    <?php $this->view('supplier/supplier.header', $data) ?>
   


    <div class="sec1">
        <?php $this->view('cashier/cashier.nav', $data) ?>
    </div>
    <div class="sec2">
        <div class="data" id="panel">
            <hr>
            <div style="display:flex; justify-content:space-between">
                <h3 style="font-weight:500;">Inventory</h3>

                <input type="text" name="search" onkeyup="myFunction()" id="myInput" placeholder="Search Orders">


            </div>

            <table id="myTable">
                <tr>
                    <th>Product ID</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Cost</th>


                </tr>
                <?php foreach ($data['products'] as $order) : ?>
                    <tr>
                        <td><?= $order->ProductID ?></td>
                        <td><?= $order->Name ?></td>
                        <td><?= $order->Quantity ?></td>
                        <td><?= $order->Cost ?></td>

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
</body>

</html>