<?php $this->view('cashier/includes/header') ?>
<div id="message-overlay">
    <p id="status-message"></p>
</div>
<div class="details-overlay" id="details-overlay">
    <div class="details-input">
        <h2>Enter customer details</h2>
        <hr>
        <div>
            <div>
                <input type="radio" id="existing" name="customer-type" value="existing" onclick="toggleCustomerForm()">
                <label for="existing">Existing Customer</label>
            </div>
            <div>
                <input type="radio" id="new" name="customer-type" value="new" onclick="toggleCustomerForm()">
                <label for="new">New Customer</label>
            </div>

        </div>
        <form style="display:none" id="new-customer-form" action="" method="POST">
            <div>
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
                <button type="button" onclick="closeNewBillPopup()" class="exit">Cancel</button>
            </div>
        </form>
        <form style="display:none" id="old-customer-form" action="" method="POST">
            <div>
                <label for="Email">E-Mail</label><br>
                <input type="email" id="contact" name="Email">
            </div>
            <div style="display:flex; grid-column-gap:10px;">
                <button type="submit" class="exit">Submit</button>
                <button type="button" onclick="closeNewBillPopup()" class="exit">Cancel</button>
            </div>
        </form>
    </div>
</div>
<script>
    function toggleCustomerForm() {
        var existing = document.getElementById("existing").checked;
        var customerForm = document.getElementById("new-customer-form");
        var emailForm = document.getElementById("old-customer-form");
        if (existing) {
            customerForm.style.display = "none";
            emailForm.style.display = "block";
        } else {
            customerForm.style.display = "block";
            emailForm.style.display = "none";
        }
    }
</script>
<div class="content pos-body">
    <div class="sec2">
        <div class="data" id="panel">

            <div>
                <button class="new-order-button" onclick="openNewBillPopup()">New Bill</button>
                <a href="<?= ROOT ?>/cashier/deleteCart"></a>
                <button class="clrbtn" onclick="resetForm()">Clear Bill</button>
            </div>
            <input type="text" name="search" placeholder="Search for a product" id="myInput" onkeyup="myFunction()">
            <table style="font-size:14px; text-align:right; align-items:center; justify-content:center;" id="myTable">

                <tbody style=" display:block; overflow:auto;">
                <?php foreach ($data['products'] as $product) : ?>
                    <tr>
                        <td class="col col-cost"><?= $product->ProductID ?></td>

                        <td class="col col-cost"><img style="width: 70px; border-radius:5px;"
                                                      src="<?= ROOT ?>/<?= $product->image ?>" alt=""></td>
                        <td class="col col-cost"> <?= $product->Name ?></td>
                        <!-- <td><?= $product->Quantity ?></td> -->
                        <td class="col col-cost" style="font-weight:600;">Rs. <?= $product->Cost ?></td>
                        <td class="col col-add" style="padding-right: 20px;"><a href=
                                                                                <?php if (isset($_SESSION["CustomerID"])) : ?>
                                                                                "<?= ROOT ?>/cashier/add_to_cart/<?= $product->ProductID ?>/<?= $product->Cost ?>"
                            <?php else : ?>
                                "#"
                            <?php endif; ?>
                            ><img style="width: 16px;" src="<?= ROOT ?>/assets/images/cashier/add.svg" alt=""></a>
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
        <?php if (!empty($data['cart'])) : ?>
            <table class="bill-table">
                <thead class="thead" style="display:table;width: 100%">
                <th class="headercol col-id">Product ID</th>
                <th class="headercol col-name">Product Name</th>
                <th class="headercol col-quantity">Quantity</th>
                <th class="headercol col-cost">Cost</th>
                <th class="headercol col-remove">Remove</th>
                </thead>
                <tbody style="width: 100%">
                <?php foreach ($data['cart'] as $cart) : ?>
                    <tr>
                        <td class="col-id">
                            <p><?= $cart->ProductID; ?></p>
                        </td>
                        <td class="col-name">
                            <p><?= $cart->Name; ?></p>
                        </td>
                        <td class="col-quantity">
                            <p><?= $cart->Quantity; ?></p>
                        </td>
                        <td class="col-cost">
                            <p><?= $cart->Cost * $cart->Quantity ?></p>
                        </td>
                        <td class="col-remove" style="text-align: center">
                            <a href="<?= ROOT ?>/cashier/removeItem/<?= $cart->CartID ?>/<?= $cart->ProductID ?>/<?= $cart->Cost ?>/<?= $cart->Quantity ?>"><img
                                        style="width: 16px;" src="<?= ROOT ?>/assets/images/cashier/x.svg" alt=""></a>

                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <div style="height:100%; width:100%;border:0.5px solid grey; margin-top:20px; margin-bottom:20px;border-radius:15px; display:flex; justify-content:center; align-items:center">
                <p style="color:white; font-size:20px">Cart is empty</p>
            </div>

        <?php endif ?>
        <div>
            <div class="all-prices">
                <div class="subprices">
                    <div class="subtotal_price">
                        <p>Subtotal </p>
                        <?php if (!empty($cart)) : ?>
                            <p>Rs. <?= $data['cart'][0]->Total_amount ?>.00</p>
                        <?php else : ?>
                            <p>Rs. 00.00</p>
                        <?php endif; ?>

                    </div>
                    <div class="discounts-view">
                        <p>Discounts
                            <!-- <button class="promo-code-button">Add Promo Code</button> -->
                        </p>
                        <p>Rs. 00.00</p>
                    </div>
                    <div class="shippingcost-view">
                        <p>Shipping
                            <!-- <button class="promo-code-button">Add Promo Code</button>   -->
                        </p>
                        <p>Rs. 00.00</p>
                    </div>
                    <hr width="100%">
                </div>
                <div class="total_price">
                    <p>Total</p>
                    <?php if (!empty($cart)) : ?>
                        <p>Rs. <?= $data['cart'][0]->Total_amount ?>.00</p>
                    <?php else : ?>
                        <p>Rs. 00.00</p>
                    <?php endif; ?>

                </div>
                <div>

                </div>

            </div>
            <div class="button">
                <button class="proceed" onclick="openPopup()">Proceed to Payment</button>
            </div>
        </div>


    </div>
</div>
<div class="blur" id="blur"></div>
<div class="payment" id="popup"
     style="display: flex; justify-content:center; align-items:center; flex-direction:column">
    <h3>Please choose payment method</h3>
    <div style="display:flex;">
        <a href="<?= ROOT ?>/cashier/checkout_cash">
            <div class="paybutton">Cash</div>
        </a>
        <a href="">
            <div class="paybutton">Card</div>
        </a>
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

        let popup1 = document.getElementById('popup');
        let popup2 = document.getElementById('blur');
        let popup3 = document.getElementById('details-overlay');

        let profile_card = document.querySelector('.admin-profile-card');
        let closeBtn = document.querySelector('.exit');

        function openPopup() {
            popup1.classList.add("open-popup");
            popup2.classList.add("open-popup");

        }

        function closePopup() {
            popup1.classList.remove("open-popup");
            popup2.classList.remove("open-popup");

        }

        function openNewBillPopup() {
            popup3.classList.add("open-popup");
            popup2.classList.add("open-popup");

        }

        function closeNewBillPopup() {
            popup3.classList.remove("open-popup");
            popup2.classList.remove("open-popup");

        }

        function resetForm() {
            document.getElementById("myForm").reset();
        }

        const form1 = document.getElementById('new-customer-form');
        const form2 = document.getElementById('old-customer-form');

        const clrbtn = document.querySelector('.clrbtn');


        //form1.addEventListener('submit', (e) => {
        //    e.preventDefault();
        //
        //    const formData = new FormData(form1);
        //
        //    fetch('<?php //= ROOT ?>///cashier/newcustomer', {
        //        method: 'POST',
        //        body: formData
        //    })
        //        .then(response => response.json())
        //        .then(data => {
        //            document.getElementById('message-overlay').style.top = '-100px';
        //            console.log(data);
        //            if (data.success) {
        //                document.getElementById('status-message').innerHTML = data.success;
        //                document.getElementById('message-overlay').style.top = '100px';
        //            } else {
        //                const overlay = document.getElementById('message-overlay');
        //                if (data.Email) {
        //                    const newParagraph1 = document.createElement('p');
        //                    newParagraph1.classList.add('EmailError');
        //                    newParagraph1.textContent = data.Email;
        //                    overlay.appendChild(newParagraph1);
        //
        //                    document.getElementById('message-overlay').style.top = '100px';
        //                    document.getElementById('message-overlay').style.backgroundColor = '#ffb1a8';
        //                }
        //                if (data.Firstname) {
        //                    const newParagraph2 = document.createElement('p');
        //                    newParagraph2.textContent = data.Firstname;
        //                    overlay.appendChild(newParagraph2);
        //                    document.getElementById('message-overlay').style.top = '100px';
        //                    document.getElementById('message-overlay').style.backgroundColor = '#ffb1a8';
        //                }
        //                if (data.Lastname) {
        //                    const newParagraph3 = document.createElement('p');
        //                    newParagraph3.textContent = data.Lastame;
        //                    overlay.appendChild(newParagraph3);
        //                    document.getElementById('message-overlay').style.top = '100px';
        //                    document.getElementById('message-overlay').style.backgroundColor = '#ffb1a8';
        //                }
        //                // if (data.Address) {
        //                //     document.getElementById('status-message').innerHTML += data.Address;
        //                //     document.getElementById('message-overlay').style.top = '100px';
        //                //     document.getElementById('message-overlay').style.backgroundColor = '#ffb1a8';
        //                // }
        //                if (data.Mobileno) {
        //                    const newParagraph3 = document.createElement('p');
        //                    newParagraph3.textContent = data.Mobileno;
        //                    overlay.appendChild(newParagraph3);
        //                    document.getElementById('message-overlay').style.top = '100px';
        //                    document.getElementById('message-overlay').style.backgroundColor = '#ffb1a8';
        //                }
        //            }
        //            setTimeout(function () {
        //                document.getElementById('message-overlay').style.top = '-100px';
        //            }, 4000);
        //
        //        })
        //        .catch(error => console.log(error));
        //
        //});
        //form2.addEventListener('submit', (e) => {
        //    e.preventDefault();
        //
        //    const formData = new FormData(form2);
        //
        //    fetch('<?php //= ROOT ?>///cashier/loadCustomer', {
        //        method: 'POST',
        //        body: formData
        //    })
        //        .then(response => response.json())
        //        .then(data => {
        //            document.getElementById('message-overlay').style.top = '-100px';
        //            console.log(data);
        //            if (data.success) {
        //                document.getElementById('status-message').innerHTML = data.success;
        //                document.getElementById('message-overlay').style.top = '100px';
        //            }
        //            setTimeout(function () {
        //                document.getElementById('message-overlay').style.top = '-100px';
        //            }, 4000);
        //
        //            location.reload()
        //
        //        })
        //        .catch(error => console.log(error));
        //
        //});
    </script>

    </html>