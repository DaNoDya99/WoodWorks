<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=APPNAME?></title>
    <link rel="stylesheet" href="./assets/css/styles.css">
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
            <header>Signup Now</header>
            <?php if(!empty($errors['email'])):?>
                <div class="error-txt"><?=$errors['email']?></div>
            <?php endif;?>
            <form method="post">
                <div class="name-details">
                    <div class="field input">
                        <label>First Name</label>
                        <input type="text" name="firstname" placeholder="First Name">
                    </div>
                    <div class="field input">
                        <label>Last Name</label>
                        <input type="text" name="firstname" placeholder="First Name">
                    </div>
                </div>
                <div class="field input">
                    <label>Gender</label>
                    <select class="gender-select" name="gender" id="gender">
                        <option>-- Select Gender --</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="field input">
                    <label>Email Address</label>
                    <input type="email"  name="email" placeholder="Enter Your Email">
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input type="password" name="password1" placeholder="Enter Your Password">
                </div>
                <div class="field input">
                    <label>Re-Type Password</label>
                    <input type="password" name="password2" placeholder="Re-Type Your Password">
                </div>
                <div class="field input">
                    <label>Address</label>
                    <input type="text" name="address" placeholder="Enter Your Address">
                </div>
                <div class="field input">
                    <label>Contact</label>
                    <input type="text" name="contact" placeholder="Enter Your Contact No">
                </div>
                <div class="field button">
                    <button type="submit">Signup</button>
                </div>
            </form>
            <div class="link">Already have an account?<a href="#"> Login now</a></div>
        </div>
    </div>
</div>

</body>
</html>