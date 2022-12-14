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
                <img src="<?=ROOT?>/<?=$row[0]->Image?>" alt="Profile picture">
                <div class="nav-vr"></div>
                <h1>Hi, <?=ucfirst(substr(Auth::getFirstname(),0,1))?>.<?=Auth::getLastname()?></h1>
                <div class="nav-vr"></div>
                <a href="<?=ROOT?>/logout3">
                    <h1>Logout</h1>
                </a>
            </div>
        </div>

        <div class="des-form-body">

            <form action="/woodworks/public/designer/add_new_design" method="post" enctype="multipart/form-data">

                <h2>Add New Designs</h2>

                <label id="designImage" >Design Images</label>

                <div class="designImage">

                    <div id="images"></div>
                    <p  id="num-of-files">Number of Images Chosen: None</p>

                </div>

                <?php if(!empty($errors['Description'])):?>
                    <div class="error-txt"><?=$errors['Description']?></div>
                <?php endif;?>
                <?php if(!empty($errors['Name'])):?>
                    <div class="error-txt"><?=$errors['Name']?></div>
                <?php endif;?>

                <div class="edit-des-Ubtn-section" id="edit-design">
                    <input onchange="preview()" type="file" style="display: none;" name="images[]" id="file-input" multiple>
                    <label for="file-input">
                        Upload Images
                    </label>
                </div>

                <div class="edit-des-Dbtn-section" id="edit-design">
                    <label>
                        Delete Images
                    </label>
                </div>

                <div class="des_Name">
                    <label>Design Name: </label>
                    <input type="text" name="Name" placeholder="Enter Your Design Name" class="txt">
                </div>

                <div id="description">
                    <label>Description :</label><textarea name="Description" class="form-control" ></textarea>
                </div>

                <div class="add-des-btn">
                    <button  type="submit" name="AddDesign">Add Design</button>
                </div>

            </form>

        </div>

    </div>
</div>
</body>
<?php $this->view('designer/includes/footer'); ?>
</html>
<script src="<?=ROOT?>/assets/javascript/designer/add_designs.js" ></script>

