
    <div class="product-card">
        <a href="<?=ROOT?>/furniture/view_product/<?=$row->ProductID?>">
        <div class="product-card-img">
            <img src="<?=ROOT?>/<?=$row->Image?>" alt="Product Image">
        </div>
        <div>
            <h2><?=$row->Name?></h2>
            <h3>Rs. <?=$row->Cost?></h3>
        </div>
        </a>
    </div>
