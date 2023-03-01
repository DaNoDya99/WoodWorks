<?php $this->view('manager/includes/header') ?>

<body class="manager">
<?php $this->view('manager/includes/manager_header') ?>
    
    <div class="content manager-body">
        <div class="design-card-container">

            <?php foreach($designs as $row): ?>
                <a href="<?=ROOT?>/designer/design_details/<?=$row->DesignID?>">
                    <div class='design-card'>
                        <img src="<?=ROOT?>/<?=$row->Image?>" alt="">
                        <h3><?=$row->Name?></h3>
                    </div>
                </a>
                
            <?php endforeach; ?>
           
        </div>
        
    </div>

    <script src="<?=ROOT?>/assets/javascript/all_designs.js"></script>
</body>
</html>