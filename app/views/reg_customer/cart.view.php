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
<!--                                        <a id="increase" href="--><?php //=ROOT?><!--/cart/decreaseQuantity/--><?php //=$row->CartID?><!--/--><?php //=$row->ProductID?><!--/--><?php //=$row->Quantity?><!--/--><?php //=$row->Cost?><!--">-->
                                            <img src="<?=ROOT?>/assets/images/customer/minus.png" alt="Minus" onclick="decreaseQuantity('<?=$row->CartID?>','<?=$row->ProductID?>','<?=$row->Quantity?>','<?=$row->Cost?>')">
<!--                                        </a>-->
                                        <input id="quantity" type="text" value="<?=$row->Quantity?>">
<!--                                        <a id="decrease" href="--><?php //=ROOT?><!--/cart/increaseQuantity/--><?php //=$row->CartID?><!--/--><?php //=$row->ProductID?><!--/--><?php //=$row->Quantity?><!--/--><?php //=$row->Cost?><!--">-->
                                            <img src="<?=ROOT?>/assets/images/customer/plus.png" alt="Plus" onclick="increaseQuantity('<?=$row->CartID?>','<?=$row->ProductID?>','<?=$row->Quantity?>','<?=$row->Cost?>')">
<!--                                        </a>-->
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p>Rs. <?=$row->Cost?>.00</p>
                            </td>
                            <td>
                                <a href="<?=ROOT?>/customer_home/removeItem/<?=$row->CartID?>/<?=$row->ProductID?>/<?=$row->Cost?>/<?=$row->Quantity?>">
                                    <img class="cart-close" src="<?=ROOT?>/assets/images/customer/close.png" alt="Closing button">
                                </a>
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
                    <?php if(!empty($cart)): ?>
                        <p>Rs. <?=$cart[0]->Total_amount?>.00</p>
                    <?php else: ?>
                        <p>Rs. 00.00</p>
                    <?php endif; ?>
                </div>
                <?php if(!empty($cart[0]->CartID)): ?>
                    <a href="<?=ROOT?>/customer_home/payment/<?=$cart[0]->CartID?>">
                        <button>Proceed to Payment</button>
                    </a>
                <?php else: ?>
                    <button disabled>Proceed to Payment</button>
                <?php endif; ?>


            </div>
        </div>
    </div>

    <script src="<?=ROOT?>/assets/javascript/cart.js"></script>

<?php $this->view('reg_customer/includes/footer'); ?>