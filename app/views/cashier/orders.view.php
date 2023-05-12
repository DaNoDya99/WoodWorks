<?php $this->view('cashier/includes/header') ?>
<div class="inventory-body content">
    <div class=" sec2 ">
        <div class="inventory-data" id="panel">
            <!-- <hr> -->
            <div style="display:flex; justify-content:space-between">
                <h3 style="font-weight:500;">Orders</h3>

                <input type="text" name="search" onkeyup="myFunction()" id="myInput" placeholder="Search Orders">


            </div>
            <br>
            <table id="myTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>OrderID</th>
                        <th>Customer Name</th>
                        <th>Total Amount</th>
                        <th>Date Order Submitted</th>
                        <!-- <th>Delivery Method</th> -->
                        <!-- <th>Payment Type</th> -->
                        <th>Order Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($data['orders'] as $order) : ?>

                       
                        <tr onclick="orderdetailpopup(<?= "'" . $order->OrderID . "'" ?>)">
                            <td style="color: grey"><?= $i ?></td>
                            <td><?= $order->OrderID ?></td>
                            <td><?= $order->Firstname . " " . $order->Lastname ?></td>
                            <td><?= "Rs. " . number_format($order->Total_amount, 2, '.', ',') ?></td>
                            <td><?= $order->Date ?></td>
                            <!-- <td><?= $order->Deliver_method ?></td> -->
                            <!-- <td style="text-align: center"><?= $order->Payment_type ?></td> -->
                            <td style="text-align: center;">
                                <span style="width:90px; padding: 5px 10px; border-radius: 5px;
                            <?= $order->Order_status == 'unpaid' ? 'background-color: #f99;' : ($order->Order_status == 'pending' ? 'background-color: #FFAE42;' : 'background-color: #98FF98;') ?>">
                                    <?= ucwords($order->Order_status) ?>
                                </span>
                            </td>


                        </tr>
                        <?php $i = $i + 1 ?>

                    <?php endforeach; ?>
                </tbody>


            </table>

        </div>
    </div>
    <div id="popup3" class="popup3 hidden">
        <div class="popup3-content">
            <span id="close-popup3" class="close">&times;</span>
            <h2 class="order-title">Order No:</h2>
            <button style="border:0px; border-radius:10px;display:block;margin-top:10px;padding: 15px 30px; font-weight:500; color: #0076e1; background-color: #bbe3ff; width: fit-content;">
                Download bill as PDF
            </button>
            <div style="margin-top:20px;display: flex; flex-direction: row ">
                <div style="width: 50%">
                    <p>Customer Name: <span id="custName"></span></p>
                    <p>Customer ID:<span id="custID"></span></p>
                    <p>Order Date: <span id="orderDate"></span></p>
                    <p>Delivery Date: <span id="deldate"></span></p>
                </div>
                <div style="width: 50%;">
                    <p>Delivery Method: <span id="delMethod"></span></p>
                    <p>Payment Type: <span id="payMethod"></span></p>
                    <p>Order Status: <span id="ordStatus"></span></p>
                    <p>Total Amount: <span id="total"></span></p>

                </div>
            </div>
            <div>

            </div>
            <div class="table-wrapper" style="width: 100%; margin-top: 20px">
                <!--            create dummy table with a list of order items-->
                <table class="order-items-table">
                    <thead style="width: 100%">
                        <tr>
                            <th>ProductID</th>
                            <!-- <th>Product Name</th> -->
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Sub Total</th>
                        </tr>

                    </thead>
                    <tbody id="order-items-table">
                        <!-- Rows generated via JS -->
                    </tbody>
                </table>


            </div>
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


    const closePopupButton = document.getElementById('close-popup3');
    const popup = document.getElementById('popup3');

    function orderdetailpopup(orderid) {
        popup.classList.remove('hidden');
        document.getElementsByClassName('order-title')[0].innerHTML = 'Order No: ' + orderid;
        //     fetch data from db via fetch
        fetch('http://localhost/WoodWorks/public/cashier/getorderbyid/+' + orderid)
            .then(response => response.json())
            .then(data => {
                // console.log(data);
                let orderDetails = data.order[0];
                document.getElementById('custName').innerHTML = orderDetails.Firstname + " " + orderDetails.Lastname;
                document.getElementById('custID').innerHTML = orderDetails.CustomerID;
                document.getElementById('orderDate').innerHTML = orderDetails.Date;
                document.getElementById('delMethod').innerHTML = orderDetails.Deliver_method;
                document.getElementById('payMethod').innerHTML = orderDetails.Payment_type;
                document.getElementById('ordStatus').innerHTML = orderDetails.Order_status;
                document.getElementById('total').innerHTML = "Rs. " + orderDetails.Total_amount;

                // document.getElementById('deldate').innerHTML=orderDetails.CustomerID;

                console.log(data.order_items);

                let tbody = document.getElementById('order-items-table');

                tbody.innerHTML='';

                data.order_items.forEach(item => {
                    console.log(item);
                    var row = document.createElement("tr");
                    var cell1 = document.createElement("td");
                    var cell2 = document.createElement("td");
                    var cell3 = document.createElement("td");
                    var cell4 = document.createElement("td");


                    cell1.innerHTML = item.ProductID;
                    cell2.innerHTML = item.Quantity;
                    cell3.innerHTML = "Rs. " + item.Cost;
                    cell4.innerHTML = "Rs. " + item.Cost * item.Quantity

                    row.appendChild(cell1);
                    row.appendChild(cell2);
                    row.appendChild(cell3);
                    row.appendChild(cell4);


                    tbody.appendChild(row);
                })




            })
            .catch(error => console.error(error))

    }



    closePopupButton.addEventListener('click', function() {
        popup.classList.add('hidden');
    });

    window.addEventListener('click', function(event) {
        if (event.target === popup) {
            popup.classList.add('hidden');
        }
    });
</script>
</body>

</html> 