<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - Woodworks</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/supplier/style.css">
    <style>
    </style>
</head>

<body onload="timedelload()">
    <?php $this->view('supplier/supplier.header', $data) ?>

    <div class="sec1">
        <?php $this->view('supplier/supplier.nav', $data) ?>
    </div>
    <div class="sec2" style="display: grid;">


        <div class="data" id="panel">


            <hr>
            <h3 style="font-weight:500; margin-left:30px;">Profile</h3>
            <div class="grid">

                <div class="fields">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="name-form" style="display: grid; grid-template-columns: 1fr 1fr; grid-column-gap:10px; grid-row-gap:15px">

                            <div>
                                <label for="First Name">First Name</label>
                                <input class="form-textbox type=" text" name="Firstname" value="<?= set_value("Firstname", $row->Firstname) ?>" id="Firstname"><br>
                                <?php if (!empty($errors['Firstname'])) : ?>
                                    <small class="form-error"><?= $errors["Firstname"] ?></small>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label for="Last Name">Last Name</label>
                                <input class="form-textbox type=" text" name="Lastname" value="<?= set_value("Lastname", $row->Lastname) ?>" id="Lastname"><br>
                                <?php if (!empty($errors['Lastname'])) : ?>
                                    <small class="form-error"><?= $errors["Lastname"] ?></small>
                                <?php endif; ?>
                            </div>

                            <!-- <div class="col1">

                            <label for="emID"> Employee ID</label><br>
                            <input class="form-textbox type=" text" name="SupplierID" value="<?= set_value(("SupplierID")) ?>" id="empID"><br>
                            <?php if (!empty($errors['SupplierID'])) : ?>
                                <small class="form-error"><?= $errors["SupplierID"] ?></small>
                            <?php endif; ?>


                        </div> -->
                            <div class="col1">
                                <label for="email">Email</label><br>
                                <input class="form-textbox type=" email" name="Email" value="<?= set_value("Email", $row->Email) ?>" id="email"><br>
                                <?php if (!empty($errors['Email'])) : ?>
                                    <small class="form-error"><?= $errors["Email"] ?></small>
                                <?php endif; ?>
                            </div>


                            <div class="col1">
                                <label for="Contactno">Contact Number</label>
                                <input class="form-textbox type=" tel" name="Contactno" value="<?= set_value("Contactno", $row->Contactno) ?>" id="contact"><br>
                                <?php if (!empty($errors['Contactno'])) : ?>
                                    <small class="form-error"><?= $errors["Contactno"] ?></small>
                                <?php endif; ?>
                            </div>
                            <div style="grid-column-start:1 ; grid-column-end:3">

                                <button type="submit">Submit</button>

                            </div>


                        </div>

                </div>
                <div style="display:grid; grid-template-rows:auto auto auto; justify-items:center; ">

                    <img class="Image" src="
                   
                    <?php if (empty($row->Image)) : ?>
                        <?= ROOT ?>/assets/images/supplier/user.png 
                    <?php else : ?>
                    <?= ROOT ?>/<?= ($row->Image) ?>
                    <?php endif; ?>
                    " alt="">
                    <div class="imagename">Selected File: None</div>

                    <div>
                        <label style="display: inline-block; height:17px; width:100px; background-color:blue; color:white; text-align:center; border-radius:5px; padding:10px; margin-top:10px" title="Upload">
                            <i>Upload</i>
                            <input onchange="load_image(this.files[0])" type="file" name="image" style="display: none;">
                        </label>
                        <label style="display: inline-block; height:17px; width:100px; background-color:red; border-radius:5px; padding:10px; margin-top:10px; text-align:center; " title="Upload">
                            <i>Delete</i>
                        </label>
                    </div>
                </div>
                </form>
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

    function delay(URL) {
        setTimeout(function() {
            window.location = URL
        }, 500);
    }
</script>