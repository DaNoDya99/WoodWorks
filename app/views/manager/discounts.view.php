<?php $this->view('manager/includes/header') ?>

<body class="manager">
    <div class="manager-body">
        <?php $this->view('manager/includes/manager_sidebar') ?>
        <div class="dashboard">
            <div class="dashboard-nav">
                <div class="nav-item-page-name">
                    <h1><?= $title ?></h1>
                </div>
                <div class="nav-item-user">
                    <img src="<?=ROOT?>/assets/images/manager/user.png" alt="Profile picture">
                    <div class="nav-vr"></div>
                    <h1>Hi, <?=Auth::getFirstname()?></h1>
                    <div class="nav-vr"></div>
                    <a href="<?=ROOT?>/logout">
                        <h1>Logout</h1>
                    </a>
                </div>

                
            </div>
            
            <div class="discount-container">
                <div class="discount-header">
                    <div>
                        <h1><?=$furniture[0]->Name?></h1>
                        <h2>Discount: <?= !empty($furniture[0]->Discount_percentage) ? $furniture[0]->Discount_percentage : 0?>%</h2>
                    </div>
                    <img src="<?=ROOT?>/<?=$image[0]->Image?>" alt="Product Image">
                </div>
                <div class="discount-form">
                    <form method="post">
                        <div>
                            <label>Discount</label>
                            <input type="text" name="Discount_percentage" placeholder="Enter Discount">
                        </div>

                        <button>Add Discount</button>
                    </form>
                </div>
            </div>


        </div>
        
    </div>
    
</body>
</html>