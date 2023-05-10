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
            font-family: 'Rubik', sans-serif;
            padding: 0;
            background-color: #E2E2CF;
        }

        .signup-frame {
            position: relative;
            min-height: 400px;
            overflow: hidden;
            display: flex;
            flex-direction: row;
            justify-content: center;
            width: 600px;
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(107, 107, 107, 0.753);
        }

        .signup {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 80%;
            transition: all 0.5s;
        }

        .signup2 {
            position: absolute;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            top: 50%;
            left: 50%;
            min-height: 40vh;
            transform: translate(-50%, -50%);

            transition: all 0.5s;
        }

        .active1 {
            transform: translate(-50%, -50%);
        }

        .inactive1 {
            transform: translate(-200%, -50%);
        }

        .inactive2 {
            transform: translate(100%, -50%);
        }

        .active2 {
            transform: translate(-50%, -50%);

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
            <div class="signup-frame" style="">
                <form action="" method="post" id="myform" novalidate class="signup active1" style="">
                    <h1>Sign Up</h1>
                    <div class="inline-input">
                        <div class="input-field">
                            <label for="Firstname"><small>First Name</small></label><br>

                            <input style="padding-left:10px ;" type="text" value="<?= set_value('Firstname') ?>"
                                   name="Firstname" id="fname" placeholder="Enter First Name" required><br>
                            <?php if (isset($data['errors']['Firstname'])) : ?>
                            <small id="Firstname-error" class="signup-error" style="color: red;"> <?= $data['errors']['Firstname']?> </small>
                            <?php endif; ?>
                        </div>

                        <div class="input-field">
                            <label for="Lastname"><small>Last Name</small></label><br>
                            <input style="padding-left:10px ;" type="text" value="<?= set_value('Lastname') ?>"
                                   name="Lastname" id="lname" placeholder="Enter Last Name" required><br>
                            <?php if (isset($data['errors']['Lastname'])) : ?>
                                <small id="Lastname-error" class="signup-error" style="color: red;"> <?= $data['errors']['Lastname']?> </small>
                            <?php endif; ?>
                        </div>

                    </div>
                    <!--                        <div class="input-field">-->
                    <!--                            <label for="Gender"><small>Gender</small></label><br>-->
                    <!-- <input style="padding-left:10px ;" type="text" value="<?= set_value('Firstname') ?>" name="Firstname" id="fname" required><br> -->
                    <!--                            <select name="Gender" id="gender">-->
                    <!--                                <option selected>Select Gender</option>-->
                    <!--                                <option value="Male">Male</option>-->
                    <!--                                <option value="Female">Female</option>-->
                    <!--                            </select>-->
                    <!--                        </div>-->

                    <div class="input-field">
                        <label for="Email"><small>E-mail</small></label><br>
                        <input style="padding-left:10px ;" type="email" value="<?= set_value('Email') ?>" name="Email"
                               id="email" placeholder="Enter E-mail Address" required><br>
                        <?php if (isset($data['errors']['Email'])) : ?>
                            <small id="Email-error" class="signup-error" style="color: red;"> <?= $data['errors']['Email']?> </small>
                        <?php endif; ?>
                    </div>
                    <div class="inline-input">
                        <div class="input-field">
                            <label for="Password"><small>Password</small></label><br>
                            <input style="padding-left:10px ;" type="password" name="Password" id="pass"
                                   placeholder="Enter Password" required><br>
                            <?php if (isset($data['errors']['Password'])) : ?>
                                <small id="Password-error" class="signup-error" style="color: red;"> <?= $data['errors']['Password']?> </small>
                            <?php endif; ?>
                        </div>

                        <div class="input-field">
                            <label for="Password2"><small>Confirm Password</small></label><br>
                            <input style="padding-left:10px ;" type="password" name="Password2" id="cpass"
                                   placeholder="Confirm Password" required><br>
                        </div>

                    </div>
                    <!--                        <div class="input-field">-->
                    <!--                            <label for="Address"><small>Address</small></label><br>-->
                    <!--                            <input style="padding-left:10px;" type="text" value="-->
                    <?php //= set_value('Address') ?><!--" name="Address" id="address" placeholder="Enter Address" required><br>-->
                    <!--                        </div>-->
                    <!--                        <div class="input-field">-->
                    <!--                            <label for="Mobileno"><small>Contact Number</small></label><br>-->
                    <!--                            <input style="padding-left:10px;" type="tel" value="-->
                    <?php //= set_value('Mobileno') ?><!--" name="Mobileno" id="phone" placeholder="Enter Contact Number" required><br>-->
                    <!--                        </div>-->

                    <p>Already have an account? <a href="<?=ROOT?>/login">Log in</a></p>
                    <button class="loginbutton" id="continue" type="submit">Continue</button>

                </form>


            </div>
        </div>
    </div>
</div>
</body>

</html>