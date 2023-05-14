<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/login.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #E2E2CF;
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
            <div
                style="display: grid; justify-content:center ;width: 400px;background-color: white; padding: 40px; border-radius: 10px; box-shadow: 0px 5px 10px rgba(107, 107, 107, 0.753);">
                <h1>Reset your password</h1>
                <?php if (!empty($errors)) : ?>
                    <div
                        style=" display:flex; align-items:center; justify-content:center; border:1px solid #F3D8DA; width:100%; height:50px; background-color:#F3D8DA; margin-bottom:20px;">
                        <small>
                            <?= $errors['otp'] ?>
                        </small>
                    </div>
                <?php endif; ?>
                <form action="" method="post" novalidate class="signup" style="">
<!--                    <a href="--><?php //= ROOT ?><!--/verify/sendOTP">Send Code</a>-->
                    <p>Enter your email address of the account you wish to reset the password
                    </p>
                    <p>
                        <?php if (isset($data['msg'])) {
                            show($data['msg']);
                        } ?>
                    </p>
                    <div class="input-field">
                        <input style="padding-left:10px ;" type="text" name="Email" id="email"
                               placeholder="Enter email address" required><br>
                    </div>
                    <button class="loginbutton" type="submit">Proceed</button>

                </form>
            </div>
        </div>
    </div>
</div>
</body>

</html>