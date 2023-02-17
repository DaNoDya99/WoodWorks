<?php $this->view('designer/includes/header') ?>

<body class="designer">
    <div class="designer-body">
        <?php $this->view('designer/includes/designer_header') ?>
        <div class="content dashboard">

            <div class="des-form-body">

                <form class="add-des-form" action="/woodworks/public/designer/add_new_design" method="post" enctype="multipart/form-data">

                    <h2>Add New Designs</h2>
                    <div class="des-img-upload-container">
                        <div class="des-img">

                            <label id="designImage">Design Images</label>

                            <div class="designImage">

                                <div id="images">
                                    <img id="first-img" src="<?= ROOT ?>/assets/images/designer/No_image.jpg" alt="Design Image">
                                    <img id="second-img" src="<?= ROOT ?>/assets/images/designer/No_image.jpg" alt="Design Image">
                                    <img id="third-img" src="<?= ROOT ?>/assets/images/designer/No_image.jpg" alt="Design Image">
                                </div>
                                <p id="num-of-files">Number of Images Chosen: None</p>

                            </div>
                        </div>
                    </div>

                    <?php if (!empty($errors['Description'])) : ?>
                        <div class="error-txt"><?= $errors['Description'] ?></div>
                    <?php endif; ?>
                    <?php if (!empty($errors['Name'])) : ?>
                        <div class="error-txt"><?= $errors['Name'] ?></div>
                    <?php endif; ?>

                    <div class="edit-des-Ubtn-section" id="edit-design">
                        <input onchange="preview()" type="file" style="display: none;" name="images[]" id="file-input" multiple>
                        <label for="file-input">
                            Upload Images
                        </label>
                    </div>

                    <div class="edit-des-Dbtn-section" id="edit-design">
                        <label onclick="location.reload();">
                            Delete Images
                        </label>
                    </div>

                    <div class="des_Name">
                        <label>Design Name :</label>
                        <input type="text" name="Name" placeholder="Enter Your Design Name" class="txt">
                    </div>

                    <div id="description">
                        <label>Description :</label>
                        <textarea name="Description" class="form-control" placeholder="Design Description"></textarea>
                    </div>

                    <div class="add-des-btn">
                        <button type="submit" name="AddDesign">Add Design</button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</body>


</html>
<script src="<?= ROOT ?>/assets/javascript/designer/add_designs.js"></script>