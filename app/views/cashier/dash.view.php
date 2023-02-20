<?php $this->view('cashier/includes/header') ?>
<div class="content pos-body">
    <div class="sec2">
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
            <h3 style="margin-bottom:40px ;">
                Orders
            </h3>

            <div style="height: 500px;">
                <?php if (!empty($data['cart'])) : ?>
                    <ul>
                        <?php foreach ($data['cart'] as $cart) : ?>
                            <li class="pos-item">
                                <div>
                                    <?= $cart->Name; ?><br>
                                    <small><?= $cart->ProductID; ?></small>
                                </div>
                                <div style="display:flex; justify-content:center;align-items:center;">
                                    <a href="<?= ROOT ?>/cashier/increaseQuantity/<?= $cart->CartID ?>/<?= $cart->ProductID ?>/<?= $cart->Quantity ?>/<?= $cart->Cost ?>"><img style="width: 16px;" src="<?= ROOT ?>/assets/images/cashier/add2.svg" alt=""></a>
                                    <input type="text" value="<?= $cart->Quantity ?>">
                                    <!-- <?= $cart->Quantity; ?> -->
                                    <a href="<?= ROOT ?>/cashier/decreaseQuantity/<?= $cart->CartID ?>/<?= $cart->ProductID ?>/<?= $cart->Quantity ?>/<?= $cart->Cost ?>"><img style="width: 16px;" src="<?= ROOT ?>/assets/images/cashier/minus.svg" alt=""></a>

                                </div>
                                <a href="<?= ROOT ?>/cashier/removeItem/<?= $cart->CartID ?>/<?= $cart->ProductID ?>/<?= $cart->Cost ?>/<?= $cart->Quantity ?>">X</a>
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
</script>

</html>