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
<body class="admin">
<div class="admin-body">
    <?php $this->view('includes/admin_sidebar') ?>
    <div class="dashboard">
        <div class="dashboard-nav">
            <div class="nav-item-page-name">
                <h1><?= $title ?></h1>
            </div>
            <div class="nav-item-user">
                <img src="<?=ROOT?>/assets/images/admin/user.png" alt="Profile picture">
                <div class="nav-vr"></div>
                <h1>Hi, <?=Auth::getFirstname()?></h1>
                <div class="nav-vr"></div>
                <a href="<?=ROOT?>/login1">
                    <h1>Logout</h1>
                </a>
            </div>
        </div>
        <div class="dashboard-body">
            <div class="profile-img-section">
                <img src="<?=ROOT?>/assets/images/admin/user.png" alt="">
                <h1><?=Auth::getFirstname()?> <?=Auth::getLastname()?></h1>
                <h2><?=Auth::getRole()?></h2>
            </div>
            <div class="profile-details-section">
                <div class="wrapper">
                    <input type="radio" name="slider" id="overview" checked>
                    <input type="radio" name="slider" id="edit">
                    <nav>
                        <label for="overview"  class="overview">Overview</label>
                        <label for="edit"  class="edit-info">Edit</label>
                        <div class="slider"></div>
                    </nav>
                    <section>
                        <div class="content content-1">
                            <div class="title">Profile Details</div>
                            <hr class="profile-content-divider">
                            <table class="admin-profile-table">
                                <tr><td>Employee ID :</td><td><?=Auth::getEmployeeID()?></td></tr>
                                <tr><td>First Name :</td><td><?=Auth::getFirstname()?></td></tr>
                                <tr><td>Last Name :</td><td><?=Auth::getLastname()?></td></tr>
                                <tr><td>Email :</td><td><?=Auth::getEmail()?></td></tr>
                                <tr><td>Role :</td><td><?=Auth::getRole()?></td></tr>
                                <tr><td>Contact No :</td><td><?=Auth::getContactno()?></td></tr>
                                <tr><td>Date :</td><td><?=Auth::getDate()?></td></tr>
                            </table>
                        </div>
                        <div class="content content-2">
                            <div class="title">Edit Profile Details</div>
                            <hr class="profile-content-divider">
                            <form method="post">
                                <table class="admin-profile-edit-table">
                                    <tr><td class="table-heading">Employee ID :</td><td class="table-value"><input type="text" value="<?=Auth::getEmployeeID()?>" readonly></td></tr>
                                    <tr><td class="table-heading">First Name :</td><td class="table-value"><input type="text" value="<?=Auth::getFirstname()?>"></td></tr>
                                    <tr><td class="table-heading">Last Name :</td><td class="table-value"><input type="text" value="<?=Auth::getLastname()?>"></input></td></tr>
                                    <tr><td class="table-heading">Email :</td><td class="table-value"><input type="email" value="<?=Auth::getEmail()?>"></td></tr>
                                    <tr><td class="table-heading">Role :</td><td class="table-value"><input type="text" value="<?=Auth::getRole()?>" readonly></td></tr>
                                    <tr><td class="table-heading">Contact No :</td class="table-value"><td><input type="text" value="<?=Auth::getContactno()?>"></td></tr>
                                    <tr><td class="table-heading">Date :</td><td class="table-value"><input type="text" value="<?=Auth::getDate()?>" readonly></input></td></tr>
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
</html>