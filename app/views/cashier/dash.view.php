<?php $this->view('cashier/includes/header') ?>

<?php if (!isset($_SESSION['CustomerDetails'])) : ?>
    <div id="customer-details">

        <div class="customer-type-overlay">
            <h2>Customer Details</h2>
            <div id="btns">
                <button class="customer-btn" onclick="newcustflow()">New Customer</button>
                <button class="customer-btn" onclick="oldcustflow()">Returning Customer</button>
            </div>
            <div class="old-cust-form" style="padding: 40px">
                <div class="back-btn" style="width: 100%; margin-bottom: 30px" onclick="closecustomertypepop()">
                    Back
                </div>
                <form id="old-customer-form" action="" method="POST">

                    <div>
                        <input type="hidden" name="type" value="oldcust">

                        <label for="Email">E-Mail</label><br>
                        <input type="email" id="contact" name="Email">

                        <div style="display:none;" class="error-box">
                            <small id="error">Customer not found. Try Again</small>
                        </div>
                        <div style="display:none;" class="ok-box">
                            <small id="error">Customer Found</small>
                        </div>

                    </div>
                    <div style="display:flex; grid-column-gap:10px;">
                        <button type="submit" id="old-cust-submit">Submit</button>
                    </div>
                </form>
            </div>
            <div class="new-cust-form" style="padding: 40px">
                <div class="back-btn" style="width: 100%; margin-bottom: 30px" onclick="closecustomertypepop()">
                    Back
                </div>
                <form id="new-customer-form" action="" method="POST">
                    <div>
                        <input type="hidden" name="type" value="newcust">
                        <label for="Firstname">First Name</label>
                        <input type="text" id="name" name="Firstname">
                        <label for="Lastname">Last Name</label>
                        <input type="text" id="name" name="Lastname">
                        <label for="Email">E-Mail</label>
                        <input type="email" id="contact" name="Email">
                        <label for="contact">Contact Number</label>
                        <input type="tel" id="contact" name="contact">
                    </div>
                    <div>
                        <label for="address">Address</label><br>
                        <textarea type="textarea" id="address" height="200px" name="Address"></textarea>
                    </div>
                    <div style="display:flex; grid-column-gap:10px;">
                        <button type="submit" class="exit">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script>
        function oldcustflow() {
            document.getElementById("btns").style.display = "none";
            document.getElementsByClassName("old-cust-form")[0].style.display = "flex";
        }

        function newcustflow() {
            document.getElementById("btns").style.display = "none";
            document.getElementsByClassName("new-cust-form")[0].style.display = "flex";
        }

        function closecustomertypepop() {
            if (document.getElementsByClassName("old-cust-form")[0].style.display === "flex") {
                document.getElementsByClassName("old-cust-form")[0].style.display = "none";
                document.getElementById("btns").style.display = "flex";
            } else if (document.getElementsByClassName("new-cust-form")[0].style.display === "flex") {
                document.getElementsByClassName("new-cust-form")[0].style.display = "none";
                document.getElementById("btns").style.display = "flex";
            }


        }
    </script>

<?php endif; ?>


<div class="content pos-body">
    <div class="sec2">
        <div class="data" id="panel">


            <input type="text" name="search" placeholder="Search for a product" id="myInput" onkeyup="myFunction()">
            <table style="font-size:14px; text-align:right; align-items:center; justify-content:center;" id="myTable">

                <tbody style=" display:block; overflow:auto;">
                <?php foreach ($data['products'] as $product) : ?>
                    <tr>
                        <td class="col col-cost"><?= $product->ProductID ?></td>
                        <td class="col col-cost"><img style="width: 70px; border-radius:5px;"
                                                      src="<?= ROOT ?>/<?= $product->image ?>" alt=""></td>
                        <td class="col col-cost"> <?= $product->Name ?></td>

                        <td class="col col-cost" style="font-weight:600;">Rs. <?= $product->Cost ?></td>
                        <td class="col col-cost"
                            style="font-weight:100; color:red;font-style:italic"><?= $product->Discount_percentage ?>%
                        </td>
                        <td class="col col-add" style="padding-right: 20px;"><img style="width: 16px;"
                                                                                  src="<?= ROOT ?>/assets/images/cashier/add.svg"
                                                                                  alt="" <?php if (isset($_SESSION["CustomerID"])) : ?>
                                                                                  onclick="quantitypopup('<?= ROOT ?>/<?= $product->image ?>','<?= $product->Name ?>','<?= $product->ProductID ?>','<?= $product->Cost - $product->Cost * $product->Discount_percentage / 100 ?>')" <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
    <div class="panel2">
        <div class="info"
             style="padding:10px;width:100%; height:100px; background-color:#34524D; border-radius:10px; color:white;">
            <?php if (isset($_SESSION["CustomerID"])) : ?>
                <P>Customer ID: <?= substr($_SESSION["CustomerDetails"][0]->CustomerID, 0, 10) ?> </P>
                <P>Customer
                    Name: <?= $_SESSION["CustomerDetails"][0]->Firstname . " " . $_SESSION["CustomerDetails"][0]->Lastname ?></P>
                <P>Customer Email: <?= $_SESSION["CustomerDetails"][0]->Email ?></P>

                <a href="<?= ROOT ?>/cashier/resetCustomer">Remove Customer</a>
            <?php else : ?>
                <h3>No bill selected. Please Create a Bill</h3>
            <?php endif; ?>
        </div>

        <table id="bill-table" class="bill-table">
            <thead class="thead" style="display:table;width: 100%">
            <th class="">Product ID</th>
            <th class="">Product Name</th>
            <th class="">Quantity</th>
            <th class="">Unit Price</th>

            <th>Total</th>
            <th class=""><img style="width: 15px" src="<?= ROOT ?>/assets/images/cashier/trash-solid.svg" alt=""></th>
            </thead>

        </table>

        <div id="empty-cart-message"
             style="height:100%; width:100%;border:0.5px solid grey; margin-top:20px; margin-bottom:20px;border-radius:15px; display:flex; justify-content:center; align-items:center">
            <p style="color:white; font-size:20px">Cart is empty</p>
        </div>
        <div>
            <div class="all-prices">
                <div class="subprices">
                    <div class="subtotal_price">
                        <p>Subtotal </p>

                        <p id="subtotal-value">0</p>


                    </div>
                    <!-- <div class="discounts-view">
                        <div id="openDiscounts" style="border: 0.1px solid grey; padding: 5px; border-radius: 5px; display: flex; flex-direction: row" onclick="discountPopup()">
                            <p>Discounts</p>
                            <img src="<?= ROOT ?>/assets/images/cashier/angle-right-solid.svg" alt="" style="width: 15px; height: 15px; margin-top: 3px; margin-left: 5px;">
                        </div>

                        <p onclick="discountpopup()" style="">00.00</p>
                    </div> -->
                    <div class="shippingcost-view">
                        <div
                            style="border: 0.1px solid grey; padding: 5px; border-radius: 5px; display: flex; flex-direction: row">
                            <p>Shipping</p>
                            <img src="<?= ROOT ?>/assets/images/cashier/angle-right-solid.svg" alt=""
                                 style="width: 15px; height: 15px; margin-top: 3px; margin-left: 5px;"
                                 onclick="shippingpopup()">
                        </div>
                        <p id="shippingcost-value">00.00</p>

                    </div>
                    <hr width="100%">
                </div>
                <div class="total_price">
                    <p>Total</p>
                    <span id="final_total"></span>

                </div>
                <div>

                </div>

            </div>
            <div class="button">
                <button class="proceed" onclick="openPaymentPopup('<?= $_SESSION['OrderID'] ?>')">Proceed to Payment</button>
            </div>
        </div>


    </div>
    <div id="blur-quantity">
        <div
            style="display:flex; flex-direction:column; justify-content:center; position: absolute; height:auto; width:50%; z-index:99; padding:20px; background-color:white; box-shadow:0px 0px 15px black; border-radius:10px"
            id="quantitypopup">
            <div style="display:flex; justify-content:space-between;">
                <h3>Add Item</h3>
                <p onclick="closequantitypopup()">&times;</p>
            </div>

            <div class="item-info">
                <img id='furniture-image' src="" alt="furn">

                <div class="deets">
                    <div class="name">
                        <h3 id="furniture-name">Furniture</h3>
                        <p id="furniture-id">F0001</p>
                    </div>
                    <div class="quantity-box">

                        <button class="quantity-change" id="decrement">-</button>
                        <input type="text" id="quantity" class="quantity-input" value="1" min="1">
                        <button class="quantity-change" id="increment">+</button>
                    </div>

                </div>

            </div>
            <button type="button" class="add-quantity">Add</button>

        </div>
    </div>

</div>
<script>
    document.getElementById('increment').addEventListener('click', function () {
        let quantity = document.getElementById('quantity');
        quantity.value = parseInt(quantity.value) + 1;
    });

    document.getElementById('decrement').addEventListener('click', function () {
        let quantity = document.getElementById('quantity');
        let currentValue = parseInt(quantity.value);
        if (currentValue > 1) {
            quantity.value = currentValue - 1;
        }

    });
    document.getElementById('quantity').addEventListener('input', function () {
        if (this.value === '') {
            this.value = '0';
        }
    });
</script>

<div class="blur" id="blur-payment">
    <div class="payment" id="popup2"
         style="display: flex; justify-content:center; align-items:center; flex-direction:column">
        <span class="exit-payment">&times;</span>
        <h3>Please choose payment method</h3>

        <div class="transaction-info">
            <table style="width:60%;">
                <tr>
                    <td>Order ID:</td>
                    <td style="text-align:right;"><span id="popup-orderid"></span></td>
                </tr>

                <tr>
                    <td>Number of items:</td>
                    <td style="text-align:right;"><span id="popup-quanitity"></span></td>
                </tr>
                <tr>
                    <td>Total Amount:</td>
                    <td style="text-align:right;"><span id="total"></span></td>
                </tr>


            </table>


        </div>
        <div style="display:flex;">
            <a href="<?= ROOT ?>/cashier/checkout_cash">
                <div class="paybutton">Cash</div>
            </a>

            <div class="paybutton" onclick="checkout('<?= $_SESSION['OrderID'] ?>')">Card</div>

        </div>
    </div>
</div>


<script>
    let popup1 = document.getElementById('popup');
    let popup2 = document.getElementById('blur-payment');
    let popup3 = document.getElementById('details-overlay');

    let profile_card = document.querySelector('.admin-profile-card');
    let closeBtn = document.querySelector('.exit');

    function openPopup() {
        popup1.classList.add("open-popup");
        popup2.classList.add("open-popup");

    }

    function openPaymentPopup(id) {

        popup2.classList.add("open-popup");
        fetch("http://localhost/WoodWorks/public/cashier/getOrderSummary/"+id)
            .then(response => response.json())
            .then(data => {
                console.log(data);

                document.getElementById('popup-orderid').innerText = id;
                document.getElementById('popup-quanitity').innerText = data.OrderCount;
                document.getElementById('total').innerText = "Rs. " + data.Total;
            });

    }

    function closePopup() {
        popup1.classList.remove("open-popup");
        popup2.classList.remove("open-popup");

    }

    window.onload = function () {
        makeTable();
        getCartTotal();
        getFinalTotal();
    }

    function checkcustomerloaded() {
        fetch('<?= ROOT ?>/cashier/iscustomerset', {
            method: 'POST',

        }).then(response => response.json())
            .then(data => {
                // console.log(data);
                if (data.status === 'true') {
                    // console.log(data);
                    return true;

                } else if (data.status === 'false') {
                    return false;
                }
            })
    }

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

    function quantitypopup(img, name, id, cost,) {

        document.getElementById("blur-quantity").style.display = "flex";

        document.getElementById("furniture-name").innerHTML = name;
        document.getElementById("furniture-id").innerHTML = id;
        document.getElementById("furniture-image").src = img;

        //setbutton onclick to addtocart

        document.getElementsByClassName("add-quantity")[0].setAttribute("onclick", "addtocart('" + id + "','" + cost + "')");

    }

    function closequantitypopup() {

        document.getElementById("blur-quantity").style.display = "none";
        //enable visibility

    }


    function checkout(orderid) {
        //using vanilla js using fetch
        fetch('<?= ROOT ?>/cashier/checkout_card/' + orderid, {
            method: 'POST',
            body: JSON.stringify({
                orderid: orderid
            }),
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(response => {
            if (response.status === 200) {
                return response.text(); // or response.text() if the data is plain text
            } else {
                throw new Error('Network response was not OK.');
            }
        })
            .then(data => {
                // Do something with the data
                console.log(data);
                data = JSON.parse(data);
                window.location.href = data;
            })
            .catch(error => {
                // Handle fetch error
                console.log(error);
            });
    }

    const form = document.querySelector('#old-customer-form');

    <?php if (!isset($_SESSION['CustomerDetails'])) : ?>
    form.addEventListener('submit', (event) => {

        // Prevent the default form submission behavior
        event.preventDefault();
        document.querySelector('.error-box').style.display = 'none';

        // Get the form data
        const formData = new FormData(form);

        // Send the form data to the backend using Fetch
        fetch('<?= ROOT ?>/cashier/oldcust', {
            method: 'POST',
            body: formData
        })
            .then(response => {
                // Parse the response as JSON
                return response.json();
            })

            .then(data => {
                console.log(data);
                if (data.status === 'success') {
                    document.querySelector('.ok-box').style.display = 'block';
                    document.querySelector('#old-cust-submit').innerHTML = 'Please wait...';

                    setTimeout(function () {
                        window.location.reload();
                    }, 3000);
                } else {
                    document.querySelector('.error-box').style.display = 'block';


                }

                // Do something with the data


            })
            .catch(error => {
                // Handle any errors that occurred during the request
                console.error('Error submitting form:', error);
            });
    });
    <?php endif; ?>

    function addtocart(id, cost) {
        console.log(id);
        let quantity = document.getElementsByClassName('quantity-input')[0].value;
        console.log(quantity);
        console.log(id);
        console.log(cost);
        fetch('<?= ROOT ?>/cashier/add_to_cart/' + id + '/' + cost + '/' + quantity, {

            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(response => {
            return response.json();

        })
            .then(data => {
                console.log(data);
                if (data.status === 'fail') {
                    errormsg();
                }

                makeTable();
                getCartTotal();
                getFinalTotal();

            })
            .catch(error => {
                console.error("Error fetching cart data:", error);
            });


        document.getElementById('blur-quantity').style.display = 'none';
    }

    // Get the table element
    // Get the table element
    function makeTable() {

        const table = document.querySelector("#bill-table");
        // console.log(table);
        // Create the tbody element
        const tbody = document.createElement("tbody");
        //if tbody exists remove it


        // Fetch the cart data from the server
        fetch("<?= ROOT ?>/cashier/getcartitems", {
            method: "GET",
            headers: {
                "Content-Type": "application/json"
            }
        })

            .then(response => response.json())
            .then(data => {
                console.log(data);
                // Loop through the cart data and create a new row for each item
                console.log(data);
                if (data.cart === false) {
                    document.getElementById('empty-cart-message').style.display = 'flex';
                    document.getElementById('bill-table').style.display = 'none';

                    document.getElementsByClassName('proceed')[0].setAttribute('disabled', 'true');
                    document.getElementsByClassName('proceed')[0].style.backgroundColor = 'grey';


                } else {
                    document.getElementsByClassName('proceed')[0].removeAttribute('disabled');
                    document.getElementsByClassName('proceed')[0].style.backgroundColor = '#008f37';
                    document.getElementById('bill-table').style.display = 'block';
                    document.getElementById('empty-cart-message').style.display = 'none';

                    data.cart.forEach(cart => {
                        // Create a new table row element
                        const row = document.createElement("tr");

                        // Create the columns for the row
                        const idColumn = document.createElement("td");
                        const nameColumn = document.createElement("td");
                        const quantityColumn = document.createElement("td");
                        const costColumn = document.createElement("td");
                        const totalColumn = document.createElement("td");
                        const removeColumn = document.createElement("td");

                        // Set the values for each column
                        idColumn.textContent = cart.ProductID;
                        nameColumn.textContent = cart.Name;
                        quantityColumn.textContent = cart.Quantity;
                        costColumn.textContent = cart.Cost;
                        totalColumn.textContent = cart.Cost * cart.Quantity;

                        // Create a link to remove the item
                        //class remove item
                        const removeLink = document.createElement("a");


                        const removeIcon = document.createElement("img");
                        removeIcon.classList.add("remove-item-icon");
                        removeIcon.src = `<?= ROOT ?>/assets/images/cashier/x.svg`;
                        removeIcon.alt = "";
                        removeIcon.onclick = function () {
                            removeitem(cart.ProductID, cart.Cost, cart.Quantity);
                            makeTable();
                        };
                        removeLink.appendChild(removeIcon);
                        removeColumn.appendChild(removeLink);

                        // Add the columns to the row
                        row.appendChild(idColumn);
                        row.appendChild(nameColumn);
                        row.appendChild(quantityColumn);
                        row.appendChild(costColumn);
                        row.appendChild(totalColumn);
                        row.appendChild(removeColumn);

                        // Add the row to the tbody element
                        tbody.appendChild(row);

                    });

                    // Add the tbody element to the table
                    // table.querySelector("tbody").remove();
                    if (document.querySelector("#bill-table tbody")) {
                        document.querySelector("#bill-table tbody").remove();
                    }
                    table.appendChild(tbody);
                }
            })
            .catch(error => {
                console.error("Error fetching cart data:", error);
            });
    }

    function getCartTotal() {
        // Fetch the cart data from the server

        fetch("<?= ROOT ?>/cashier/getcarttotal", {
            method: "GET",
            headers: {
                "Content-Type": "application/json"
            }
        })

            .then(response => response.json())
            .then(data => {
                document.querySelector("#subtotal-value").innerHTML = data.total || 0;
            })
            .catch(error => {
                console.error("Error fetching cart data:", error);
            });


    }

    function getFinalTotal() {

        fetch("<?= ROOT ?>/cashier/updateFinalTotal")
            .then(response => {
                return response.json()
            })
            .then(data => {
                console.log(data);
                document.getElementById('final_total').innerHTML = data;
            })
    }

    function removeitem(productid, cost, quantity) {
        fetch('<?= ROOT ?>/cashier/removeitem/' + productid + '/' + cost + '/' + quantity, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(response => {
            return response.text();

        })
            .then(data => {
                console.log(data);
                makeTable();
                getCartTotal()
                getFinalTotal();


            })
    }

    function errormsg() {

        const popup = document.getElementById('tpopup');
        const indicator = document.getElementById('indicator');
        indicator.style.width = '0%';

        const displayDuration = 4000; // Duration to display the popup in milliseconds (5 seconds)

        // Display the popup
        popup.style.opacity = '1';
        indicator.style.transition = 'none';
        document.getElementsByClassName('popup-message')[0].innerHTML = 'Item is out of stock';

        // Animate the indicator
        setTimeout(() => {
            indicator.style.transition = `width ${displayDuration}ms linear`;
            indicator.style.width = '100%';
        }, 100); // Small delay to ensure that the indicator transition works correctly

        // Hide the popup after the displayDuration has passed
        setTimeout(() => {
            popup.style.opacity = '0';
        }, displayDuration);
    }

    function discountPopup() {
        document.getElementsByClassName('discount-popup')[0].style.display = 'flex';
        document.getElementById('blur').style.display = 'block';

        // exit if blur is clicked
        document.getElementById('blur').addEventListener('click', function () {
            document.getElementsByClassName('discount-popup')[0].style.display = 'none';
            document.getElementById('blur').style.display = 'none';
        });
    }
</script>
</body>

</html>