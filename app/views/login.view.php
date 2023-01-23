<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            padding: 0;
            background-color: #E2E2CF;
        }

        .leftpanel {

            background: url('<?= ROOT ?>/assets/images/cashier/Rectangle6.png');
            background-repeat: no-repeat;
            background-size: cover;

        }

        .nav {
            position: fixed;
            align-items: center;
            width: 100vw;
            padding: 20px;
            margin-top: 0px;

        }

        .nav img {
            padding-left: 5vw;
            padding-top: 20px;
            width: 14vw;
        }

        /* .contactbar {
            position: fixed;
            top: 0;
            height: 40px;
            width: 100vw;
            background-color: #182422;
        } */

        .nav ul {
            list-style: none;
            display: flex;
            justify-content: space-between;
            padding-right: 5vw;
        }

        .nav li {
            padding-left: 3vw;
        }

        .main {
            display: grid;
            /* column-gap: 50px; */
            grid-template-columns: 2fr 5fr;
        }

        .grid-item {

            height: 100vh;

        }

        .mainbg {
            background-color: #E2E2CF;
            display: grid;
            justify-content: center;
            align-items: center;
        }

        form input {
            margin-bottom: 5px;
            height: 30px;
            width: 30vw;
            margin-top: 5px;
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

        .loginbutton {
            width: 100%;
            background-color: #007148;
            border: 0px;
            padding: 12px;
            margin-top: 30px;
            transition: all 0.3s ease;

        }

        .loginbutton:hover {
            background-color: #005c3f;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="contactbar">
        <nav class="nav" style="display: grid; grid-template-columns:8fr 2fr">
            <img src="<?= ROOT ?>/assets/images/cashier/WOODWORKS.svg" alt="">
        </nav>
    </div>
    <div class="main">
        <div class="grid-item leftpanel"></div>
        <div class="grid-item mainbg ">
            <div>
                <div style="margin-top:50px;display: grid; justify-content:center ;width: 30vw;background-color: white; padding: 40px; border-radius: 10px; box-shadow: 0px 5px 10px rgba(107, 107, 107, 0.753);">
                    <h1>Login</h1>
                    <?php if (!empty($data['errors']['email'])) : ?>
                        <div style=" display:flex; align-items:center; justify-content:center; border:1px solid #F3D8DA; width:100%; height:50px; background-color:#F3D8DA; margin-bottom:20px;"><small><?= $data['errors']['email'] ?></small></div>
                    <?php endif; ?>

                    <form action="" method="post" novalidate>
                        <label for="email"><small>Email</small></label>
                        <input style="padding-left:10px ;" type="email" value="<?= set_value('Email') ?>" name="Email" id="email" required><br>

                        <br>
                        <br>
                        <label for="password"><small>Password</small></label>
                        <input style="padding-left:10px ;" type="password" name="Password" id="Password" value="<?= set_value('Password') ?>" required>
                        <br><button class="loginbutton" type="submit">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>