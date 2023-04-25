<?php $data['row'] = $row; $this->view('reg_customer/includes/header',$data); ?>

    <div class="sub-category-body">
        <div class="sub-cat-sidebar">
            <?php foreach ($sub_categories as $sub_category): ?>
                <div class="sub-cat">
                    <a href="<?=ROOT?>/category/sub_category/<?=$id?>/<?=$sub_category->Sub_category_name?>" >
                        <p><?=$sub_category->Sub_category_name?></p>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="cat-products-body">
            <div class="cat-products">
                <?php if(!empty($furniture)): ?>
                    <?php foreach ($furniture as $row):?>
                        <?php $data['row'] = $row; $this->view('reg_customer/includes/product_card',$data); ?>
                    <?php endforeach;?>
                <?php else: ?>
                    <h1>No products to show.</h1>
                <?php endif; ?>
            </div>
            <?php $pager->display()?>
        </div>
    </div>

    <script src="<?=ROOT?>/assets/javascript/customer_profile.js"></script>
    <script src="<?=ROOT?>/assets/javascript/product_card.js"></script>
<?php $this->view('reg_customer/includes/footer'); ?>