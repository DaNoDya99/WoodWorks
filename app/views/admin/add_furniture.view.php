<?php $this->view('admin/includes/header') ?>

<body class="admin">
    <div class="admin-body">
        <?php $this->view('admin/includes/admin.header') ?>
        <div class="dashboard content">
            <div class="add-fur-form-body">
                <div class="add-fur-form-container">
                    <h1>Add Furniture</h1>
                    <form class="add-fur-form" method="post" enctype="multipart/form-data">

                        <?php if (!empty($errors)) : ?>
                            <div class="error-txt signup-error">
                                <img class="close-error" src="<?= ROOT ?>/assets/images/customer/close.png" alt="Close btn" onclick="close_error()">
                                <ul>
                                    <?php foreach ($errors as $key => $value) : ?>
                                        <li><?= $errors[$key] ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <div class="fur-img-upload-container">
                            <div class="fur-img">
                                <img id="first-img" src="<?= ROOT ?>/assets/images/admin/No_image.jpg" alt="Product Image">
                            </div>
                            <label>
                                Primary Image
                                <input onchange="load_image_primary(this.files)" type="file" name="PrimaryImage">
                            </label>
                            <div class="fur-img">
                                <img id="second-img" src="<?= ROOT ?>/assets/images/admin/No_image.jpg" alt="Product Image">
                                <img id="third-img" src="<?= ROOT ?>/assets/images/admin/No_image.jpg" alt="Product Image">
                            </div>
                            <label>
                                Secondary Images
                                <input onchange="load_image_secondary(this.files)" type="file" name="Images[]" multiple>
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
                                    <select name="CategoryID">
                                        <option value="" selected>-- Select Category --</option>
                                        <?php foreach ($categories as $val) : ?>
                                            <option value="<?= $val->CategoryID ?>"><?= $val->CategoryID ?> - <?= $val->Category_name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="add-fur-field">
                                    <label>Sub Category</label>
                                    <select name="Sub_category_name">
                                        <option selected>-- Select Sub-Category --</option>
                                        <?php foreach ($sub_categories as $val) : ?>
                                            <option value="<?= $val->Sub_category_name ?>"><?= $val->Sub_category_name ?></option>
                                        <?php endforeach; ?>
                                    </select>
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
                            <textarea name="Description" placeholder="Description"></textarea>
                        </div>
                        <div class="add-fur-btn">
                            <button type="submit">ADD</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= ROOT ?>/assets/javascript/add_furniture.js"></script>
    <script src="<?= ROOT ?>/assets/javascript/script.js"></script>
</body>

</html>