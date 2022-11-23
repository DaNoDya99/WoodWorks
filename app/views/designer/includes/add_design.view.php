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

        <a class="go-back" href="<?=ROOT?>/designer/design">
            <img src="<?=ROOT?>/assets/images/designer/back.png" alt="Back Button">
            <h1>Back</h1>
        </a>

        <div class="des-form-body">

            <?php if(!empty($errors)):?>
                <div class="error-txt signup-error">
                    <ul>
                        <?php foreach ($errors as $key => $value):?>
                            <li><?=$errors[$key]?></li>
                        <?php endforeach;?>
                    </ul>
                </div>
            <?php endif;?>

            <form action="/woodworks/public/designer/add_new_design" method="post" enctype="multipart/form-data">

                <h2>Add New Design</h2>

                <label id="designImage" >Design Images</label>

                <div class="designImage">
                    <img class="js-image-preview" src="<?=ROOT?>/assets/images/designer/default_furniture2.png" alt="designs">
                    <div class="js-filename">Selected Files:</div>
                </div>

                <div class="edit-des-Ubtn-section" id="edit-design">
                    <label>
                        Upload Images
                        <input onchange="load_image(this.files)" type="file" style="display: none;" name="images[]" multiple >
                    </label>
                </div>

                <div class="edit-des-Dbtn-section" id="edit-design">
                    <label>
                        Delete Images
                    </label>
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
</html>
