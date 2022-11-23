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

<div class="signup-form">
    <img src="./assets/images/driver/user.png">

    <?php if(!empty($errors['email'])):?>
        <div class="error-txt"><?=$errors['email']?></div>
    <?php endif;?>

    <form method="post">

        <input type="email" name="Email" placeholder="Enter Your Email" class="txt">
        <input type="password" name="Password" placeholder="Enter Your Password" class="txt">

<!--        <div class="form-check">-->
<!--            <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">-->
<!--            <label class="form-check-label" >Remember me</label>-->
<!--        </div>-->

        <button type="submit" class="btn">Login</button>
        <a href="#">Forget Password ?</a>

    </form>
</div>

</body>
</html>