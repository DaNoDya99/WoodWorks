<?php $data['row'] = $row; $this->view('reg_customer/includes/header',$data); ?>

<div class="category-body">
    <h1>What Are You Looking For?</h1>
    <div class="categories">
        <?php foreach ($categories as $category) :?>
            <a href="<?=ROOT?>/category/sub_category/<?=$category->CategoryID?>">
                <div class="category-card">
                    <img src="<?=ROOT?>/<?=$category->Image?>" alt="category image" loading="lazy">
                    <p><?=$category->Category_name?></p>
                </div>
            </a>
        <?php endforeach;?>
    </div>
</div>

<?php $this->view('reg_customer/includes/footer'); ?>