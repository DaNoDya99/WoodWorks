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

        img{
            width: 350px;
            object-fit: contain;
        }

        .container {
            width: 210mm;
            height: 297mm;
            padding: 20mm;
            margin: auto;
            background-color: #FFF;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        header {
            font-size: 50px;
            margin-bottom: 1rem;
        }

        
        h2 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
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
            <img width="350" src="https://i.ibb.co/HpH6L1G/WOODWORKS.png" alt="">
            <p>123 Street Address, City, State, Country</p>
            <p>Phone: (555) 555-5555</p>
        </header>
        <section>
            <h2>INVOICE</h2>
            <p><strong>Customer Name:</strong> John Doe</p>
            <p><strong>Order ID:</strong> 1234567890</p>
            <p><strong>Date:</strong> 2023-05-10</p>
        </section>
        <section>
            <table>
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Product 1</td>
                        <td>Product 1 description</td>
                        <td>2</td>
                        <td>$49.99</td>
                        <td>$99.98</td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
            <p><strong>Subtotal:</strong> $99.98</p>

            <p><strong>Shipping:</strong> $0.00</p>
            <p><strong>Total:</strong> $99.98</p>
        </section>
        <footer class="footer">
            <p>Thank you for shopping with us!</p>
        </footer>
    </div>
</body>

</html>
