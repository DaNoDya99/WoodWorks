<?php $this->view('admin/includes/header') ?>

<body class="admin">
<div class="admin-body">
    <?php $this->view('admin/includes/admin.header') ?>
    <div class="dashboard content">

        <div class="inventory-table-container">
            <div class="inv-header">
                <h1>Inventory</h1>
                <form id="search-form" method="post" class="inv-form">
                    <input type="search" name="product" placeholder="SKU">
                    <button type="submit" onclick="searchProducts()">
                        <img src="<?= ROOT ?>/assets/images/admin/search.png" alt="Search">
                    </button>
                </form>
                <button onclick="openAddFurPopup()" id="add-furniture-btn">Add Furniture</button>
            </div>
            <table id="inv-table" class="inv-table">
                <tr>
                    <th>SKU</th>
                    <th>Quantity</th>
                    <th>Reorder Point</th>
                    <th>Last Ordered</th>
                    <th>Last Received</th>
                    <th>Cost</th>
                    <th>Retail Price</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
                <?php if (!empty($inventory)) : ?>
                    <?php foreach ($inventory as $row) : ?>
                        <tr>
                            <td><?= $row->ProductID ?></td>
                            <td><?= $row->Quantity ?></td>
                            <td><?= $row->Reorder_point ?></td>
                            <td><?= $row->Last_ordered ?></td>
                            <td><?= $row->Last_received ?></td>
                            <td>Rs. <?= $row->Cost ?></td>
                            <td>Rs. <?= $row->Retail_price ?></td>
                            <td><?= $row->Status ?></td>
                            <td><?= $row->Created_at ?></td>
                            <td><?= $row->Updated_at ?></td>
                            <td>
                                <div class="inv-table-btns">
                                    <button onclick="openEditInvPopup('<?=$row->ProductID?>')"><img src="<?=ROOT?>/assets/images/admin/edit-4-svgrepo-com.svg" alt=""></button>
                                    <button onclick="deleteProduct('<?=$row->ProductID?>')"><img src="<?=ROOT?>/assets/images/admin/delete-svgrepo-com.svg" alt=""></button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="11" style="text-align: center;">No Products Found</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>

        <div class="popup add-fur-inv-popup" id="popup">
            <div class="popup-heading">
                <h2>Add Furniture Form</h2>
                <img src="<?=ROOT?>/assets/images/customer/close.png" alt="Close" onclick="closePopup()">
            </div>

            <form id="add-fur-form" class="add-fur-form add-inv-fur-form" method="post" enctype="multipart/form-data">

                <div id="errors">

                </div>


                <div class="add-inv-fur-imgs-container">
                    <div class="add-inv-fur-imgs">
                        <div>
                            <img id="first-img" src="<?= ROOT ?>/assets/images/admin/No_image.jpg" alt="">
                            <label>Primary Image
                                <input onchange="load_image_primary(this.files)" type="file" name="PrimaryImage" id="PrimaryImage">
                            </label>
                        </div>
                        <div class="add-inv-fur-secondary-imgs">
                            <img id="second-img" src="<?= ROOT ?>/assets/images/admin/No_image.jpg" alt="">
                            <img id="third-img" src="<?= ROOT ?>/assets/images/admin/No_image.jpg" alt="">
                            <label>Secondary Images
                                <input onchange="load_image_secondary(this.files)" type="file" name="Images[]" id="PrimaryImage" multiple>
                            </label>
                        </div>
                    </div>
                    <div class="add-fur-img-container-inputs">
                        <div class="inv-fields-left">
                            <div class="field">
                                <label>Product ID</label>
                                <input  type="text" name="ProductID" placeholder="Product ID">
                            </div>
                            <div class="field">
                                <label>Category</label>
                                <select name="CategoryID">
                                    <option value="" selected>-- Select Category --</option>
                                    <?php foreach ($categories as $val) : ?>
                                        <option value="<?= $val->CategoryID ?>"><?= $val->CategoryID ?> - <?= $val->Category_name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="field">
                                <label>Quantity</label>
                                <input type="text" name="Quantity" placeholder="Quantity">
                            </div>
                            <div class="field">
                                <label>Cost</label>
                                <input type="text" name="Cost" placeholder="Cost">
                            </div>

                        </div>
                        <div class="inv-fields-right">
                            <div class="field">
                                <label>Name</label>
                                <input type="text" name="Name" placeholder="Name">
                            </div>
                            <div class="field">
                                <label>Sub Category</label>
                                <select name="Sub_category_name">
                                    <option selected>-- Select Sub-Category --</option>
                                    <?php foreach ($sub_categories as $val) : ?>
                                        <option value="<?= $val->Sub_category_name ?>"><?= $val->Sub_category_name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="field">
                                <label>Reorder Point</label>
                                <input type="text" name="Reorder_point" placeholder="Reorder Point">
                            </div>
                            <div class="field">
                                <label>Retail Price</label>
                                <input type="text" name="Retail_price" placeholder="Retail Price">
                            </div>
                        </div>

                    </div>

                </div>

                <div class="add-inv-fur-rest">
                    <div class="rest">
                        <div class="field">
                            <label>Warranty Period</label>
                            <input type="text" name="Warrenty_period" placeholder="Warranty Period">
                        </div>
                    </div>
                    <div class="rest">
                        <div class="field">
                            <label>Wood Type</label>
                            <input type="text" name="Wood_type" placeholder="Wood Type">
                        </div>
                    </div>
                    <div class="rest">
                        <div class="field">
                            <label>Supplier</label>
                            <select name="SupplierID">
                                <option value="" selected>-- Select Supplier --</option>
                                <?php foreach ($suppliers as $val) : ?>
                                    <option value="<?= $val->SupplierID ?>"><?= $val->SupplierID?> - <?= $val->Company_name?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="field">
                    <label>Description</label>
                    <textarea name="Description" id="" cols="40" rows="20"></textarea>
                </div>

                <div class="add-fur-btn">
                    <button onclick="addFurniture()" type="submit">ADD</button>
                </div>

            </form>

        </div>

        <div class="cat-response" id="response">

        </div>

    </div>
</div>
<script src="<?=ROOT?>/assets/javascript/inventory.js"></script>
</body>
</html>
