<?php $data['row'] = $row; $this->view('designer/includes/header',$data) ?>

<body class="designer">
<div class=" designer-body">
    <?php $this->view('designer/includes/designer_header') ?>
    <div class="content dashboard">

            <div class="category-body">
                <h1>New Design Categories</h1>
                <div class="categories">
                    <?php if(!empty($categories)): ?>
                    <?php foreach ($categories as $category) :?>
                        <a href="<?=ROOT?>/designer/design/<?=$category->CategoryID?>">
                            <div class="category-card">
                                <img src="<?=ROOT?>/<?=$category->Image?>" alt="category image" loading="lazy">
                                <p><?=$category->Category_name?></p>
                            </div>
                        </a>
                    <?php endforeach;?>
                    <?php else :?>
                        <h1>No design Categories to show.</h1>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</body>