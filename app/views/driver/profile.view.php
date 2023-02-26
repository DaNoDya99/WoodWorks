<?php $this->view('driver/includes/header') ?>

<body class="driver">
<?php $this->view('driver/includes/driver_header') ?>
<div class="content driver-body">

    <div class="dashboard">

        <div class="dashboard-body">
            <div class="driver-profile-card">
                <div class="driver-pro-img-sec">
                    <img src="<?=ROOT?>/<?=$row[0]->Image?>" alt="No Profile">
                    <h1><?=$row[0]->Firstname?> <?=$row[0]->Lastname?></h1>
                    <h2><?=$row[0]->Role?></h2>
                </div>
                <hr>
                <div class="driver-pro-info">
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

                    <div class="popup driver-popup" id="popup">
                        <div class="popup-heading">
                            <h2>Edit Profile</h2>
                            <img src="<?=ROOT?>/assets/images/driver/close.png" alt="Close" onclick="closePopup()">
                        </div>
                        <form method="post" enctype="multipart/form-data">
                            <div class="image-field driver-edit-img">
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
<script src="<?=ROOT?>/assets/javascript/driver/driver-profile.js"></script>
</html>