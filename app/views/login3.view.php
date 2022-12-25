<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/styles_login3.css">

    <title><?=ucfirst(App::$page)?> - <?=APPNAME?></title>
</head>
<body class="bdy">

<div class="login3-logo">
    <img class="login3-logo-img" src="<?=ROOT?>/assets/images/logo.png" alt="Logo">
    <h1 class="login3-logo-name">WOODWORKS</h1>
</div>

<div class="login3-form">
    <img src="./assets/images/login3/user.png">

    <?php if(!empty($errors['email'])):?>
        <div class="error-txt"><?=$errors['email']?></div>
    <?php endif;?>

    <form method="post">

        <div class="login3-inputBox1">
            <input type="email" name="Email" placeholder="Enter Your Email" class="txt">
        </div>
        <div class="login3-inputBox2">
            <input type="password" name="Password" placeholder="Enter Your Password" class="txt" id="password">
            <img src="./assets/images/login3/eye-close.png" id="eyeicon">
        </div>

        <!--        <div class="form-check">-->
        <!--            <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">-->
        <!--            <label class="form-check-label" >Remember me</label>-->
        <!--        </div>-->

        <button type="submit" class="btn">Login</button>
        <a href="#">Forget Password ?</a>

    </form>
</div>

</body>
<script src="<?=ROOT?>/assets/javascript/login3.js"></script>
</html>