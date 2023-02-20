<?php $this->view('admin/includes/header') ?>

<body class="admin">
<div class="admin-body">
    <?php $this->view('admin/includes/admin.header') ?>
    <div class="dashboard content cat-container">
        <div class="cat-section">
            <h1>Categories</h1>
            <div class="cat-subcat-container">
                <?php foreach($categories as $category): ?>
                    <div class="cat-collapse">
                        <h3><?=$category->Category_name?></h3>
                        <div id="sub-categories" class="sub-categories">
                            <?php if(!empty($category->sub_categories)): ?>
                                <?php foreach($category->sub_categories as $sub_cat): ?>
                                    <div class="sub-category">
                                        <img  src="<?=ROOT?>/assets/images/customer/chair.jpg" alt="Chair">
                                        <span><?= $sub_cat->Sub_category_name ?></span>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="sub-category">
                                    <span>No Sub Categories</span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="cat-forms">
            <div class="add-category-form">
                <h2>Add Category</h2>
                <form enctype="multipart/form-data" >
                    <div class="form-content">
                        <div class="cat-img">
                            <img src="<?=ROOT?>/assets/images/admin/No_image.jpg" alt="No Image">
                            <label>
                                Upload
                                <input onchange="load_image_secondary(this.files)" type="file" name="Images">
                            </label>
                        </div>
                        <div class="cat-inputs">
                            <div class="cat-from-field">
                                <label>Category ID</label>
                                <input type="text" name="CategoryID" placeholder="Enter Category ID">
                            </div>
                            <div class="cat-from-field">
                                <label>Category Name</label>
                                <input type="text" name="Category_name" placeholder="Enter Category Name">
                            </div>
                            <div class="submit-btn">
                                <button type="submit">Add Category</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="add-category-form">
                <h2>Add Sub-Category</h2>
                <form enctype="multipart/form-data" >
                    <div class="form-content">
                        <div class="cat-img">
                            <img src="<?=ROOT?>/assets/images/admin/No_image.jpg" alt="No Image">
                            <label>
                                Upload
                                <input onchange="load_image_secondary(this.files)" type="file" name="Images">
                            </label>
                        </div>
                        <div class="cat-inputs">
                            <div class="cat-from-field">
                                <label>Category ID</label>
                                <select name="Category_ID">
                                    <option selected>-- Select Category --</option>
                                    <option value="C001">C001 - Living Room</option>
                                </select>
                            </div>
                            <div class="cat-from-field">
                                <label>Sub-Category Name</label>
                                <input type="text" name="Category_name" placeholder="Enter Sub-Category Name">
                            </div>
                            <div class="submit-btn">
                                <button type="submit">Add Sub-Category</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

</body>

<script src="<?=ROOT?>/assets/javascript/categories.js"></script>

</html>


