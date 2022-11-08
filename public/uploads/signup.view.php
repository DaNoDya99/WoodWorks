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
            <header>Signup Now</header>
            <?php if(!empty($errors)):?>
                <div class="error-txt signup-error">
                    <ul>
                    <?php foreach ($errors as $key => $value):?>
                        <li><?=$errors[$key]?></li>
                    <?php endforeach;?>
                    </ul>
                </div>
            <?php endif;?>
            <form method="post">
                <div class="name-details">
                    <div class="field input">
                        <label>First Name</label>
                        <input type="text" name="Firstname" placeholder="First Name">
                    </div>
                    <div class="field input">
                        <label>Last Name</label>
                        <input type="text" name="Lastname" placeholder="First Name">
                    </div>
                </div>
                <div class="field input">
                    <label>Gender</label>
                    <select class="gender-select" name="Gender" id="gender">
                        <option selected>-- Select Gender --</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="field input">
                    <label>Email Address</label>
                    <input type="email"  name="Email" placeholder="Enter Your Email">
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input type="password" name="Password" placeholder="Enter Your Password">
                </div>
                <div class="field input">
                    <label>Re-Type Password</label>
                    <input type="password" name="Password2" placeholder="Re-Type Your Password">
                </div>
                <div class="field input">
                    <label>Address</label>
                    <input type="text" name="Address" placeholder="Enter Your Address">
                </div>
                <div class="field input">
                    <label>Contact</label>
                    <input type="text" name="Mobileno" placeholder="Enter Your Contact No">
                </div>
                <div class="field button">
                    <button type="submit">Signup</button>
                </div>
            </form>
            <div class="link">Already have an account?<a href="<?=ROOT?>/login1"> Login now</a></div>
        </div>
    </div>
</div>

</body>
</html>