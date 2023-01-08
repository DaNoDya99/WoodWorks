<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/supplier/style.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/styles.css">

    <STYLE>

@media screen and (max-width:700px) {
    .admin-profile-card{
        width: 100%;
    }
}
    </STYLE>
</head>

<body>
    <?php $this->view('supplier/supplier.header', $data) ?>
    <div class="content">

        <div class="admin-profile-card">
            <div class="admin-pro-img-sec">
                <img src="<?= ROOT ?>/<?= $row[0]->Image ?>" alt="No Profile">
                <h1><?= $row[0]->Firstname ?> <?= $row[0]->Lastname ?></h1>
                <h2></h2>
            </div>
            <hr>
            <div class="admin-pro-info">
                <table>
                    <tr>
                        <th>Employee ID : </th>
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
                    <tr>
                        <th>Date : </th>
                        <!-- <td><?= $row[0]->Date ?></td> -->
                    </tr>
                </table>
            </div>
            <hr>
            <div class="edit-cus-pro-btn-sec">
                <button onclick="openPopup()">Edit Profile</button>

                <div class="popup admin-popup" style="" id="popup">
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
    <script src="<?= ROOT ?>/assets/javascript/header/header.js"></script>
    <script>
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
</body>

</html>