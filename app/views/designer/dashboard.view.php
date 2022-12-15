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
                <img src="<?=ROOT?>/assets/images/designer/user.png" alt="Profile picture">
                <div class="nav-vr"></div>
                <h1>Hi, <?=ucfirst(substr(Auth::getFirstname(),0,1))?>.<?=Auth::getLastname()?></h1>
                <div class="nav-vr"></div>
                <a href="<?=ROOT?>/login3">
                    <h1>Logout</h1>
                </a>
            </div>
        </div>

        <div class="containers">

            <div class="box" id="chart-container">
                <canvas id="designerPie" width="100" height="100"> </canvas>
            </div>

            <div class="box" id="chart-container3"">
                <canvas id="designerLine" height="400" width="300"></canvas>
            </div>

            <div class="box" id="chart-container2">
                <canvas id="myBar" width="300" height="400"> </canvas>
            </div>

        </div>

    </div>
</div>
</body>
<?php $this->view('designer/includes/footer'); ?>
</html>