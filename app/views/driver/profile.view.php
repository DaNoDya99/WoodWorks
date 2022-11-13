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
                <h1><?=$title?></h1>
            </div>
            <div class="nav-item-user">
                <img src="<?=ROOT?>/<?=$row[0]->Image?>" alt="Profile picture">
                <div class="nav-vr"></div>
                <h1>Hi, <?=$row[0]->Firstname?></h1>
                <div class="nav-vr"></div>
                <a href="<?=ROOT?>/login3">
                    <h1>Logout</h1>
                </a>
            </div>
        </div>
        <div class="dashboard-body">
            <div class="profile-img-section">
                <img src="<?=ROOT?>/<?=$row[0]->Image?>" alt="">
                <h1><?=$row[0]->Firstname?> <?=$row[0]->Lastname?></h1>
                <h2><?=$row[0]->Role?></h2>
            </div>
            <div class="profile-details-section">
                <div class="wrapper">
                    <input type="radio" name="slider" id="overview" checked>
                    <input type="radio" name="slider" id="edit">
                    <nav>
                        <label for="overview"  class="overview">Overview</label>
                        <label for="edit"  class="edit-info">Edit Profile</label>
                        <div class="slider"></div>
                    </nav>
                    <section>
                        <div class="content content-1">
                            <div class="title">Profile Details</div>
                            <hr class="profile-content-divider">
                            <table class="driver-profile-table">
                                <tr><td>Employee ID :</td><td><?=$row[0]->EmployeeID?></td></tr>
                                <tr><td>First Name :</td><td><?=$row[0]->Firstname?></td></tr>
                                <tr><td>Last Name :</td><td><?=$row[0]->Lastname?></td></tr>
                                <tr><td>Email :</td><td><?=$row[0]->Email?></td></tr>
                                <tr><td>Role :</td><td><?=$row[0]->Role?></td></tr>
                                <tr><td>Contact No :</td><td><?=$row[0]->Contactno?></td></tr>
                                <tr><td>Date :</td><td><?=$row[0]->Date?></td></tr>
                            </table>
                        </div>
                        <div class="content content-2">
                            <div class="title">Edit Profile Details</div>
                            <hr class="profile-content-divider">
                            <?php if(!empty($errors)):?>
                                <div class="error-txt signup-error">
                                    <ul>
                                        <?php foreach ($errors as $key => $value):?>
                                            <li><?=$errors[$key]?></li>
                                        <?php endforeach;?>
                                    </ul>
                                </div>
                            <?php endif;?>
                            <form method="post" enctype="multipart/form-data">
                                <table class="driver-profile-edit-table">
                                    <tr>
                                        <td class="edit-img-section">
                                            <img class="edit-img" src="<?=ROOT?>/<?=$row[0]->Image?>" alt="Profile Pic">
                                        </td>
                                        <td class="edit-btn-section">
                                            <label>
                                                Upload
                                                <input onchange="load_image(this.files[0])" type="file" name="Image">
                                            </label>
                                            <label>
                                                Delete
                                            </label>
                                        </td>
                                    </tr>
                                    <tr><td class="table-heading">Employee ID :</td><td class="table-value"><input type="text" name="EmployeeID" value="<?=set_value('EmployeeID',$row[0]->EmployeeID)?>" readonly></td></tr>
                                    <tr><td class="table-heading">First Name :</td><td class="table-value"><input type="text" name="Firstname" value="<?=set_value('Firstname',$row[0]->Firstname)?>"></td></tr>
                                    <tr><td class="table-heading">Last Name :</td><td class="table-value"><input type="text" name="Lastname" value="<?=set_value('Lastname',$row[0]->Lastname)?>"></input></td></tr>
                                    <tr><td class="table-heading">Email :</td><td class="table-value"><input type="email" name="Email" value="<?=set_value('Email',$row[0]->Email)?>"></td></tr>
                                    <tr><td class="table-heading">Role :</td><td class="table-value"><input type="text" name="Role" value="<?=set_value('Role',$row[0]->Role)?>" readonly></td></tr>
                                    <tr><td class="table-heading">Contact No :</td class="table-value"><td><input type="text" name="Contactno" value="<?=set_value('Contactno',$row[0]->Contactno)?>"></td></tr>
                                    <tr><td class="table-heading">Date :</td><td class="table-value"><input type="text" name="Date" value="<?=set_value('Date',$row[0]->Date)?>" readonly></input></td></tr>
                                </table>
                                <button type="submit" class="profile-save-btn">Save</button>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

</div>
</body>
<script src="<?=ROOT?>/assets/javascript/driver-profile.js"></script>
</html>