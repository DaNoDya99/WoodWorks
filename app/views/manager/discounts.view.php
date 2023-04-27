<?php $this->view('manager/includes/header') ?>
<?php $i = 1; ?>
<body class="manager">
<?php $this->view('manager/includes/manager_header') ?>
    <div class="content manager-body ">
           
        <div class="dis-form-container">
            <div class="dis-header">
                <h2>Product Specific Discounts</h2>
                <button>Discounts History</button>
            </div>
            
            <form method="POST" id="form">
                <div class="dis-form">
                    <div class="dis-form-left">
                        <div class="dis-field">
                            <label>Name <span id="name" class="dis-err"></span></label>
                            <input type="text" name="Name" placeholder="Enter Discount Name">
                        </div>
                        <div class="dis-field">
                            <label>Discount Percentage <span id="discount" class="dis-err"></span></label>
                            <input type="text" name="Discount_percentage" placeholder="Enter Discount Percentage">
                        </div>
                        <div class="dis-field-check">
                            <label>Active</label>
                            <input type="checkbox" name="Active" value="1">
                        </div>
                        <div class="dis-field dis-date">
                            <label>Valid Until <span id="expired_at" class="dis-err"></span></label>
                            <input type="date" name="Expired_at">
                        </div>
                        <div class="dis-field-check dis-cat-list">
                            <label>Select Categories <span id="category" class="dis-err"></span></label>
                            <div class="cat-list">

                                <?php foreach($categories as $category): ?>
                                    <div>
                                        <input type="checkbox" name="category<?=$i?>" value="<?=$category->CategoryID?>" id="<?=$category->CategoryID?>" onchange="getSubCategories('<?=$category->CategoryID?>')">
                                        <label onclick="selectSubCategory('<?=$category->CategoryID?>')"><?=$category->Category_name?></label>
                                    </div>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                                
                            </div>      
                        </div>
                    </div> 
                    <div class="dis-form-right">
                        <div class="dis-field-check dis-cat-list">
                            
                            <label>Select Sub-Categories</label>
                            <div class="cat-items-container" id="sub-cats">
                                <span class="dis-err">Please select a category</span>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="dis-btn">
                    <button onclick="add_discount()">Add Discount</button>
                </div>
            </form>
            
        </div>
        
    </div>

<div class="cat-response" id="response">

</div>
    
</body>

<script src="<?=ROOT?>/assets/javascript/discount.js"></script>

</html>