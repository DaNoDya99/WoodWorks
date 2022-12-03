<?php $this->view('admin/includes/header') ?>

<body class="admin">
<div class="admin-body">
    <?php $this->view('admin/includes/admin_sidebar') ?>
    <div class="dashboard">
        <div class="dashboard-nav">
            <div class="nav-item-page-name">
                <h1><?= $title ?></h1>
            </div>
            <div class="nav-item-user">
                <img src="<?=ROOT?>/<?=$row[0]->Image?>" alt="Profile picture">
                <div class="nav-vr"></div>
                <h1>Hi, <?=Auth::getFirstname()?></h1>
                <div class="nav-vr"></div>
                <a href="<?=ROOT?>/logout1">
                    <h1>Logout</h1>
                </a>
            </div>
        </div>
        <div class="add-fur-form-body">
            <div class="add-fur-form-container">
                <h1>Add Furniture</h1>
                <form class="add-fur-form" method="post" enctype="multipart/form-data">
                    <div class="fur-img-upload-container">
                        <div class="fur-img">
                            <img src="<?=ROOT?>/assets/images/admin/No_image.jpg" alt="Product Image">
                            <img src="<?=ROOT?>/assets/images/admin/No_image.jpg" alt="Product Image">
                            <img src="<?=ROOT?>/assets/images/admin/No_image.jpg" alt="Product Image">
                        </div>
                        <label>
                            upload
                            <input type="file" name="Images[]" multiple>
                        </label>
                    </div>
                    <div class="add-fur-fields">
                        <div class="add-fur-field-set set-one">
                            <div class="add-fur-field">
                                <label>Product ID</label>
                                <input type="text" name="ProductID" placeholder="SKU">
                            </div>
                            <div class="add-fur-field">
                                <label>Name</label>
                                <input type="text" name="Name" placeholder="Name">
                            </div>
                            <div class="add-fur-field">
                                <label>Category</label>
                                <input type="text" name="Category" placeholder="Category">
                            </div>
                            <div class="add-fur-field">
                                <label>Sub Category</label>
                                <input type="text" name="Sub_category_name" placeholder="Sub Category">
                            </div>
                            <div class="add-fur-field">
                                <label>Quantity</label>
                                <input type="text" name="Quantity" placeholder="Quantity">
                            </div>
                        </div>
                        <div class="add-fur-field-set set-two">
                            <div class="add-fur-field">
                                <label>Cost</label>
                                <input type="text" name="Cost" placeholder="Cost">
                            </div>
                            <div class="add-fur-field">
                                <label>Wattenty Period</label>
                                <input type="text" name="Warrenty_period" placeholder="Warrenty Period">
                            </div>
                            <div class="add-fur-field">
                                <label>Wood Type</label>
                                <input type="text" name="Wood_type" placeholder="Wood Type">
                            </div>
                            <div class="add-fur-field">
                                <label>Supplier ID</label>
                                <input type="text" name="SupplierID" placeholder="Supplier">
                            </div>
                        </div>
                    </div>
                    <div class="add-fur-field">
                        <label>Description</label>
                        <textarea placeholder="Description"></textarea>
                    </div>
                    <div class="add-fur-btn">
                        <button type="submit">ADD</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>

