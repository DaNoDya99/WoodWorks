<!DOCTYPE html>
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
                <img src="<?=ROOT?>/assets/images/designer/user.png" alt="Profile picture">
                <div class="nav-vr"></div>
                <h1>Hi, <?=Auth::getFirstname()?></h1>
                <div class="nav-vr"></div>
                <a href="<?=ROOT?>/login3">
                    <h1>Logout</h1>
                </a>
            </div>
        </div>

        <?php if(!empty($errors)):?>
            <div class="error-txt signup-error">
                <ul>
                    <?php foreach ($errors as $key => $value):?>
                        <li><?=$errors[$key]?></li>
                    <?php endforeach;?>
                </ul>
            </div>
        <?php endif;?>

        <div class="tbox">
            <h3 class="text"> Orders Details</h3><br>
            <table class="tabl">
                <tr class="tr">
                    <th class="th">Order.No</th>
                    <th class="th">Quantity</th>
                    <th class="th">Customer ID</th>
                    <th class="th">Customer FirstName</th>
                    <th class="th">Customer LastName</th>
                    <th class="th">Customer Address</th>
                    <th class="th">Customer Mobileno</th>
                </tr>
            </table>
        </div>
    </div>
</div>

</body>
</html>
