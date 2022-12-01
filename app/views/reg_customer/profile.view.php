<?php $data['row'] = $row; $this->view('reg_customer/includes/header',$data); ?>

<div class="cus-profile-body">
    <div class="decorate-card card-left">
        <img src="<?=ROOT?>/assets/images/customer/left_dec.jpg" alt="">
    </div>
    <div class="cus-profile-card">
        <div class="cus-pro-img-sec">
            <img src="<?=ROOT?>/<?=$row[0]->Image?>" alt="No Profile">
            <h1><?=$row[0]->Firstname?> <?=$row[0]->Lastname?></h1>
        </div>
        <div class="cus-pro-info">
            <hr>
            <table>
                <tr><th>Email : </th><td><?=$row[0]->Email?></td></tr>
                <tr><th>Gender : </th><td><?=$row[0]->Gender?></td></tr>
                <tr><th>Address : </th><td><?=$row[0]->Address?></td></tr>
                <tr><th>Contact no : </th><td><?=$row[0]->Mobileno?></td></tr>
            </table>
            <hr>
        </div>
        <div class ="edit-cus-pro-btn-sec">
            <button onclick="openPopup()">Edit Profile</button>

            <div class="popup" id="popup">
                <div class="popup-heading">
                    <h2>Edit Profile</h2>
                    <img src="<?=ROOT?>/assets/images/customer/close.png" alt="Close" onclick="closePopup()">
                </div>
                <form method="post" enctype="multipart/form-data">
                    <div class="image-field">
                        <img src="<?=ROOT?>/<?=$row[0]->Image?>" alt="No profile pic">
                        <label>
                            Upload
                            <input onchange="load_image(this.files[0])" type="file" name="Image">
                        </label>
                    </div>
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
                        <label>Gender</label>
                        <select name="Gender" >
                            <option value="<?=$row[0]->Gender?>" selected><?=$row[0]->Gender?></option>
                            <option value="<?=$row[0]->Gender != "Male" ? "Male":"Female"?> ?>"><?=$row[0]->Gender != "Male" ? "Male":"Female"?></option>
                        </select>
                    </div>
                    <div class="edit-cus-field">
                        <label>Address</label>
                        <input type="text" name="Address" value="<?=$row[0]->Address?>">
                    </div class="edit-cus-field">
                    <div class="edit-cus-field">
                        <label>Contact no</label>
                        <input type="text" name="Mobileno" value="<?=$row[0]->Mobileno?>">
                    </div>
                    <button type="submit" onclick="closePopup()" >Save</button>
                </form>
            </div>
        </div>
    </div>
    <div class="decorate-card card-right">
        <img src="<?=ROOT?>/assets/images/customer/right_dec.jpg" alt="">
    </div>
</div>

<script src="<?=ROOT?>/assets/javascript/customer_profile.js"></script>

<?php $this->view('reg_customer/includes/footer'); ?>
