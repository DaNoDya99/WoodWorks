<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/styles.css">
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
                <div style="display: grid; justify-content:center ;width: 400px;background-color: white; padding: 40px; border-radius: 10px; box-shadow: 0px 5px 10px rgba(107, 107, 107, 0.753);">
                    <h1>Verify your E-mail</h1>
                    <?php if (!empty($errors)) : ?>
                        <div style=" display:flex; align-items:center; justify-content:center; border:1px solid #F3D8DA; width:100%; height:50px; background-color:#F3D8DA; margin-bottom:20px;">
                            <small>
                                <?= $errors['otp'] ?>
                            </small>
                        </div>
                    <?php endif; ?>
                    <form action="" method="post" novalidate class="signup" style="">
                        <a href="<?= ROOT ?>/verify/sendOTP">Send Code</a>
                        <p>To use shop at WoodWorks, enter the code in the email we sent to <strong><?= $_SESSION['Email'] ?></strong>.
                            This helps keep your account secure.
                            <br><br>
                            No email in your inbox or spam folder? Let’s resend it.
                            <br><br>
                            Wrong address? Log out to sign in with a different email. If you mistyped your email when
                            signing up, create a new account.
                        </p>
                        <p>
                            <?php if (isset($data['msg'])) {
                                show($data['msg']);
                            } ?>
                        </p>
                        <div class="input-field">
                            <input style="padding-left:10px ;" type="text" name="otp" id="email" placeholder="Enter OTP Code" required><br>
                        </div>
                        <button class="loginbutton" type="submit">Proceed</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>