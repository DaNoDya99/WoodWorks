<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=APPNAME?></title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/styles2.css">
</head>

<body class="login">
    <div class="login-container">
    <div class="login-left">

    <div>
            <div class="login-left-container-top">
                <img  class="logo" src="./assets/images/logo.png" alt="Logo">
                <h2>WOODWORKS</h2>
            </div>

</div>



        <div class="login-form">
        <h1>Login</h1>
        <?php if(!empty($errors['email'])):?>
        <div class="error-txt"><?=$errors['email']?></div>
        <?php endif;?>

        <form method="post">
            <div class="txt_field">
                <input type="email" name="Email" required>
                <span></span>
                <label>Email</label>
            </div>
            <div class="txt_field">
                <input type="password" name="Password" required>
                <span></span>
                <label>Password</label>
            </div>
            <div class="pass">Forgot Password?</div>
                <input type="submit" value="Login">
        
        </form>
    </div>
        </div>

    <div class="login-right">
       <img class="login-image" src="<?=ROOT?>/assets/images/login4.jpg">
       
    </div>
    </div>

    

</body>
</html>