<?php $this->view('designer/includes/header') ?>

<body class="designer">
    <div class="designer-body">
        <?php $this->view('designer/includes/designer_header') ?>
        <div class="content dashboard">

            <div class="des-form-body">

                <div class="design_header">
                    <h1>Add New Designs</h1>
                    <button onclick="openDesignDetailsPopup()">Designs Status</button>
                </div>

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
                            <label onclick="location.href='<?=ROOT?>/designer/add_design';">
                                Reset
                            </label>
                        </div>
                    </div>

                    <div class="des_Name">
                        <label>Design Name :</label>
                        <input type="text" name="Name" placeholder="Enter Your Design Name" class="txt">
                    </div>

                    <div class="des_Name">
                        <label>Select Design category :</label>
                        <?php
                            $categories = new Categories();
                            $rows = $categories->findAll();
                        ?>
                        <select name="CategoryID">
                            <option>----- Category Type ----</option>
                            <?php foreach ($rows as $row) :?>
                                <option value="<?=$row->CategoryID?>"><?=$row->Category_name?></option>
                            <?php endforeach;?>
                        </select>
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

            <div class="popup details-info-popup" id="details-info-popup">
                <div class="popup-heading">
                    <h2 id="design-id"></h2>
                    <img src="<?= ROOT ?>/assets/images/designer/close.png" alt="Close" onclick="closeDesignDetailsPopup()">
                </div>

                <div class="order-selections">
                    <div class="selector designs-selector" name="selector" id="accepted" onclick="getDesignsByStatus('Accepted')">Accepted Designs</div>
                    <div class="selector designs-selector" name="selector" id="rejected" onclick="getDesignsByStatus('Rejected')">Rejected Designs</div>
                </div>

                <table class="designs-details-table">
                    <thead>
                    <tr>
                        <th>Design ID</th>
                        <th>Image</th>
                        <th>Design Name</th>
                        <th>Designer</th>
                        <th>Status</th>
                        <th>Furniture Category</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody id="t-body">

                    </tbody>
                </table>

            </div>
            <div class="cat-response" id="response">

            </div>

        </div>
    </div>
</body>
<script src="<?= ROOT ?>/assets/javascript/script.js"></script>
<script src="<?= ROOT ?>/assets/javascript/designer/add_designs.js"></script>
<script src="<?= ROOT ?>/assets/javascript/designer/add_pdf.js"></script>
<script src="<?= ROOT ?>/assets/javascript/designer/design_status.js"></script>
</html>
