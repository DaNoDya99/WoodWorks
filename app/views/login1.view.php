<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=APPNAME?></title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/styles.css">
</head>
<body class="login-body">
    <div class="login-background">
        <div>
            <div class="login-left-container-top">
                <img src="./assets/images/logo.png" alt="Logo">
                <h2>WOODWORKS</h2>
            </div>
            <div class="login-left-container-bottom">
                <h1 class="login-quote">The wood that enhances the beauty of your home</h1>
                <img class="login-background-img" src="<?=ROOT?>/assets/images/login1.jpg" alt="Login Backgroound">
            </div>
        </div>
        <div class="form-container">
            <div class="login-form">
                <header>Please Login</header>
                <?php if(!empty($errors['email'])):?>
                    <div class="error-txt"><?=$errors['email']?></div>
                <?php endif;?>

                <form method="post">
                    <div class="field input">
                        <label>Email Address</label>
                        <input type="email"  name="email" placeholder="Enter Your Email">
                    </div>
                    <div class="field input">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Enter Your Password">
                    </div>
                    <div class="field button">
                        <button type="submit">Login</button>
                    </div>
                </form>
                <div class="link">Not yet signed up?<a href="#"> Signup now</a></div>
            </div>
        </div>
    </div>

    <script src="<?=ROOT?>/assets/javascript/login1.js"></script>
</body>
</html>