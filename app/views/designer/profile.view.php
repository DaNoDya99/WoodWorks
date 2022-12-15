<?php $this->view('designer/includes/header') ?>

<body class="designer">
<div class="designer-body">
    <?php $this->view('designer/includes/designer_sidebar') ?>
    <div class="dashboard">

        <div class="dashboard-nav">
            <div class="nav-item-page-name">
                <h1><?= $title ?></h1>
            </div>
            <div class="nav-item-user">
                <img src="<?=ROOT?>/assets/images/designer/user.png" alt="Profile picture">
                <div class="nav-vr"></div>
                <h1>Hi, <?=ucfirst(substr(Auth::getFirstname(),0,1))?>.<?=Auth::getLastname()?></h1>
                <div class="nav-vr"></div>
                <a href="<?=ROOT?>/logout3">
                    <h1>Logout</h1>
                </a>
            </div>
        </div>

        <div class="dashboard-body">
            <div class="designer-profile-card">
                <div class="designer-pro-img-sec">
                    <img src="<?=ROOT?>/<?=$row[0]->Image?>" alt="No Profile">
                    <h1><?=$row[0]->Firstname?> <?=$row[0]->Lastname?></h1>
                    <h2><?=$row[0]->Role?></h2>
                </div>
                <hr>
                <div class="designer-pro-info">
                    <table>
                        <tr><th>Employee ID : </th><td><?=$row[0]->EmployeeID?></td></tr>
                        <tr><th>Email : </th><td><?=$row[0]->Email?></td></tr>
                        <tr><th>Contact No : </th><td><?=$row[0]->Contactno?></td></tr>
                        <tr><th>Date : </th><td><?=$row[0]->Date?></td></tr>
                    </table>
                </div>
                <hr>
                <div class ="edit-cus-pro-btn-sec">
                    <button onclick="openPopup()">Edit Profile</button>

                    <div class="popup designer-popup" id="popup">
                        <div class="popup-heading">
                            <h2>Edit Profile</h2>
                            <img src="<?=ROOT?>/assets/images/designer/close.png" alt="Close" onclick="closePopup()">
                        </div>
                        <form method="post" enctype="multipart/form-data">
                            <div class="image-field designer-edit-img">
                                <img src="<?=ROOT?>/<?=$row[0]->Image?>" alt="No profile pic">
                                <label>
                                    Upload
                                    <input onchange="load_image(this.files[0])" type="file" name="Image">
                                </label>
                            </div>
                            <hr>
                            <div class="name-field">
                                <div class="edit-cus-field first-name">
                                    <label>First Name</label>
                                    <input type="text" name="Firstname" value="<?=$row[0]->Firstname?>">
                                </div>
                                <div class="edit-cus-field last-name">
                                    <label>Last Name</label>
                                    <input type="text" name="Lastname" value="<?=$row[0]->Lastname?>">
                                </div>
                            </div>
                            <div class="edit-cus-field">
                                <label>Email</label>
                                <input type="email" name="Email" value="<?=$row[0]->Email?>">
                            </div>
                            <div class="edit-cus-field">
                                <label>Contact No</label>
                                <input type="text" name="Contactno" value="<?=$row[0]->Contactno?>">
                            </div>

                            <button type="submit" onclick="closePopup()">Save</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
</body>
<?php $this->view('designer/includes/footer'); ?>
<script src="<?=ROOT?>/assets/javascript/designer/designer-profile.js"></script>
</html>