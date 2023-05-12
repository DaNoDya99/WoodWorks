<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Success</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Rubik', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #243230;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: space-evenly;
            flex-direction: column;
            background-color: #fff;
            height: 70vh;
            width: 70vw;
            border-radius: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;

        }

        h1 {
            font-size: 2.5rem;
            color: #28a745;
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .checkmark img{
            height: 25vh;
        }

        .btn {
            display: inline-block;
            padding: 10px 25px;
            font-size: 18px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            outline: none;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 8px;
            margin: 0 10px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .btn:active {
            background-color: #0056b3;


        }
    </style>
</head>

<body>
<div class="container">
    <div class="checkmark"><img src="circle-check-solid.svg" alt=""></div>
    <h1>Transaction Successful!</h1>
    <h2><?= show($data) ?></h2>
    <p>Thank you for your purchase. Your transaction was successful, and your bill is ready.</p>
    <div>
        <button class="btn" id="print-bill">Print Bill</button>
        <button class="btn" id="back-to-pos">Go Back to POS</button>
    </div>

</div>

<script>
    document.getElementById('print-bill').addEventListener('click', function () {
        window.print();
    });

    document.getElementById('back-to-pos').addEventListener('click', function () {
        window.location.href = 'your-pos-url-here';
    });
</script>
</body>

</html>