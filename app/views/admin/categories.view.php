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
                        <div class="cat-heading">
                            <h3><?=$category->CategoryID?> - <?=$category->Category_name?></h3>
                            <div class="cat-btns">
                                <button><img src="<?=ROOT?>/assets/images/admin/edit-4-svgrepo-com.svg" alt=""></button>
                                <button><img src="<?=ROOT?>/assets/images/admin/delete-svgrepo-com.svg" alt=""></button>
                            </div>
                        </div>

                        <div id="sub-categories" class="sub-categories">
                            <?php if(!empty($category->sub_categories)): ?>
                                <?php foreach($category->sub_categories as $sub_cat): ?>
                                    <div class="sub-category">
                                        <img  src="<?=ROOT?>/<?=$sub_cat->Image?>" alt="Chair">
                                        <span><?= $sub_cat->Sub_category_name ?></span>
                                        <div class="sub-cat-btns">
                                            <button><img src="<?=ROOT?>/assets/images/admin/edit-4-svgrepo-com.svg" alt=""></button>
                                            <button><img src="<?=ROOT?>/assets/images/admin/delete-svgrepo-com.svg" alt=""></button>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="sub-category">
                                    <span>No Sub Categories Yet!</span>
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
                <form enctype="multipart/form-data" id="category-form" method="post">
                    <div class="form-content">
                        <div class="cat-img">
                            <img id="cat-img" src="<?=ROOT?>/assets/images/admin/No_image.jpg" alt="No Image">
                            <label>
                                Upload
                                <input onchange="load_cat_image(this.files[0])" type="file" name="Image">
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
                                <button id="category-btn" type="submit">Add Category</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="add-category-form">
                <h2>Add Sub-Category</h2>
                <form enctype="multipart/form-data" id="sub-category-form" method="post">
                    <div class="form-content">
                        <div class="cat-img">
                            <img id="subcat-img" src="<?=ROOT?>/assets/images/admin/No_image.jpg" alt="No Image">
                            <label>
                                Upload
                                <input onchange="load_subcat_image(this.files[0])" type="file" name="Image">
                            </label>
                        </div>
                        <div class="cat-inputs">
                            <div class="cat-from-field">
                                <label>Category ID</label>
                                <select name="CategoryID">
                                    <option selected>-- Select Category --</option>
                                    <?php foreach($categories as $category): ?>
                                        <option value="<?=$category->CategoryID?>"><?=$category->CategoryID?> - <?=$category->Category_name?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="cat-from-field">
                                <label>Sub-Category Name</label>
                                <input type="text" name="Sub_category_name" placeholder="Enter Sub-Category Name">
                            </div>
                            <div class="submit-btn">
                                <button id="sub-category-btn" type="submit">Add Sub-Category</button>
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


