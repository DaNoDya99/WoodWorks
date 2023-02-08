<?php $this->view('manager/includes/header') ?>

<body class="manager">
<?php $this->view('manager/includes/manager_header') ?>
    <div class="content manager-body ">
        <div class="dashboard">
           
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