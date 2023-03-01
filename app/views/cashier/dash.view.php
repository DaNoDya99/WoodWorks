<?php $this->view('cashier/includes/header') ?>
<div id="message-overlay">
    <p id="status-message"></p>
</div>
<div class="content pos-body">
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
            <form style="display:none" id="new-customer-form" action="">
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
            <form style="display:none" id="old-customer-form" action="">
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

    <div class="sec2">

        <div>
            <button class="new-order-button" onclick="openNewBillPopup()">New Bill</button>
            <button class="clrbtn" onclick="resetForm()">Clear Bill</button>
        </div>
        <div class="data" id="panel">

            <input type="text" name="search" placeholder="Search for a product" id="myInput" onkeyup="myFunction()">

            <table class="pos-table" id="myTable">
                <thead class="thead">
                    <tr>
                        <th class="headercol col-id">Product ID</th>
                        <th class="headercol col-img">Image</th>
                        <th class="headercol col-name">Name</th>
                        <!-- <th>Quantity</th> -->
                        <th class="headercol col-cost">Cost</th>
                        <th class="headercol col-add">Add</th>
                    </tr>
                </thead>
                <tbody style=" display:block; overflow:auto;">
                    <?php foreach ($data['products'] as $product) : ?>
                        <tr>
                            <td class="col col-id"><?= $product->ProductID ?></td>

                            <td class="col col-img"><img style="width: 70px; border-radius:5px;" src="<?= ROOT ?>/<?= $product->image ?>" alt=""></td>
                            <td class="col col-name"> <?= $product->Name ?></td>
                            <!-- <td><?= $product->Quantity ?></td> -->
                            <td class="col col-cost" style="font-weight:600;">Rs. <?= $product->Cost ?></td>
                            <td class="col col-add" style="padding-right: 20px;"><a href="<?= ROOT ?>/cashier/add_to_cart/<?= $product->ProductID ?>"><img style="width: 16px;" src="<?= ROOT ?>/assets/images/cashier/add.svg" alt=""></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="sec3">
        <div class="panel2">
            <div class="info" style="padding:10px;width:100%; height:100px; background-color:#34524D; border-radius:10px; color:white;">
                <p>Customer ID:</p>
                <p>Customer Name:</p>
                <p>Order Number:</p>
            </div>

            <div style="height: 500px;">
                <?php if (!empty($data['cart'])) : ?>
                    <ul>
                        <?php foreach ($data['cart'] as $cart) : ?>
                            <li class="pos-item">
                                <div>
                                    <?= $cart->Name; ?><br>
                                    <small><?= $cart->ProductID; ?></small>
                                </div>
                                <div style="display:flex; justify-content:space-around;align-items:center;">
                                    <a href="<?= ROOT ?>/cashier/increaseQuantity/<?= $cart->CartID ?>/<?= $cart->ProductID ?>/<?= $cart->Quantity ?>/<?= $cart->Cost ?>"><img style="width: 16px;" src="<?= ROOT ?>/assets/images/cashier/add2.svg" alt=""></a>
                                    <input type="text" value="<?= $cart->Quantity ?>">
                                    <!-- <?= $cart->Quantity; ?> -->
                                    <a href="<?= ROOT ?>/cashier/decreaseQuantity/<?= $cart->CartID ?>/<?= $cart->ProductID ?>/<?= $cart->Quantity ?>/<?= $cart->Cost ?>"><img style="width: 16px;" src="<?= ROOT ?>/assets/images/cashier/minus.svg" alt=""></a>
                                    <p><?= $cart->Cost * $cart->Quantity ?></p>
                                </div>

                                <a href="<?= ROOT ?>/cashier/removeItem/<?= $cart->CartID ?>/<?= $cart->ProductID ?>/<?= $cart->Cost ?>/<?= $cart->Quantity ?>"><img style="width: 16px;" src="<?= ROOT ?>/assets/images/cashier/x.svg" alt=""></a>
                            </li>


                        <?php endforeach; ?>
                    </ul>
                <?php else : ?>
                    <p style="">Cart is empty</p>
                <?php endif ?>
            </div>
            <div class="total_price" style="position: absolute; right:25px; bottom:120px; font-size:30px ">
                <?php if (!empty($cart)) : ?>
                    <p>Rs. <?= $data['cart'][0]->Total_amount ?>.00</p>
                <?php else : ?>
                    <p>Rs. 00.00</p>
                <?php endif; ?>

            </div>

            <div class="button">
                <button class="proceed" onclick="openPopup()">Proceed to Payment</button>
            </div>

        </div>
    </div>
</div>
<div class="blur" id="blur"></div>
<div class="payment" id="popup" style="display: flex; justify-content:center; align-items:center; flex-direction:column">
    <h3>Please choose payment method</h3>
    <div style="display:flex;">
        <a href="<?= ROOT ?>/cashier/completebill">
            <div class="paybutton">Cash</div>
        </a>
        <a href="">
            <div class="paybutton">Card</div>
        </a>
    </div>

    <button onclick="closePopup()" class="exit">Cancel</button>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

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

    // fetch('/tasks')
    //     .then(response => response.json())
    //     .then(tasks => {
    //         // Render the list of tasks
    //         tasks.forEach(task => {
    //             const li = document.createElement('li');
    //             li.textContent = task.title;
    //             taskList.appendChild(li);
    //         });
    //     })
    //     .catch(error => console.error(error));

    // form.addEventListener('click', () => {


    //     const formData = new FormData(form);

    //     fetch('<?= ROOT ?>/cashier/test', {
    //             method: 'POST',
    //             body: formData
    //         })
    //         .then(data => data.json())
    //         .then(data => console.log(data))

    //         .catch(error => console.log(error));
    // });



    form1.addEventListener('submit', (e) => {
        e.preventDefault();

        const formData = new FormData(form1);

        fetch('<?= ROOT ?>/cashier/test', {
                method: 'POST',
                body: formData
            })


            .then(response => response.json())
            .then(data => {
                document.getElementById('message-overlay').style.top = '-100px';
                console.log(data);
                if (data.success) {
                    document.getElementById('status-message').innerHTML = data.success;
                    document.getElementById('message-overlay').style.top = '100px';
                } else {
                    const overlay = document.getElementById('message-overlay');
                    if (data.Email) {
                        const newParagraph1 = document.createElement('p');
                        newParagraph1.classList.add('EmailError');
                        newParagraph1.textContent = data.Email;
                        overlay.appendChild(newParagraph1);

                        document.getElementById('message-overlay').style.top = '100px';
                        document.getElementById('message-overlay').style.backgroundColor = '#ffb1a8';
                    }
                    if (data.Firstname) {
                        const newParagraph2 = document.createElement('p');
                        newParagraph2.textContent = data.Firstname;
                        overlay.appendChild(newParagraph2);
                        document.getElementById('message-overlay').style.top = '100px';
                        document.getElementById('message-overlay').style.backgroundColor = '#ffb1a8';
                    }
                    if (data.Lastname) {
                        const newParagraph3 = document.createElement('p');
                        newParagraph3.textContent = data.Lastame;
                        overlay.appendChild(newParagraph3);
                        document.getElementById('message-overlay').style.top = '100px';
                        document.getElementById('message-overlay').style.backgroundColor = '#ffb1a8';
                    }
                    // if (data.Address) {
                    //     document.getElementById('status-message').innerHTML += data.Address;
                    //     document.getElementById('message-overlay').style.top = '100px';
                    //     document.getElementById('message-overlay').style.backgroundColor = '#ffb1a8';
                    // }
                    if (data.Mobileno) {
                        const newParagraph3 = document.createElement('p');
                        newParagraph3.textContent = data.Mobileno;
                        overlay.appendChild(newParagraph3);
                        document.getElementById('message-overlay').style.top = '100px';
                        document.getElementById('message-overlay').style.backgroundColor = '#ffb1a8';
                    }
                }
                setTimeout(function() {
                    document.getElementById('message-overlay').style.top = '-100px';
                }, 4000);

            })
            .catch(error => console.log(error));

    });
    form2.addEventListener('submit', (e) => {
        e.preventDefault();

        const formData = new FormData(form2);

        fetch('<?= ROOT ?>/cashier/loadCustomer', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('message-overlay').style.top = '-100px';
                console.log(data);
                if (data.success) {
                    document.getElementById('status-message').innerHTML = data.success;
                    document.getElementById('message-overlay').style.top = '100px';
                }
                setTimeout(function() {
                    document.getElementById('message-overlay').style.top = '-100px';
                }, 4000);

            })
            .catch(error => console.log(error));

    });
</script>

</html>