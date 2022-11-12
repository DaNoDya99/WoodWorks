<?php $this->view('reg_customer/includes/header'); ?>

<div class="cus-profile-body">
    <div class="decorate-card card-left">
        <img src="<?=ROOT?>/assets/images/customer/left_dec.jpg" alt="">
    </div>
    <div class="cus-profile-card">
        <div class="cus-pro-img-sec">
            <img src="<?=ROOT?>/<?=Auth::getImage()?>" alt="No Profile">
            <h1><?=Auth::getFirstname()?> <?=Auth::getLastname()?></h1>
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
                <h2>Edit Profile</h2>
                <form action="" method="post">
                    <div class="image-field">
                        <img src="<?=ROOT?>/<?=Auth::getImage()?>" alt="No profile pic">
                        <label>
                            Upload
                            <input onchange="load_image(this.files[0])" type="file" name="Image">
                        </label>
                    </div>
                    <div class="edit-cus-field">
                        <label>First Name</label>
                        <input type="text" name="Firstname" value="<?=$row[0]->Firstname?>">
                    </div>
                    <div class="edit-cus-field">
                        <label>Last Name</label>
                        <input type="text" name="Lastname" value="<?=$row[0]->Lastname?>">
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

<script>
    let popup = document.getElementById('popup');
    function openPopup(){
        popup.classList.add("open-popup");
    }
    function closePopup(){
        popup.classList.remove("open-popup");
    }
</script>

<?php $this->view('reg_customer/includes/footer'); ?>
