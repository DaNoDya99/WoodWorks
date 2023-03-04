<?php $this->view('admin/includes/header') ?>

<body class="admin">
    <div class="admin-body">
        <?php $this->view('admin/includes/admin.header') ?>
        <div class="dashboard content">
            <div class="inventory-table">
                <div class="inv-header">
                    <h1>Furniture Store</h1>
                    <form id="search-by-cat-form" method="post" class="inv-form">
                        <select name="Category">
                            <option selected>-- All --</option>
                            <?php foreach ($categories as $row) : ?>
                                <option value="<?=$row->CategoryID?>"><?= $row->Category_name ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button onclick="filterProducts()" type="submit">
                            <img src="<?= ROOT ?>/assets/images/admin/filter.png" alt="Filter">
                        </button>
                    </form>
                    <form id="search-form" method="post" class="inv-form">
                        <input type="search" name="product" placeholder="SKU / Name">
                        <button type="submit" onclick="searchProducts()">
                            <img src="<?= ROOT ?>/assets/images/admin/search.png" alt="Search">
                        </button>
                    </form>
                </div>
                <div class="inv-details-tbl">
                    <table id="table">
                        <tr class="inv-header-tr">
                            <th>SKU</th>
                            <th>Image</th>
                            <th class="inv-fur-name">Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th></th>
                        </tr>
                        <?php if (!empty($furniture)) : ?>
                            <?php foreach ($furniture as $row) : ?>
                                <tr class="inv-product">
                                    <td><?= $row->ProductID ?></td>
                                    <td><img src="<?= ROOT ?>/<?= $row->Image ?>" alt="Product Image"></td>
                                    <td><?= $row->Name ?></td>
                                    <td><?= $row->Quantity ?></td>
                                    <td>Rs. <?= $row->Cost ?>.00</td>
                                    <td>
                                        <div>
                                            <span onclick="openPopup('<?=$row->ProductID?>')">Edit</span>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                        <?php endif; ?>

                    </table>
                </div>
            </div>
            <div class="popup edit-furniture-popup" id="popup">
                <div class="popup-heading">
                    <h2>Chorus Bed - P0001</h2>
                    <img src="<?=ROOT?>/assets/images/customer/close.png" alt="Close" onclick="closePopup()">
                </div>

                <form id="edit-fur-form" class="add-fur-form" method="post" enctype="multipart/form-data">

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

                </form>

            </div>
        </div>
    </div>
</body>
<script src="<?=ROOT?>/assets/javascript/edit_furniture.js"></script>
</html>