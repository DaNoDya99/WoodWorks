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
        <div class="content">
            <h3 class="text">Welcome <?=Auth::getLastname()?></h3><br>
            <hr><br>
            <h3 id="deli-hed"> New Designs</h3><br>
            <img class="deli-pict" src="<?=ROOT?>/assets/images/designer/design.jpg" alt="Delivery picture">
            <p class="para">
                “WoodWorks” is a management system for a furniture selling shop. “WoodWorks” has the
                capability of buy furniture from the suppliers and sell for the customers. For customers if they
                want to sell their used furniture then they can put an advertisement in the system. The
                company provides the delivery service if the customers want it. There are designers who are
                working for the system, provide new furniture designs for the company. “WoodWorks” is the
                automated system for the shop which consist of an online ordering system, inventory
                management system, report generating system and a delivery system. This system is intended
                to maximize the revenue of the business and introduce an easy way to interact with the business
                for both the customers and employees.
            </p>
        </div>
    </div>
</div>
</body>
</html>