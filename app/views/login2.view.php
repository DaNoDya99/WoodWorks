<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        @font-face {
            font-family: Poppins;
            src: url(./assets/fonts/Poppins-Regular.ttf);
        }

        body {
            margin: 0;
            font-family: Poppins;
            padding: 0;
            background-color: #E2E2CF;
        }

        .leftpanel {

            background: url('./Rectangle6.png');
            background-repeat: no-repeat;
            background-size: cover;

        }

        .nav {
            position: fixed;
            align-items: center;
            width: 100vw;
            padding: 30px;
            margin-top: 30px;

        }

        .nav img {
            padding-left: 5vw;
            width: 14vw;
        }

        .contactbar {
            position: fixed;
            top: 0;
            height: 40px;
            width: 100vw;
            background-color: #182422;
        }

        .nav ul {
            list-style: none;
            display: flex;
            justify-content: space-between;
            padding-right: 5vw;
        }
        .nav li{
            padding-left: 3vw;
        }

        .main {
            display: grid;
            /* column-gap: 50px; */
            grid-template-columns: 2fr 5fr;
        }

        .grid-item {
            background-color: red;
            height: 100vh;

        }

        .mainbg {
            background-color: #E2E2CF;
            display: grid;
            justify-content: center;
            align-items: center;
        }

        form input {
            margin-bottom: 20px;
            height: 30px;
            width: 30vw;
            border-radius: 5px;
            border: 1px solid #18242279;
        }

        form button {
            font-size: 15px;
            background-color: #182422;
            color: white;
            width: 80px;
            border-radius: 5px;
            padding: 10px;
            margin-top: 10px;
        }

        label {
            color: rgb(59, 59, 59);
        }

        h1 {
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="contactbar">
        <nav class="nav" style="display: grid; grid-template-columns:8fr 2fr">
            <img src="./WOODWORKS.png" alt="">
            <div>
                <ul>
                    <li>Login</li>
                    <li>Register</li>
                    <li>Cart</li>

                </ul>
            </div>
        </nav>
    </div>
    <div class="main">
        <div class="grid-item leftpanel"></div>
        <div class="grid-item mainbg ">
            <div>
                <div
                    style="margin-top:5 0px;display: grid; justify-content:center ;width: 30vw;background-color: white; padding: 40px; border-radius: 10px; box-shadow: 0px 5px 10px rgba(107, 107, 107, 0.753);">
                    <h1>Login</h1>

                    <form action="" method="post">
                        <label for="email">Email</label><br>
                        <input style="padding-left:10px ;" type="email" name="email" id="email"><br>
                        <label for="password">Password</label><br>
                        <input style="padding-left:10px ;" type="password" name="password" id="password"><br>
                        <input style="width: auto; height:auto;" type="checkbox" name="remember" id="remember"><label
                            for="remember">Remember</label>
                        <br><button type="submit">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>