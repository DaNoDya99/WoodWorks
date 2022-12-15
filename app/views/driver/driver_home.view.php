<?php $this->view('driver/includes/header') ?>

<body class="driver">
<div class="driver-body">
    <?php $this->view('driver/includes/driver_sidebar') ?>
    <div class="dashboard">
        <div class="dashboard-nav">
            <div class="nav-item-page-name">
                <h1><?= $title ?></h1>
            </div>
            <div class="nav-item-user">
                <img src="<?=ROOT?>/assets/images/driver/user.png" alt="Profile picture">
                <div class="nav-vr"></div>
                <h1>Hi, <?=ucfirst(substr(Auth::getFirstname(),0,1))?>.<?=Auth::getLastname()?></h1>
                <div class="nav-vr"></div>
                <a href="<?=ROOT?>/logout3">
                    <h1>Logout</h1>
                </a>
            </div>
        </div>
        <form method="post" action="<?=ROOT?>/driver_home/availability">
            <button name="Availability" class="sbtn" >
                <?=$availability?>
                <span><img src="<?=ROOT?>/assets/images/driver/swipe.png" alt="Swipe picture" id="swipe"></span>
            </button>
        </form>

        <div class="containers">

            <div class="box" id="chart-container">
                <canvas id="myPie" width="100" height="100"> </canvas>
            </div>

            <div class="box" id="chart-container3"">
                <canvas id="myLine" height="400" width="300"></canvas>
            </div>

            <div class="box" id="chart-container2">
                <canvas id="myBar" width="300" height="400"> </canvas>
            </div>

        </div>
    </div>
</div>
</body>
<?php $this->view('driver/includes/footer'); ?>
</html>