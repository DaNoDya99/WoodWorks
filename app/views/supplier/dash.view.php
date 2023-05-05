<?php $this->view('supplier/includes/header') ?>
<div class="inventory-body content">
    <div class="sec2">
        <div class="order-section">
            <h3>Restocking Orders</h3>
            <br>
            <div style="display: flex; flex-direction: row; column-gap: 20px">
                <div style="width: 30%; display: block"><label>Sort Date by:</label>
                    <select name="order-status" id="order-status">
                        <option value="descending">Descending</option>
                        <option value="ascending">Ascending</option>
                    </select>
                </div>
                <div>
                    <label for="">Date Range:</label><br><br>
                    <div id="date-range" class="dropdown date-range dashboard" onclick="toggleDropdown()">
                        <p id="date-range-label">Select</p><img id="dropdown-icon"
                                                                src="<?= ROOT ?>/assets/images/manager/chevron-down-solid.svg"
                                                                alt="">

                        <div id="date-overlay" class="dropdown-content2 date-overlay ">
                            <p>Select Range </p>
                            <a class="closebtn" onclick="toggleDropdown()"><img style="height:20px"
                                                                                src="<?= ROOT ?>/assets/images/manager/xmark-solid.svg"
                                                                                alt=""></a>
                            <form id="form" action="">
                                <label for="date1">From</label>
                                <input name="date1" type="date" value="<?php echo date('Y-m-01'); ?>">
                                <label for="date2">To</label>
                                <input name="date2" type="date" value="<?php echo date('Y-m-d'); ?>">
                                <br><br>
                                <div class="submit-reset-buttons">
                                    <input type="submit" value="Submit">
                                    <input type="reset" value="Reset">
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>


            <div class="order-list">
                <div class="order-list-item" id="item0">
                    <div>
                        <h4><span>#123456</span> - <span>P0001</span> - <span> Furniture Name 1</span></h4>
                        <div style="display: flex;position: sticky; column-gap: 20px; margin-top: 10px">
                            <p style="color: #4d4d4d">12/12/2023</p>
                            <!--                            <p style="color: #4d4d4d">Quantity : 45</p>-->
                        </div>
                    </div>
                    <div>
                        <span style="color: #885000;background-color: #ffae35; padding: 5px 10px; border-radius: 5px;">
                            PENDING
                        </span>

                    </div>
                </div>
                <div class="order-list-item" id="item0">
                    <div>
                        <h4><span>#123456</span> - <span>P0001</span> - <span> Furniture Name 1</span></h4>
                        <div style="display: flex; column-gap: 20px; margin-top: 10px">
                            <p style="color: #4d4d4d">12/12/2023</p>
                            <p style="color: #4d4d4d">Quantity : 45</p>
                        </div>
                    </div>
                    <div>
                        <span style="background-color: #ffae35; padding: 5px 10px; border-radius: 5px;">
                            Pending
                        </span>

                    </div>
                </div>
                <div class="order-list-item" id="item0">
                    <div>
                        <h4><span>#123456</span> - <span>P0001</span> - <span> Furniture Name 1</span></h4>
                        <div style="display: flex; column-gap: 20px; margin-top: 10px">
                            <p style="color: #4d4d4d">12/12/2023</p>
                            <p style="color: #4d4d4d">Quantity : 45</p>
                        </div>
                    </div>
                    <div>
                        <span style="background-color: #ffae35; padding: 5px 10px; border-radius: 5px;">
                            Pending
                        </span>

                    </div>
                </div>
                <div class="order-list-item" id="item0">
                    <div>
                        <h4><span>#123456</span> - <span>P0001</span> - <span> Furniture Name 1</span></h4>
                        <div style="display: flex; column-gap: 20px; margin-top: 10px">
                            <p style="color: #4d4d4d">12/12/2023</p>
                            <p style="color: #4d4d4d">Quantity : 45</p>
                        </div>
                    </div>
                    <div>
                        <span style="background-color: #ffae35; padding: 5px 10px; border-radius: 5px;">
                            Pending
                        </span>

                    </div>
                </div>
                <div class="order-list-item" id="item0">
                    <div>
                        <h4><span>#123456</span> - <span>P0001</span> - <span> Furniture Name 1</span></h4>
                        <div style="display: flex; column-gap: 20px; margin-top: 10px">
                            <p style="color: #4d4d4d">12/12/2023</p>
                            <p style="color: #4d4d4d">Quantity : 45</p>
                        </div>
                    </div>
                    <div>
                        <span style="background-color: #ffae35; padding: 5px 10px; border-radius: 5px;">
                            Pending
                        </span>

                    </div>
                </div>
                <div class="order-list-item" id="item0">
                    <div>
                        <h4><span>#123456</span> - <span>P0001</span> - <span> Furniture Name 1</span></h4>
                        <div style="display: flex; column-gap: 20px; margin-top: 10px">
                            <p style="color: #4d4d4d">12/12/2023</p>
                            <p style="color: #4d4d4d">Quantity : 45</p>
                        </div>
                    </div>
                    <div>
                        <span style="background-color: #ffae35; padding: 5px 10px; border-radius: 5px;">
                            Pending
                        </span>

                    </div>
                </div>
                <div class="order-list-item" id="item0">
                    <div>
                        <h4><span>#123456</span> - <span>P0001</span> - <span> Furniture Name 1</span></h4>
                        <div style="display: flex; column-gap: 20px; margin-top: 10px">
                            <p style="color: #4d4d4d">12/12/2023</p>
                            <p style="color: #4d4d4d">Quantity : 45</p>
                        </div>
                    </div>
                    <div>
                        <span style="background-color: #ffae35; padding: 5px 10px; border-radius: 5px;">
                            Pending
                        </span>

                    </div>
                </div>
                <div class="order-list-item" id="item0">
                    <div>
                        <h4><span>#123456</span> - <span>P0001</span> - <span> Furniture Name 1</span></h4>
                        <div style="display: flex; column-gap: 20px; margin-top: 10px">
                            <p style="color: #4d4d4d">12/12/2023</p>
                            <p style="color: #4d4d4d">Quantity : 45</p>
                        </div>
                    </div>
                    <div>
                        <span style="background-color: #ffae35; padding: 5px 10px; border-radius: 5px;">
                            Pending
                        </span>

                    </div>
                </div>
                <div class="order-list-item" id="item0">
                    <div>
                        <h4><span>#123456</span> - <span>P0001</span> - <span> Furniture Name 1</span></h4>
                        <div style="display: flex; column-gap: 20px; margin-top: 10px">
                            <p style="color: #4d4d4d">12/12/2023</p>
                            <p style="color: #4d4d4d">Quantity : 45</p>
                        </div>
                    </div>
                    <div>
                        <span style="background-color: #ffae35; padding: 5px 10px; border-radius: 5px;">
                            Pending
                        </span>

                    </div>
                </div>
                <div class="order-list-item" id="item0">
                    <div>
                        <h4><span>#123456</span> - <span>P0001</span> - <span> Furniture Name 1</span></h4>
                        <div style="display: flex; column-gap: 20px; margin-top: 10px">
                            <p style="color: #4d4d4d">12/12/2023</p>
                            <p style="color: #4d4d4d">Quantity : 45</p>
                        </div>
                    </div>
                    <div>
                        <span style="background-color: #ffae35; padding: 5px 10px; border-radius: 5px;">
                            Pending
                        </span>

                    </div>
                </div>
            </div>
        </div>
        <div class="supply-order-detail">
            <div class="detail-box">
                <div style="display: flex; justify-content: space-between">
                    <h2>Order Details - <span style="color:#3b3b3b">#123456</span></h2>
                    <span style="background-color: #ffae35; padding: 5px 10px; border-radius: 5px;">
                            Pending
                        </span>
                </div>

                <div style="display: flex; flex-direction: column; height: 100%">
                    <div style="height: 30%; display: flex; flex-direction: column; margin-top: 30px;">
                        <div>
                            <span>Sent by:</span><span>M0001</span>
                        </div>
                        <div>
                            <span>Date Order Sent:</span><span>M0001</span>
                        </div>
                        <div>
                            <span>Date Order Order Needed:</span><span>M0001</span>
                        </div>
                        <span>Comment:</span>
                        <textarea style="border-radius: 5px; padding: 5px; background-color: #e5e5e5" rows="4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.</textarea>
                    </div>
                    Order-Description
                    <div style="height: 60%; overflow: scroll">

                        <table style="width: 100%; margin-top: 20px;">
                            <thead style="position: sticky; top: 0; background-color: white; text-align: center">
                            <tr>
                                <th>Product ID</th>
                                <th>Image</th>
                                <th>Category</th>
                                <th>Quantity</th>
                            </tr>
                            </thead>
                            <tbody style="text-align: center">
                            <tr>
                                <td>P0001</td>
                                <td><img src="http://localhost/woodworks/public/images/1.jpg" alt=""
                                         style="width: 100px; height: 100px; object-fit: cover"></td>
                                <td>Chair</td>
                                <td>12</td>
                            </tr>
                            <tr>
                                <td>P0001</td>
                                <td><img src="http://localhost/woodworks/public/images/1.jpg" alt=""
                                         style="width: 100px; height: 100px; object-fit: cover"></td>
                                <td>Chair</td>
                                <td>12</td>
                            </tr>
                            <tr>
                                <td>P0001</td>
                                <td><img src="http://localhost/woodworks/public/images/1.jpg" alt=""
                                         style="width: 100px; height: 100px; object-fit: cover"></td>
                                <td>Chair</td>
                                <td>12</td>
                            </tr>
                            <tr>
                                <td>P0001</td>
                                <td><img src="http://localhost/woodworks/public/images/1.jpg" alt=""
                                         style="width: 100px; height: 100px; object-fit: cover"></td>
                                <td>Chair</td>
                                <td>12</td>
                            </tr>
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function handleClick(itemId) {
        console.log('Clicked item:', itemId);
    }

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

                handleClick(itemId); // Call the function with the item id as a parameter
                item.classList.toggle('selected');
            });
        });
    }

    //
    // document.addEventListener('DOMContentLoaded', function () {
    //     fetch('http://localhost/woodworks/public/supplier/getneworders')
    //         .then(response => response.json())
    //         .then(data => {
    //             const orderList = document.createElement('div');
    //             orderList.classList.add('order-list');
    //
    //             data['neworders'].forEach((orderData, index) => {
    //                 const orderListItem = document.createElement('div');
    //                 orderListItem.classList.add('order-list-item');
    //                 orderListItem.id = `item${index}`;
    //
    //                 const orderHeading = document.createElement('h4');
    //                 orderHeading.innerHTML = `<span>#${orderData.OrderID}</span> - <span>${orderData.ProductID}</span> - <span>Order ${index + 1}</span>`;
    //                 orderListItem.appendChild(orderHeading);
    //
    //                 const orderDescription = document.createElement('p');
    //                 orderDescription.textContent = `Order Status: ${orderData.OrderStatus}, Manager ID: ${orderData.ManagerID}, Quantity: ${orderData.Quantity}, Comments: ${orderData.Comments}`;
    //                 orderListItem.appendChild(orderDescription);
    //
    //                 orderList.appendChild(orderListItem);
    //
    //             });
    //
    //             // Append the generated order list to the appropriate container in your HTML
    //             const container = document.querySelector('.order-list');
    //             container.appendChild(orderList);
    //             addEventListenersToOrderListItems();
    //
    //         });
    //
    // });


    function handleClick(itemId) {
        console.log('Clicked item:', itemId);
    }

    function toggleDropdown() {
        var dropdownContent = document.querySelector(".dropdown-content2");
        var dropdownArrow = document.querySelector("#dropdown-icon");
        dropdownContent.classList.toggle("show");
        dropdownArrow.classList.toggle("rotate");

    }

    var dropdownContent = document.querySelector(".dropdown-content2");

    dropdownContent.onclick = function (event) {
        event.stopPropagation();
    }
    window.onclick = function (event) {
        if (!event.target.matches('.dropdown') && !event.target.matches('.dropdown *')) {
            var dropdownContent = document.querySelector(".dropdown-content2");
            if (dropdownContent.classList.contains('show')) {
                dropdownContent.classList.remove('show');
            }
        }
    }
</script>

</body>

</html>