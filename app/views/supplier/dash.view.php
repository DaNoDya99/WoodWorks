<?php $this->view('supplier/includes/header') ?>
<div class="inventory-body content">
    <div class="sec2">
        <div class="order-section">
            <h3>Restocking Orders</h3>
            <br>
            <div style="display: flex; flex-direction: column; column-gap: 20px">

                <label for="sortFilter">Sort By:</label>
                <select id="sortFilter">
                    <option value="date-descending">Date (Newest First)</option>

                    <option value="date-ascending">Date (Oldest First)</option>
                </select>

            </div>


            <div class="order-list">

            </div>
        </div>
        <div class="supply-order-detail">
            <div class="detail-box">
                <div style="display: flex; justify-content: space-between">
                    <h2>Order Details - <span class="orderid-span" style="color:#3b3b3b"></span></h2>
                    <span class="orderstatus" style="background-color: #ffae35; padding: 5px 10px; border-radius: 5px;">
                            Pending
                        </span>
                </div>

                <div style="display: flex; flex-direction: column; height: 100%">
                    <div style="height: 30%; display: flex; flex-direction: column; margin-top: 30px;">
                        <div>
                            <span>Sent by: </span><span class="managerno-span"></span>
                        </div>
                        <div>
                            <span>Date Order Sent: </span><span class="dateSent-span"></span>
                        </div>
                        <span>Comment: </span>
                        <textarea disabled class="comment-area"
                                  style="border-radius: 5px; padding: 5px; background-color: #e5e5e5"
                                  rows="4"></textarea>
                    </div>
                    Order-Description
                    <div style="height: 60%; overflow: scroll">

                        <table style="width: 100%; margin-top: 20px;">
                            <thead style="position: sticky; top: 0; background-color: white; text-align: center">
                            <tr>
                                <th>Product ID</th>
                                <th>Image</th>
                                <th>Quantity</th>
                            </tr>
                            </thead>
                            <tbody style="text-align: center" class="order-item-list">
                            <tr style="height: 100px">
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr style="height: 100px">
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr style="height: 100px">
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tbody>

                        </table>

                    </div>
                    <div class="response-box">
                        <button id="accept">Accept</button>
                        <button id="reject">Reject</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="popup-reject-comment"
         style="position: absolute; padding: 40px; width: 50vw; height: auto; background-color: white; top: 0; z-index: 99; top: 50%;left: 50%; transform: translate(-50%,-50%); box-shadow: 0px 0px 25px 0px rgba(0,0,0,0.75); border-radius: 10px; display: none">
        <span>Enter Reason for Rejection</span><br><br>
        <textarea id="reason" style="width: 100%; height: 50%; border-radius: 5px; padding: 5px"
                  rows="4"></textarea><br><br>
        <button id="reject-btn"
                style="padding: 10px 25px; border-radius: 8px; border: 0px; background-color: #d8000c; color: white">
            Reject
        </button>
        <button id="close-btn"
                style="position: absolute; top: 10px; right: 10px; padding: 5px; border: none; background-color: transparent; font-size: 18px; cursor: pointer"
                onclick="closePopup()">X
        </button>
    </div>


</div>

<script>

    function closePopup() {
        var popup = document.querySelector('.popup-reject-comment');
        popup.style.display = 'none';
    }

    function filterAndSortOrders(orders, sort) {
        let filteredOrders = orders;

        // Apply filters


        // Apply sorting
        if (sort === 'date-ascending') {
            filteredOrders.sort((a, b) => {
                const dateA = new Date(a.Date).getTime();
                const dateB = new Date(b.Date).getTime();
                return dateA - dateB;
            });
        } else if (sort === 'date-descending') {
            filteredOrders.sort((a, b) => {
                const dateA = new Date(a.Date).getTime();
                const dateB = new Date(b.Date).getTime();
                return dateB - dateA;
            });
        }
        return filteredOrders;
    }


    document.getElementById('sortFilter').addEventListener('change', function () {
        updateOrderList();
    });


    function updateOrderList() {
        const sortFilterValue = document.getElementById('sortFilter').value;

        fetch('http://localhost/woodworks/public/supplier/getneworders')
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data.neworders !== false) {
                    const filteredAndSortedOrders = filterAndSortOrders(data.neworders, sortFilterValue);

                    const orderListElement = document.getElementsByClassName("order-list")[0];
                    orderListElement.innerHTML = ''; // Clear existing order list items

                    filteredAndSortedOrders.forEach(order => {
                        const orderListItem = document.createElement("div");
                        orderListItem.className = "order-list-item";
                        const orderInfo = document.createElement("div");

                        const orderHeading = document.createElement("h4");
                        orderHeading.innerHTML = `<span>#${order.OrderID}</span>`;

                        const orderDateQuantity = document.createElement("div");
                        orderDateQuantity.style.display = "flex";

                        const orderDate = document.createElement("p");
                        orderDate.className = "date";
                        orderDate.textContent = "Date Sent: " + order.Date;

                        // const orderQuantity = document.createElement("p");
                        // orderQuantity.className = "quantity";
                        // orderQuantity.textContent = `Date Submitted: ${order.Date}`;

                        orderDateQuantity.appendChild(orderDate);
                        // orderDateQuantity.appendChild(orderQuantity);

                        orderInfo.appendChild(orderHeading);
                        orderInfo.appendChild(orderDateQuantity);

                        // const orderStatus = document.createElement("div");
                        // const statusSpan = document.createElement("span");
                        // statusSpan.className = "status";
                        // orderStatus.style.display = "flex";
                        // orderStatus.style.justifyContent = "center";
                        // orderStatus.style.alignItems = "center";
                        // statusSpan.style.color = "white";
                        // statusSpan.style.backgroundColor = "#e79e00";
                        // statusSpan.textContent = order.OrderStatus;
                        // orderStatus.appendChild(statusSpan);

                        orderListItem.appendChild(orderInfo);
                        // orderListItem.appendChild(orderStatus);
                        orderListItem.orderData = order; // Store the order object as a property on the element
                        orderListElement.appendChild(orderListItem);
                    });

                    addEventListenersToOrderListItems();
                    handleClick(document.getElementsByClassName("order-list")[0].firstChild.orderData)
                    document.getElementsByClassName("order-list")[0].firstChild.classList.add("selected");
                } else {
                    document.getElementsByClassName("order-list")[0].innerHTML = "<h1>No New Orders</h1>";
                    handleClick('none');

                }

            });
    }

    // Call updateOrderList() initially to render the list with default filters
    updateOrderList();


    document.getElementById('sortFilter').addEventListener('change', function () {
        updateOrderList();
    });


    // Call updateOrderList() initially to render the list with default filters


    function addEventListenersToOrderListItems() {
        const orderListItems = document.querySelectorAll('.order-list-item');

        orderListItems.forEach(item => {
            item.addEventListener('click', function () {
                const itemId = item.id;

                // Deselect all other items
                orderListItems.forEach(otherItem => {
                    if (otherItem !== item) {
                        otherItem.classList.remove('selected');
                    }
                });

                const order = item.orderData; // Get the order object from the element
                handleClick(order); // Call the function with the order object as a parameter
                item.classList.toggle('selected');
            });
        });
    }


    // document.addEventListener('DOMContentLoaded', function () {
    //     fetch('http://localhost/woodworks/public/supplier/getneworders')
    //         .then(response => response.json())
    //         .then(data => {
    //             const orderListElement = document.getElementsByClassName("order-list")[0];
    //             console.log(data.neworders);
    //
    //             data.neworders.forEach(order => {
    //                 const orderListItem = document.createElement("div");
    //                 orderListItem.className = "order-list-item";
    //                 const orderInfo = document.createElement("div");
    //
    //                 const orderHeading = document.createElement("h4");
    //                 orderHeading.innerHTML = `<span>#${order.OrderID}</span>`;
    //
    //                 const orderDateQuantity = document.createElement("div");
    //                 orderDateQuantity.style.display = "flex";
    //
    //                 const orderDate = document.createElement("p");
    //                 orderDate.className = "date";
    //                 orderDate.textContent = order.date;
    //
    //                 const orderQuantity = document.createElement("p");
    //                 orderQuantity.className = "quantity";
    //                 orderQuantity.textContent = `Date Submitted: ${order.Date}`;
    //
    //                 orderDateQuantity.appendChild(orderDate);
    //                 orderDateQuantity.appendChild(orderQuantity);
    //
    //                 orderInfo.appendChild(orderHeading);
    //                 orderInfo.appendChild(orderDateQuantity);
    //
    //                 const orderStatus = document.createElement("div");
    //                 const statusSpan = document.createElement("span");
    //                 statusSpan.className = "status";
    //                 statusSpan.textContent = order.OrderStatus;
    //                 orderStatus.appendChild(statusSpan);
    //
    //                 orderListItem.appendChild(orderInfo);
    //                 orderListItem.appendChild(orderStatus);
    //                 orderListItem.orderData = order; // Store the order object as a property on the element
    //
    //                 orderListElement.appendChild(orderListItem);
    //             });
    //
    //             addEventListenersToOrderListItems();
    //         });
    //
    // });

    function getOrderItems(orderID) {
        fetch('http://localhost/woodworks/public/supplier/getItemsByOrderID/' + orderID)
            .then(response => response.json())
            .then(data => {
                    console.log(data);
                    const orderItemListElement = document.getElementsByClassName("order-item-list")[0];
                    orderItemListElement.innerHTML = "";
                    data.items.forEach(item => {
                            console.log(item);
                            const row = document.createElement('tr');

                            const idCell = document.createElement('td');
                            idCell.textContent = item.ProductID;
                            row.appendChild(idCell);

                            const imageCell = document.createElement('td');
                            const image = document.createElement('img');
                            image.className = "img-thumbnail";
                            image.src = "<?=ROOT?>/" + item.image;
                            image.alt = '';
                            image.style.width = '100px';
                            image.style.height = '100px';
                            image.style.objectFit = 'cover';
                            imageCell.appendChild(image);
                            row.appendChild(imageCell);

                            const quantityCell = document.createElement('td');
                            quantityCell.textContent = item.Quantity;
                            row.appendChild(quantityCell);
                            orderItemListElement.appendChild(row);

                        }
                    )

                }
            );
    }


    function handleClick(itemId) {
        if (itemId === 'none') {
            document.getElementsByClassName('detail-box')[0].innerHTML = "<h1>No Order Selected</h1>"
            return;
        }
        //     update supply order detail
        document.getElementsByClassName('orderid-span')[0].innerHTML = itemId.OrderID;
        document.getElementsByClassName('comment-area')[0].innerHTML = itemId.Comments;
        document.getElementsByClassName('dateSent-span')[0].innerHTML = itemId.Date;
        document.getElementsByClassName('managerno-span')[0].value = itemId.ManagerID;
        document.getElementsByClassName('orderstatus')[0].innerHTML = itemId.OrderStatus;

        document.getElementById('accept').setAttribute('onclick', 'changeOrderStatus("' + itemId.OrderID + '", "Accepted")');
        document.getElementById('reject').setAttribute('onclick', 'openRejectedPopup("' + itemId.OrderID + '")');
        getOrderItems(itemId.OrderID);

    }

    function openRejectedPopup(orderID) {
        document.getElementsByClassName('popup-reject-comment')[0].style.display = 'block';
        document.getElementById('reject-btn').setAttribute('onclick', 'changeOrderStatus("' + orderID + '", "Rejected")');
    }

    function changeOrderStatus(orderID, status) {
        console.log(orderID);

        // send a reason in post request if the status is rejected

        if (status === 'Rejected') {
            const reason = document.getElementById('reason').value;
            console.log(reason);
            fetch('http://localhost/woodworks/public/supplier/changeOrderStatus/' + orderID + '/' + status, {
                method: 'POST',
                body: JSON.stringify({
                    reason: reason
                })
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    updateOrderList();
                });

        } else {
            fetch('http://localhost/woodworks/public/supplier/changeOrderStatus/' + orderID + '/' + status)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    updateOrderList();
                });
        }
        document.getElementsByClassName('popup-reject-comment')[0].style.display = 'none';

    }


</script>

</body>

</html>