<?php $this->view('manager/includes/header') ?>
<?php $i = 1; ?>
<body class="manager">
<?php $this->view('manager/includes/manager_header') ?>
    <div class="content manager-body ">
           
        <div class="dis-form-container">
            <div class="dis-header">
                <h2>Product Specific Discounts</h2>
                <button onclick="openDiscountsPopup()">Discount Details</button>
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

    <div class="popup discounts-popup" id="discounts-popup">
        <div class="popup-heading">
            <h2>Discounts Details</span></h2>
            <img src="<?= ROOT ?>/assets/images/customer/close.png" alt="Close" onclick="closeDiscountsPopup()">
        </div>

        <div class="discounts-selections">
            <div class="ongoing-discounts" id="ongoing-discounts" onclick="getActiveDiscounts()">
                <h3>Active Discounts</h3>
            </div>
            <div class="past-discounts" id="past-discounts" onclick="getPastDiscounts()">
                <h3>Discounts History</h3>
            </div>
        </div>

        <table class="discounts-table" >
            <thead>
                <tr>
                    <th>Discount ID</th>
                    <th>Discount Name</th>
                    <th>Percentage</th>
                    <th>Discount Status</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Expired At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="t-body">

            </tbody>


        </table>

    </div>

    <div class="popup discounts-info-popup" id="discounts-info-popup">
        <div class="popup-heading">
            <h2>Discounts Applied For</h2>
            <img src="<?= ROOT ?>/assets/images/customer/close.png" alt="Close" onclick="closeDiscountsInfoPopup()">
        </div>

        <div>
            <table class="discounts-info">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Discounted Price</th>
                    </tr>
                </thead>
                <tbody id="t-body-info">

                </tbody>
            </table>
        </div>

    </div>

    <div class="popup discounts-edit-popup" id="discounts-edit-popup">
        <div class="popup-heading">
            <h2>Edit Discount - <span id="dis-id"></span></h2>
            <img src="<?= ROOT ?>/assets/images/customer/close.png" alt="Close" onclick="closeDiscountsEditPopup()">
        </div>

        <form action="" id="edit-form">
            <div class="dis-field align-left">
                <label for="">Discount Name <span class="dis-err" id="name-error"></span></label>
                <input type="text" name="Name" id="discount-name">
            </div>
            <div class="dis-field align-left">
                <label for="">Discount Percentage <span class="dis-err" id="percentage-error"></span></label>
                <input type="number" name="Discount_percentage" id="discount-percentage">
            </div>
            <div class="dis-field align-left">
                <label for="">Valid Until <span class="dis-err" id="expired-date-error"></span></label>
                <input type="date" name="Expired_at" id="discount-expired-date">
            </div>
            <div class="align-left">
                <label for="">Active</label>
                <input type="checkbox" name="Active" id="discount-status" value="1">
            </div>
            <div>
                <button onclick="saveDiscount()">Save</button>
            </div>
        </form>
    </div>

<div class="cat-response" id="response">

</div>
    
</body>

<script src="<?=ROOT?>/assets/javascript/discount.js"></script>

</html>