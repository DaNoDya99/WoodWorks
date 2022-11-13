<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=APPNAME?></title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/styles_login3.css">
</head>
<body class="driver">
<div class="driver-body">
    <?php $this->view('includes/driver_sidebar') ?>
    <div class="dashboard">
        <div class="dashboard-nav">
            <div class="nav-item-page-name">
                <h1><?= $title ?></h1>
            </div>
            <div class="nav-item-user">
                <img src="<?=ROOT?>/assets/images/driver/user.png" alt="Profile picture">
                <div class="nav-vr"></div>
                <h1>Hi, <?=Auth::getFirstname()?></h1>
                <div class="nav-vr"></div>
                <a href="<?=ROOT?>/login3">
                    <h1>Logout</h1>
                </a>
            </div>
        </div>
        <div class="content">
            <h3 class="text">Welcome <?=Auth::getLastname()?></h3><br>
            <hr><br>
            <h3 id="deli-hed"> On-Time Delivery</h3><br>
            <img class="deli-pict" src="<?=ROOT?>/assets/images/driver/delivery.jpg" alt="Delivery picture">
            <p class="para">
                “WoodWorks” is a management system for a furniture selling shop. “WoodWorks” has the
                capability of buy furniture from the suppliers and sell for the customers. For customers if they
                want to sell their used furniture then they can put an advertisement in the system. The
                company provides the delivery service if the customers want it. There are designers who are
                working for the system, provide new furniture designs for the company. “WoodWorks” is the
                automated system for the shop which consist of an online ordering system, inventory
                management system, report generating system and a delivery system. This system is intended
                to maximize the revenue of the business and introduce an easy way to interact with the business
                for both the customers and employees.
            </p>
        </div>
    </div>
</div>
</body>
</html>