<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/styles.css">
</head>
<body class="reg-customer-body">
<header>
    <nav class="nav-bar">
        <div class="nav-brand">
            <img src="<?=ROOT?>/assets/images/WOODWORKS.svg" alt="Logo">
            <!-- <h1>WOODWORKS</h1> -->
        </div>
        <div class="nav-items">
            <ul>
                <li class="nav-item"><a href="<?=ROOT?>/customer_home">Home</a></li>
                <li class="nav-item"><a href="<?=ROOT?>/category">Shop</a></li>
                <li class="nav-item"><a href="<?=ROOT?>/cart">Cart</a></li>
                <li class="nav-item"><a href="<?=ROOT?>/customer_home/about">About</a></li>
                <li class="nav-item"><a href="<?=ROOT?>/customer_home/contact">Contact</a></li>
            </ul>
        </div>
        <div class="nav-profile-section">
            <div class="nav-user-details">
                <img src="<?=ROOT?>/<?=$row[0]->Image?>" alt="User">
                <h1>Welcome, <?=$row[0]->Firstname?></h1>
            </div>
            <div class="dropdown">
                <button class="dropbtn">Account</button>
                <div class="dropdown-content">
                    <a href="#">My orders</a>
                    <a href="<?=ROOT?>/customer_home/profile">Profile</a>
                    <a href="<?=ROOT?>/logout">Logout</a>
                </div>
            </div>
        </div>
    </nav>
</header>