<?php $this->view('manager/includes/header') ?>

<body class="manager">
<?php $this->view('manager/includes/manager_header') ?>
    <div class="manager-body content">
        <div class="ref-fur-container">
            <div class="ref-fur-slider">
                <img class="ref-fur-primary-img" src="<?=ROOT?>/<?= $primary_image[0]->Image?>" alt="">
                <div class="ref-fur-secondary-imgs">
                    <img src="<?=ROOT?>/<?= $secondary_images[0]->Image?>" alt="">
                    <img src="<?=ROOT?>/<?= $secondary_images[1]->Image?>" alt="">
                </div>
            </div>
            <div class = "ref-fur-details">
                <h1><?=$details->Name?></h1>
                <span><?=$details->DesignID?></span>
                <h2><?=$details->DesignerID?></h2>
                <p>
                    <?=$details->Description?>
                </p>

                <div class="designs-btns">
                    <button onclick="acceptDesign('<?=$details->DesignID?>')">Accept</button>
                    <button onclick="rejectDesign('<?=$details->DesignID?>')">Reject</button>
                </div>
            </div>
        </div>
    </div>

    <div id='response'>

    </div>

    

    <script src="<?=ROOT?>/assets/javascript/design_details.js"></script>
</body>
</html>