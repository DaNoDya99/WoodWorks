<?php $this->view('includes/header'); ?>

    <div class="sub-category-body">
        <div class="sub-cat-sidebar">
            <?php if($sub_categories === 'Refurbished Furniture'): ?>
                <div class="sub-cat">
                    <a href="" >
                        <p><?=$sub_categories?></p>
                    </a>
                </div>
            <?php else: ?>
                <?php foreach ($sub_categories as $sub_category): ?>
                    <div class="sub-cat">
                        <a href="<?=ROOT?>/home/sub_category/<?=$id?>/<?=$sub_category->Sub_category_name?>" >
                            <p><?=$sub_category->Sub_category_name?></p>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="cat-products-body">
            <div class="cat-products">
                <?php if($flag === 'f'): ?>
                    <?php if(!empty($furniture)): ?>
                        <?php foreach ($furniture as $row):?>
                            <?php $data['row'] = $row; $this->view('includes/product_card',$data); ?>
                        <?php endforeach;?>
                    <?php else: ?>
                        <h1>No products to show.</h1>
                    <?php endif; ?>
                <?php elseif($flag === 'rf'): ?>
                    <?php if(!empty($furniture)): ?>
                        <?php foreach ($furniture as $row):?>
                            <?php $data['row'] = $row; $this->view('includes/advertisement_card',$data); ?>
                        <?php endforeach;?>
                    <?php else: ?>
                        <h1>No products to show.</h1>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <?php $pager->display()?>
        </div>
    </div>

    <script src="<?=ROOT?>/assets/javascript/customer_profile.js"></script>
<?php $this->view('reg_customer/includes/footer'); ?>