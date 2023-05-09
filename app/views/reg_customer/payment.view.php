<?php $data['row'] = $row; $this->view('reg_customer/includes/header',$data); ?>

<div class="payment-container">
    <div class="payment-item-details">
        <div class="payment-items">
            <table>
                <?php if(!empty($items)) : ?>

                    <?php foreach($items as $item): ?>

                        <tr>
                            <td><img src="<?=ROOT?>/<?=$item->Image?>" alt=""></td>
                            <td><?=$item->Name?></td>
                            <td><?=$item->Quantity?></td>
                            <td>Rs. <?=$item->Cost?>.00</td>
                        </tr>

                    <?php endforeach; ?>

                <?php else : ?>

                    <div class="cat-response" id="response">
                        <div class='cat-success cat-deletion'>
                            <h2>Link Expired!</h2>
                        </div>
                    </div>

                    <script>
                        setTimeout(() => {
                            window.location.href = "http://localhost/WoodWorks/public/category";
                        },2000);
                    </script>

                <?php endif; ?>

            </table>
        </div>
        <div class="payment-details">
            <h1>Order Summary</h1>
            <div>
                <h3>Total</h3>
                <?php if(!empty($items)) : ?>
                    <h3>Rs. <?=$items[0]->Total_amount?>.00</h3>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="shipping-details">
        <h1>Shipping Details</h1>

        <form method="post" id="shipping-details">
            <div class="name-field">
                <div class="field checkout-details-field">
                    <div class="header-error">
                        <label>First Name</label>
                        <span class="error font-sm" id="Firstname"></span>
                    </div>
                    <input type="text" name="Firstname" placeholder="First Name">
                </div>
                <div class="field checkout-details-field">
                    <div class="header-error">
                        <label>Last Name</label>
                        <span class="error font-sm" id="Lastname"></span>
                    </div>
                    <input type="text" name="Lastname" placeholder="Last Name">
                </div>
            </div>

            <div class="field">
                <div class="header-error">
                    <label>Email</label>
                    <span class="error font-sm" id="Email"></span>
                </div>
                <input type="email" name="Email" placeholder="Email">
            </div>

            <div class="field">
                <div class="header-error">
                    <label>Contact No</label>
                    <span class="error font-sm" id="Contactno"></span>
                </div>
                <input type="text" name="Contactno" placeholder="Contact Number">
            </div>


                <div class="field">
                    <div class="header-error">
                        <label>Address Line 1</label>
                        <span class="error font-sm" id="Address1"></span>
                    </div>
                    <input type="text" name="Address_line1" placeholder="Address Line 1">
                </div>
                <div class="field">
                    <div class="header-error">
                        <label>Address Line 2</label>
                        <span class="error font-sm" id="Address2"></span>
                    </div>
                    <input type="text" name="Address_line2" placeholder="Address Line 2">
                </div>
                <div class="field">
                    <div class="header-error">
                        <label>City</label>
                        <span class="error font-sm" id="City"></span>
                    </div>
                    <input type="text" name="City" placeholder="City">
                </div>



            <div class="checkout-btn-container">
                <?php if(!empty($items)) : ?>
                    <button class="checkout-btn" type="submit" onclick="checkout(`<?=$items[0]->OrderID?>`)">Checkout</button>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <div class="popup payment-popup" id="popup">
        <div class="popup-heading">
            <h2>1. Shipping Details</h2>
            <img src="<?=ROOT?>/assets/images/customer/close.png" alt="Close" onclick="closePopup()">
        </div>
        <div class="payment-checkout">
            <div class="checkout-details">
                <form>
                    <div class="name-field">
                        <div class="field checkout-details-field">
                            <label>First Name</label>
                            <input type="text" name="Firstname" placeholder="First Name">
                        </div>
                        <div class="field checkout-details-field">
                            <label>Last Name</label>
                            <input type="text" name="Firstname" placeholder="Last Name">
                        </div>
                    </div>
                    <div class="name-field">
                        <div class="field checkout-details-field">
                            <label>Email</label>
                            <input type="email" name="Firstname" placeholder="Email">
                        </div>
                        <div class="field checkout-details-field">
                            <label>Contact No</label>
                            <input type="text" name="Firstname" placeholder="Contact Number">
                        </div>
                    </div>
                    <div class="field">
                        <label>Address</label>
                        <input type="text" name="Address" placeholder="Address">
                    </div>

                    <h2>2. Card Details</h2>

                    <div class="field">
                        <label>Name on Card</label>
                        <input type="text" name="Name" placeholder="Name on Card">
                    </div>

                    <div class="field">
                        <label>Card Number</label>
                        <input type="text" name="Cardno" placeholder="Card Number">
                    </div>

                    <div class="card-fields">
                        <div class="card-field">
                            <label>Expiration Date</label>
                            <div>
                                <select name="Month">
                                    <option selected>Month</option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                                <input type="number" name="Date" placeholder="Date">
                            </div>
                        </div>

                        <div class="field">
                            <label>CVC</label>
                            <input type="text" name="CVC" placeholder="CVC">
                        </div>
                    </div>
                </form>
            </div>
            <div class="payment-details">
                <h1>Order Summary</h1>
                <div>
                    <h3>Items</h3>
                    <h3>Rs. 20000.00</h3>
                </div>
                <div>
                    <h3>Shipping and Handling</h3>
                    <h3>Rs. 1000.00</h3>
                </div>
                <div>
                    <h2>Total</h2>
                    <h2>Rs. 21000.00</h2>
                </div>

                <form>
                    <div class="promo">
                        <h3>Promo Code</h3>
                        <span class="add-promo" onclick="openPromoField()">&plus;</span>
                    </div>
                    <input class="promo-field" type="text" name="Promo">
                </form>

                <button>Proceed to Payment</button>
            </div>
        </div>
    </div>
</div>

<div class="cat-response" id="response">

</div>

<script src="<?=ROOT?>/assets/javascript/place_order.js"></script>
<?php $this->view('reg_customer/includes/footer'); ?>




