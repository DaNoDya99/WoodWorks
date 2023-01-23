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
            font-family: Arial, Helvetica, sans-serif;
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
                <div style="margin-top:50px;display: grid; justify-content:center ;width: 30vw;background-color: white; padding: 40px; border-radius: 10px; box-shadow: 0px 5px 10px rgba(107, 107, 107, 0.753);">
                    <h1>Sign Up</h1>
                    <?php if (!empty($errors)) : ?>
                        <div style=" display:flex; align-items:center; justify-content:center; border:1px solid #F3D8DA; width:100%; height:50px; background-color:#F3D8DA; margin-bottom:20px;"><small>
                                <ul> <?php foreach ($errors as $key => $value) : ?>
                                        <li><?= $errors[$key] ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </small></div>
                    <?php endif; ?>

                    <form action="" method="post" novalidate class="signup" style="">
                        <div class="inline-input">
                            <div class="input-field">
                                <label for="Firstname"><small>First Name</small></label><br>
                                <input style="padding-left:10px ;" type="text" value="<?= set_value('Firstname') ?>" name="Firstname" id="fname" placeholder="Enter First Name" required><br>
                            </div>

                            <div class="input-field">
                                <label for="Lastname"><small>Last Name</small></label><br>
                                <input style="padding-left:10px ;" type="text" value="<?= set_value('Lastname') ?>" name="Lastname" id="lname" placeholder="Enter Last Name" required><br>
                            </div>

                        </div>
                        <div class="input-field">
                            <label for="Gender"><small>Gender</small></label><br>
                            <!-- <input style="padding-left:10px ;" type="text" value="<?= set_value('Firstname') ?>" name="Firstname" id="fname" required><br> -->
                            <select name="Gender" id="gender">
                                <option selected>Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                        <div class="input-field">
                            <label for="Email"><small>E-mail</small></label><br>
                            <input style="padding-left:10px ;" type="email" value="<?= set_value('Email') ?>" name="Email" id="email" placeholder="Enter E-mail Address" required><br>
                        </div>
                        <div class="inline-input">
                            <div class="input-field">
                                <label for="Password"><small>Password</small></label><br>
                                <input style="padding-left:10px ;" type="password" name="Password" id="pass" placeholder="Enter Password" required><br>
                            </div>

                            <div class="input-field">
                                <label for="Password2"><small>Confirm Password</small></label><br>
                                <input style="padding-left:10px ;" type="password" name="Password2" id="cpass" placeholder="Confirm Password" required><br>
                            </div>

                        </div>
                        <div class="input-field">
                            <label for="Address"><small>Address</small></label><br>
                            <input style="padding-left:10px;" type="text" value="<?= set_value('Address') ?>" name="Address" id="address" placeholder="Enter Address" required><br>
                        </div>
                        <div class="input-field">
                            <label for="Mobileno"><small>Contact Number</small></label><br>
                            <input style="padding-left:10px;" type="tel" value="<?= set_value('Mobileno') ?>" name="Mobileno" id="phone" placeholder="Enter Contact Number" required><br>
                        </div>
                        <button class="loginbutton" type="submit">Sign Up</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>