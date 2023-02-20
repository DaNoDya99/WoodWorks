<?php $this->view('cashier/includes/header') ?>
<div class="inventory-body content">
    <div class="sec2">
        <div class="inventory-data" id="panel">

            <div style="display:flex; justify-content:space-between">
                <h3 style="font-weight:500;">Inventory</h3>

                <input type="text" name="search" onkeyup="myFunction()" id="myInput" placeholder="Search Orders">

            </div>

            <table id="myTable">
                <tr style="position:sticky; top:0; background-color:white;">
                    <th class="col-id">Product ID</th>
                    <th class="col-quantity">Image</th>
                    <th class="col-name">Name</th>
                    <th class="col-cat">Category ID</th>
                    <th class="col-quantity">Quantity</th>
                    <th class="col-cost">Cost</th>
                </tr>
                <?php foreach ($data['products'] as $order) : ?>
                    <tr>
                        <td class="col-id"><?= $order->ProductID ?></td>
                        <td class="col-id"> <img style="width:60px" src="<?= ROOT ?>/<?= $order->image ?>" alt=""> </td>
                        <td class="col-name"><?= $order->Name ?></td>
                        <td class="col-cat"><?= $order->CategoryID ?></td>
                        <td class="col-quantity"><?= $order->Quantity ?></td>
                        <td class="col-cost"><?= $order->Cost ?></td>

                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</div>

</body>
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

    function delay(URL) {
        setTimeout(function() {
            window.location = URL
        }, 0);
    }
</script>

</html>