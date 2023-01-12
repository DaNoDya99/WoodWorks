<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - Woodworks</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/styles.css">
        
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/supplier/profile-style.css">


    <style>
    </style>
</head>

<body onload="timedelload()">
    <?php $this->view('supplier/supplier.header', $data) ?>

    <div class="sec1">
        <?php $this->view('supplier/supplier.nav', $data) ?>
    </div>
    <div class="sec2" style="display: grid;">


        <div class="dashboard-body">

            <div class="admin-profile-card">
                <div class="admin-pro-img-sec">
                    <img src="<?= ROOT ?>/<?= $row[0]->Image ?>" alt="No Profile">
                    <h1><?= $row[0]->Firstname ?> <?= $row[0]->Lastname ?></h1>
                    <h2>Supplier</h2>
                </div>
                <hr>
                <div class="admin-pro-info">
                    <table>
                        <tr>
                            <th>Supplier ID : </th>
                            <td><?= $row[0]->SupplierID ?></td>
                        </tr>
                        <tr>
                            <th>Email : </th>
                            <td><?= $row[0]->Email ?></td>
                        </tr>
                        <tr>
                            <th>Contact No : </th>
                            <td><?= $row[0]->Contactno ?></td>
                        </tr>
                        
                    </table>
                </div>
                <hr>
                <div class="edit-cus-pro-btn-sec">
                    <button onclick="openPopup()">Edit Profile</button>

                    <div class="popup admin-popup" id="popup">
                        <div class="popup-heading">
                            <h2>Edit Profile</h2>
                            <img src="<?= ROOT ?>/assets/images/customer/close.png" alt="Close" onclick="closePopup()">
                        </div>
                        <form method="post" enctype="multipart/form-data">
                            <div class="image-field admin-edit-img">
                                <img src="<?= ROOT ?>/<?= $row[0]->Image ?>" alt="No profile pic">
                                <label>
                                    Upload
                                    <input onchange="load_image(this.files[0])" type="file" name="Image">
                                </label>
                            </div>
                            <hr>
                            <div class="name-field">
                                <div class="edit-cus-field first-name">
                                    <label>First Name</label>
                                    <input type="text" name="Firstname" value="<?= $row[0]->Firstname ?>">
                                </div>
                                <div class="edit-cus-field last-name">
                                    <label>Last Name</label>
                                    <input type="text" name="Lastname" value="<?= $row[0]->Lastname ?>">
                                </div>
                            </div>
                            <div class="edit-cus-field">
                                <label>Email</label>
                                <input type="email" name="Email" value="<?= $row[0]->Email ?>">
                            </div>
                            <div class="edit-cus-field">
                                <label>Contact No</label>
                                <input type="text" name="Contactno" value="<?= $row[0]->Contactno ?>">
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

</html>

<script>
    function load_image(file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.querySelector(".Image").src = e.target.result;
            document.querySelector(".imagename").innerHTML = "Selected File: " + file.name;
        }
        reader.readAsDataURL(file);
    }

    function timedelload() {
        setTimeout(function() {
            document.getElementById("panel").style.marginTop = "130px";
            document.getElementById("panel").style.opacity = "1";
        }, 200);
    }

    function timedelexit() {
        setTimeout(function() {
            document.getElementById("panel").style.opacity = 0;
            document.getElementById("panel").style.marginTop = "150px";
        }, 200);
    }

   

    let popup = document.getElementById('popup');
    let profile_card = document.querySelector('.admin-profile-card');
    let closeBtn = document.querySelector('.popup-heading img');

    function openPopup() {
        popup.classList.add("open-popup");
        profile_card.style.visibility = 'hidden';
    }

    function closePopup() {
        popup.classList.remove("open-popup");
        profile_card.style.visibility = 'visible';
    }

    function load_image(file) {
        let mylink;
        mylink = window.URL.createObjectURL(file);
        document.querySelector(".image-field img").src = mylink;
    }
</script>