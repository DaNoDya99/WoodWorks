<?php $this->view('designer/includes/header') ?>

<body class="designer">
    <div class="designer-body">
        <?php $this->view('designer/includes/designer_header') ?>
        <div class="content dashboard">

            <div class="des-form-body">

                <h1>Add New Designs</h1>

                <form class="add-des-form" action="/woodworks/public/designer/add_new_design" method="post" enctype="multipart/form-data">

                    <!--  This is  error message   -->
                    <?php if (!empty($errors)) : ?>
                        <div class="error-txt signup-error">
                            <img class="close-error" src="<?= ROOT ?>/assets/images/designer/close.png" alt="Close btn" onclick="close_error()">
                            <ul>
                                <?php foreach ($errors as $key => $value) : ?>
                                    <li><?= $errors[$key] ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <div class="des-img-upload-container">
                        <div class="des-img">

                            <label id="designImage">Design Images & Design Details Pdf Document</label>

                            <div class="designImage">

                                <div id="images">
                                    <img id="first-img" src="<?= ROOT ?>/assets/images/designer/No_image.jpg" alt="Design Image">
                                    <img id="second-img" src="<?= ROOT ?>/assets/images/designer/No_image.jpg" alt="Design Image">
                                    <img id="third-img" src="<?= ROOT ?>/assets/images/designer/No_image.jpg" alt="Design Image">
                                </div>
                                <div id="pdf-preview"></div>
                                <p id="num-of-files">Number of Images Chosen: None<br><b>You need to choose three images and one pdf document</b></p>

                            </div>
                        </div>
                    </div>

                    <div class="but-img-upload-container">
                        <div class="edit-des-Ubtn-section" id="edit-design">
                            <input onchange="preview()" type="file" style="display: none;" name="images[]" id="file-input" multiple>
                            <label for="file-input"> Upload Images</label>
                        </div>
                        <div class="edit-des-Ubtn-section" id="edit-design">

                            <input type="file" onchange="showPdfPreview()" style="display: none" name="pdfFile-input" id="pdfFile-input">
                            <label for="pdfFile-input">Upload Pdf</label>
                        </div>
                        <div class="edit-des-Dbtn-section" id="edit-design">
                            <label onclick="location.reload();">
                                Delete Images & Pdf
                            </label>
                        </div>
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
<script src="<?= ROOT ?>/assets/javascript/script.js"></script>
<script src="<?= ROOT ?>/assets/javascript/designer/add_designs.js"></script>
<script src="<?= ROOT ?>/assets/javascript/designer/add_pdf.js"></script>
</html>
