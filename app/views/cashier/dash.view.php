<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders - Woodworks</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/cashier/dash-style.css">

</head>

<body>
    <?php $this->view('supplier/supplier.header', $data) ?>



    <div class="sec1">
        <?php $this->view('cashier/cashier.nav', $data) ?>
    </div>
    <div class="sec2">
        <div class="data" id="panel">

            <input type="text" name="search" placeholder="Search for a product" id="">
            <table style="display: block; font-size:14px; text-align:right;">
                <thead style="display: table; width:100%;">
                    <tr>
                        <th>SKU</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Quanitity</th>
                        <th>Price</th>
                        <th>Add</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody style="height: 400px; width:100%; display:block; overflow:auto;">

                    <?php foreach ($data['products'] as $product) : ?>
                        <tr>
                            <td><?= $product->ProductID ?></td>

                            <td><img style="width: 70px; border-radius:5px;" src="<?= ROOT ?>/<?= $product->image ?>" alt=""></td>
                            <td style=" width:200px; word-wrap: break-word;"><?= $product->Name ?></td>
                            <td><?= $product->Quantity ?></td>
                            <td><?= $product->Cost ?></td>
                            <td><a href="<?= ROOT ?>/cashier/add_to_cart/<?= $product->ProductID ?>"><img style="width: 16px;" src="<?= ROOT ?>/assets/images/cashier/add.svg" alt=""></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="sec3">
        <div class="panel2">
            <h3>
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
                    <p>Cart is empty</p>
                <?php endif ?>
            </div>
            <div class="button">
                <button class="proceed">Proceed to Payment</button>
            </div>

        </div>
    </div>
</body>

</html>