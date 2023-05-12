
<?php

$advertisements = '';

for($i = 0 ; $i < count($categories); $i++)
{
    if($categories[$i]->Category_name === "Refurbished Furniture")
    {
        $advertisements = $categories[$i];
        unset($categories[$i]);
    }
}

?>

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

        <a href="<?=ROOT?>/advertisement/viewAdvertisements">
            <div class="category-card">
                <img src="<?=ROOT?>/<?=$advertisements->Image?>" alt="category image" loading="lazy">
                <p><?=$advertisements->Category_name?></p>
            </div>
        </a>
    </div>
</div>

<?php $this->view('reg_customer/includes/footer'); ?>