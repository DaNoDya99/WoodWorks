<?php $this->view('designer/includes/header'); ?>
    <body class="designer">
        <div class="designer-body">
        <?php $this->view('designer/includes/designer_header') ?>

            <div class="content dashboard">

            <div class="add-des-bar">

                <a class="go-back" href="<?=ROOT?>/designer/design">
                    <img src="<?=ROOT?>/assets/images/designer/back.png" alt="Back Button">
                    <h1>Back</h1>
                </a>


                <div class="design-btns">
                    <button onclick="openDocumentPopup('<?=$design[0]->DesignID?>','<?=$design[0]->Name?>','<?=$design[0]->DesignerID?>','<?=$design[0]->Description?>','<?=$images[0]->Image?>','<?=$images[1]->Image?>','<?=$images[2]->Image?>','<?=$design[0]->Pdf?>',event)">Update</button>

                    <form action="<?=ROOT?>/designer/remove_add_design/<?=$data['design'][0]->DesignID?>" method="post">
                        <input type="submit" name="delete_btn" value="Remove">
                    </form>

                </div>

            </div>

                <div class="design-view">
                    <div class="design-desc-section">
                        <div class="design-img">
                            <div class="design-slide-show-container">

                                <div class="my-slides fade">
                                    <div class="number-text">1 / 3</div>
                                    <img src="<?=ROOT?>/<?=$images[0]->Image?>" alt="">
                                </div>

                                <div class="my-slides fade">
                                    <div class="number-text">2 / 3</div>
                                    <img src="<?=ROOT?>/<?=$images[1]->Image?>" alt="">
                                </div>

                                <div class="my-slides fade">
                                    <div class="number-text">3 / 3</div>
                                    <img src="<?=ROOT?>/<?=$images[2]->Image?>" alt="">
                                </div>

                                <a class="prev" onclick="plusSlides(-1)">&#10094</a>
                                <a class="next" onclick="plusSlides(1)">&#10095</a>
                            </div>

                            <br>
                        </div>

                        <div class="design-desc">

                            <div class="design-detail">
                                <table>
                                    <tr><th>Design Name : </th><td><?=$design[0]->Name?></td></tr>
                                    <tr><th>Designer ID : </th><td><?=$design[0]->DesignerID?></td></tr>
                                    <tr><th>Date : </th><td><?=$design[0]->Date?></td></tr>
                                    <tr><th>Description : </th><td><?=$design[0]->Description?></td></tr>
                                </table>
                            </div>

                        </div>

                    </div>


                    <div id="upl-docs">
                        <img class="close-btn" onclick="closeDocumentPopup()" src="<?=ROOT?>/assets/images/driver/close.png" alt="close button">
                        <h2>Update Design</h2>
                        <form class="add-des-form" id="edit-doc-form" method="post" enctype="multipart/form-data">


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
                                <div class="edit-des-Ubtn-section-update" id="edit-design">
                                    <input onchange="preview()" type="file" style="display: none;" name="images[]" id="file-input" multiple>
                                    <label for="file-input"> Update Images</label>
                                </div>
                                <div class="edit-des-Ubtn-section" id="edit-design">
                                    <input type="file" onchange="showPdfPreview()" style="display: none" name="pdfFile-input" id="pdfFile-input">
                                    <label for="pdfFile-input">Update Pdf</label>
                                </div>

                            </div>

                            <div class="des_Name">
                                <label>Design Name :</label>
                                <input type="text" name="Name" id="doc-field1" placeholder="Enter Your Design Name" class="txt">
                            </div>

                            <div id="description">
                                <label>Description :</label>
                                <textarea name="Description" class="form-control" id="doc-field2" placeholder="Design Description"></textarea>
                            </div>

                            <div class="add-des-btn">
                                <button id="doc-btn" type="submit">Update Design</button>
                            </div>

                        </form>

                    </div>


                </div>
            </div>
        </div>

        <div class="cat-response" id="response">

        </div>

    </body>

    <script src="<?= ROOT ?>/assets/javascript/designer/add_designs.js"></script>
    <script src="<?= ROOT ?>/assets/javascript/designer/add_pdf.js"></script>
    <script src="<?=ROOT?>/assets/javascript/designer/update_design.js"></script>
    <script src="<?=ROOT?>/assets/javascript/designer/slider.js"></script>

