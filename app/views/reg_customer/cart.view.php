<?php $data['row'] = $row; $this->view('reg_customer/includes/header',$data); ?>

    <div class="cart-body">
        <div class="cart">
            <h1>Cart</h1>
            <div class="cart-product">
                <img class="cart-product-img" src="<?=ROOT?>/assets/images/customer/chair.jpg" alt="Product Image">
                <p>Serif side table.</p>
                <div class="cart-quantity">
                    <img src="<?=ROOT?>/assets/images/customer/minus.png" alt="Minus" onclick="reduceQuantity()">
                    <input type="text" value="1">
                    <img src="<?=ROOT?>/assets/images/customer/plus.png" alt="Plus" onclick="increseQuantity()">
                </div>
                <p>Rs. 15,000.00</p>
            </div>

            <div class="cart-total">
                <div>
                    <p>Total</p>
                    <p>Rs. 50,000.00</p>
                </div>
                <button>Proceed to Payment</button>
            </div>
        </div>
    </div>

<?php $this->view('reg_customer/includes/footer'); ?>