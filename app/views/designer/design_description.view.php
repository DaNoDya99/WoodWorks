<?php $this->view('designer/includes/header'); ?>
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
                    <a href="<?=ROOT?>/logout">
                        <h1>Logout</h1>
                    </a>
                </div>
            </div>

            <div class="add-des-bar">

                <a class="go-back" href="<?=ROOT?>/designer/design">
                    <img src="<?=ROOT?>/assets/images/designer/back.png" alt="Back Button">
                    <h1>Back</h1>
                </a>

                <div class="design-btns">
                    <button>Update</button>
                    <button>Remove</button>
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
                                    <tr><th>Manager ID : </th><td><?=$design[0]->ManagerID?></td></tr>
                                    <tr><th>Date : </th><td><?=$design[0]->Date?></td></tr>
                                    <tr><th>Description : </th><td><?=$design[0]->Description?></td></tr>
                                </table>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </body>

    <script src="<?=ROOT?>/assets/javascript/designer/slider.js"></script>
<?php $this->view('designer/includes/footer'); ?>