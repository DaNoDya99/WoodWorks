
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
                            <td><a href="<?= ROOT ?>/cashier/add_to_cart/<?= $product->ProductID ?>" style="border-radius: 100px; border:0; background-color: green; padding:10px; color:white; height:40px; width:40px;">+</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="sec3">
        <div class="panel2" style="color: white; padding:10px">
            <h3>
                Orders
            </h3>
            <table style="font-size:14px">
                <?php if(!empty($data['cart'])):?>
                    <?php foreach ($data['cart'] as $cart) : ?>
                        <tr>
                            <td>

                                <?= $cart->Name; ?>
                                <?= $cart->ProductID; ?>
                            
                                <a href="<?=ROOT?>/cashier/removeItem/<?=$cart->CartID?>/<?=$cart->ProductID?>/<?=$cart->Cost?>/<?=$cart->Quantity?>">Remove</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                <p>Cart is empty</p>
                <?php endif ?>
            </table>
        </div>
    </div>
</body>
<!-- <script>
    function timedelload() {
        setTimeout(function() {
            document.getElementById("panel").style.opacity = 1;
            document.getElementById("panel").style.marginTop = "75px";
        }, 200);
    }

    function timedelexit() {
        setTimeout(function() {
            document.getElementById("panel").style.opacity = 0;
            document.getElementById("panel").style.marginTop = "150px";
        }, 200);
    }

    function delay(URL) {
        setTimeout(function() {
            window.location = URL
        }, 500);
    }
</script> -->

</html>