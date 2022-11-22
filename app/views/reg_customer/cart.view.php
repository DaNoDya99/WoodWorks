<?php $data['row'] = $row; $this->view('reg_customer/includes/header',$data); ?>

    <div class="cart-body">
        <div class="cart">
            <h1>Cart</h1>
            <table>
                <?php if(!empty($cart)): ?>
                    <?php foreach ($cart as $row) :?>
                        <tr>
                            <td><img class="cart-product-img" src="<?=ROOT?>/<?=$row->Image?>" alt=""></td>
                            <td><p><?=$row->Name?></p></td>
                            <td >
                                <div class="cart-quantity">
                                    <div>
                                        <img src="<?=ROOT?>/assets/images/customer/minus.png" alt="Minus" onclick="reduceQuantity()">
                                        <input type="text" value="1">
                                        <img src="<?=ROOT?>/assets/images/customer/plus.png" alt="Plus" onclick="increseQuantity()">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p>Rs. <?=$row->Cost?>.00</p>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><p class="cart-error"><?=$error?></p></tr>
                <?php endif;?>
            </table>

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