<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill Template</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.4;
            margin: 0;
        }

        img {
            width: 350px;
            object-fit: contain;
        }

        .container {
            width: 100%;
            height: 100%;
            margin: auto;
            background-color: #FFF;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        header {
            margin-bottom: 1rem;
        }


        h2 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        header p {
            line-height: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table td,
        table th {
            border: 1px solid #dddddd;
            padding: 8px;
        }

        table th {
            font-weight: bold;
            background-color: #f2f2f2;
            text-align: left;
        }

        .footer {
            margin-top: 30px;
        }

    </style>
</head>

<body>
<div class="container">
    <header>
        <img width="350" style="margin-bottom: 10px" src="https://i.ibb.co/HpH6L1G/WOODWORKS.png" alt="">

        <p>No. CS07 ,Reid Avenue, Colombo 0700</p>
        <p>Phone: +(94) 77 1234 123</p>
    </header>
    <section>
        <h2>INVOICE</h2>
        <p><strong>Customer
                Name: </strong><?= $data['order_details'][0]->Firstname . " " . $data['order_details'][0]->Lastname ?>
        </p>
        <p><strong>Order ID: </strong> <?= $data['order_details'][0]->OrderID ?></p>
        <p><strong>Date: </strong><?= date("Y/m/d") ?></p>
    </section>
    <section>
        <table>
            <thead>
            <tr>
                <th>Product ID</th>
                <th>Name</th>
                <th>Warranty(YRS)</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data['order_items'] as $item) { ?>
                <tr>
                    <td><?= $item->ProductID ?></td>
                    <td><?= $item->Name ?></td>
                    <td><?= $item->Warrenty_period ?></td>
                    <td><?= $item->Quantity ?></td>
                    <td><?= $item->Cost ?></td>
                    <td><?= $item->Quantity * $item->Cost ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <p><strong>Subtotal:</strong> Rs. <?= $data['order_details'][0]->Total_amount ?></p>

        <p><strong>Shipping:</strong>Rs. 0<?= $data['order_details'][0]->Shipping_cost ?> </p>
        <p>
            <strong>Total:</strong>
            Rs <?= $data['order_details'][0]->Total_amount + $data['order_details'][0]->Shipping_cost ?>
        </p>
    </section>
    <footer class="footer">
        <p>Thank you for shopping with us!</p>
        <small style="color: dimgrey">Prices and availability are subject to change without notice" or "We reserve the
            right to correct any
            pricing errors. All trademarks, logos, and copyrights are the property of their respective owners. We may
            use your contact information for marketing purposes unless you opt out. By making a purchase, you agree to
            the terms and conditions outlined by the company</small>

    </footer>
</div>
</body>

</html>
