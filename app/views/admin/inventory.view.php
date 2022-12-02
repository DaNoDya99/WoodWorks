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
        <div class="inventory-table">
            <div class="inv-header">
                <h1>Inventory</h1>
                <form method="post" class="inv-form">
                    <input type="search" name="product" placeholder="SKU / Name">
                    <button type="submit">
                        <img src="<?=ROOT?>/assets/images/admin/search.png" alt="">
                    </button>
                </form>
            </div>
            <div class="inv-details-tbl">
                <table>
                    <tr class="inv-header-tr">
                        <th>SKU</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th></th>
                    </tr>
                    <tr class="inv-product">
                        <td>P0001</td>
                        <td><img src="<?=ROOT?>/assets/images/customer/chair.jpg" alt="Product Image"></td>
                        <td>Block Nomad Sofa</td>
                        <td>Rs. 25000.00</td>
                        <td><div><p>Edit</p> <p>Remove</p></div></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>