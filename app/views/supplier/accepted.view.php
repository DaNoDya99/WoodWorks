<?php $this->view('supplier/includes/header') ?>

<div class="inventory-body content">
    <div class="sec2">
        <div class="inventory-data" id="panel">

            <div style="display:flex; justify-content:space-between">
                <h3 style="font-weight:500;">Responded Orders</h3>
                <input type="text" name="search" onkeyup="myFunction()" id="myInput" placeholder="Search Orders">
            </div>
            <table id="company-order-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Order ID</th>
                    <th>Date Submitted</th>
                    <th>ManagerID</th>

                    <th>Responded Date</th>

                    <th>Order Status</th>
                    <th>Actions</th>

                </tr>
                </thead>
                <tbody>
                <?php if (empty($data['acceptedorders'])) : ?>
                    <tr>
                        <td colspan="7" style="text-align: center">No orders found</td>
                    </tr>
                <?php else:?>
                <?php $i = 0; ?>
                <?php foreach ($data['acceptedorders'] as $order) : ?>
                    <tr>
                        <td><small><?= ++$i ?></small></td>
                        <td><?= $order->OrderID ?></td>
                        <td><?= $order->Date ?></td>
                        <td><?= $order->ManagerID ?></td>
                        <td><?= $order->Responded_date ?></td>

                        <td><?= ucfirst($order->OrderStatus) ?></td>
                        <td>
                            <div class="table-actions">
                                <button>Update Status</button>
                                <button onclick="viewCompOrder('<?= $order->OrderID ?>')">View Details</button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php endif;?>
                </tbody>
            </table>


        </div>
    </div>


    </div>
    <div id="popup3" class="popup3 hidden">
        <div class="popup3-content">
            <span id="close-popup3" class="close">&times;</span>
            <h2>Order No:<span class="order-title"></span></h2>

            <div style="margin-top:20px;display: flex; flex-direction: row ">
                <div style="width: 50%">
                    <p>Order Status: <span id="ordStatus"></span></p>
                    <p>Sent by Manager ID:<span id="custID"></span></p>
                    <p>Date order was placed: <span id="orderDate"></span></p>

                </div>
                <div style="width: 50%;">
                    <p>Responded Date: <span id="respDate"></span></p>
                    <p id="order-blank">Reason for rejection: <span id="rejReason"></span></p>
                    <p id="order-rdate">Date Goods Received: <span id="receivedDate"></span></p>
                    <textarea disabled style="padding: 5px" id="comments" name="comments" rows="4" cols="50" placeholder="Comments"></textarea>
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
                        <th>Image</th>
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
<!--<script src="--><?php //= ROOT ?><!--/assets/javascript/header/header.js"></script>-->
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

    function viewCompOrder(orderid) {
        popup.classList.remove('hidden');
        document.getElementsByClassName('order-title')[0].innerHTML = orderid;
        //     fetch data from db via fetch
        fetch('http://localhost/WoodWorks/public/supplier/getItemsByOrderID/+' + orderid)
            .then(response => response.json())
            .then(data => {
                    console.log(data);
                    let orderDetails = data.order[0];
                    console.log(orderDetails);
                    document.getElementById('custID').innerHTML = orderDetails.ManagerID;
                    document.getElementById('orderDate').innerHTML = orderDetails.Date;
                    document.getElementById('respDate').innerHTML = orderDetails.Responded_date;

                    if (orderDetails.OrderStatus === "Rejected") {
                        document.getElementById('order-blank').style.display = "block";
                        document.getElementById('rejReason').innerHTML = orderDetails.Reason_for_rejection;
                    } else {
                        document.getElementById('order-blank').style.display = "none";
                    }

                    if (orderDetails.OrderStatus === "Recieved") {
                        document.getElementById('order-rdate').style.display = "block";
                        document.getElementById('receivedDate').innerHTML = orderDetails.Received_date;
                    } else {
                        document.getElementById('order-rdate').style.display = "none";
                    }
                    if (orderDetails.OrderStatus === "Accepted") {
                        document.getElementById('order-blank').style.display = "none";
                        document.getElementById('order-rdate').style.display = "none";
                    }
                    document.getElementById('ordStatus').innerHTML = orderDetails.OrderStatus;

                    // document.getElementById('ordStatus').innerHTML = orderDetails.Order_status;
                    // document.getElementById('total').innerHTML = "Rs. " + orderDetails.Total_amount;
                    //
                    // // document.getElementById('deldate').innerHTML=orderDetails.CustomerID;
                    //
                    // console.log(data.order_items);
                    //
                    let tbody = document.getElementById('order-items-table');
                    //
                    tbody.innerHTML = '';
                    //
                    data.items.forEach(item => {
                        console.log(item);
                        var row = document.createElement("tr");
                        var cell1 = document.createElement("td");
                        var cell2 = document.createElement("td");
                        var cell3 = document.createElement("td");
                        var cell4 = document.createElement("td");


                        cell1.innerHTML = item.ProductID;
                        cell2.innerHTML = item.Quantity;
                        cell3.innerHTML = "<img src='http://localhost/WoodWorks/public/" + item.image + "' style='width: 100px; height: 100px; object-fit: cover; border-radius: 10px'>";

                        row.appendChild(cell1);
                        row.appendChild(cell2);
                        row.appendChild(cell3);


                        tbody.appendChild(row);
                    })


                }
            )
            .catch(error => console.error(error))


    }

    const closePopupButton = document.getElementById('close-popup3');
    const popup = document.getElementById('popup3');

    closePopupButton.addEventListener('click', function () {
        popup.classList.add('hidden');
    });

    window.addEventListener('click', function (event) {
        if (event.target === popup) {
            popup.classList.add('hidden');
        }
    });
</script>
</body>

</html>