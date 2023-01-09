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
                <a href="<?=ROOT?>/logout">
                    <h1>Logout</h1>
                </a>
            </div>
        </div>
        <div class="inventory-table">
            <div class="inv-header">
                <h1>Inventory</h1>
                <form method="post" class="inv-form">
                    <select name="Category">
                        <option selected>-- Filter --</option>
                        <?php foreach($categories as $row):?>
                            <option value="<?=$row->Category_name?>"><?=$row->Category_name?></option>
                        <?php endforeach;?>
                    </select>
                    <button type="submit">
                        <img src="<?=ROOT?>/assets/images/admin/filter.png" alt="Filter">
                    </button>
                </form>
                <form method="post" class="inv-form">
                    <input type="search" name="product" placeholder="SKU / Name">
                    <button type="submit">
                        <img src="<?=ROOT?>/assets/images/admin/search.png" alt="Search">
                    </button>
                </form>
            </div>
            <div class="inv-details-tbl">
                <table>
                    <tr class="inv-header-tr">
                        <th>SKU</th>
                        <th>Image</th>
                        <th class="inv-fur-name">Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th></th>
                    </tr>
                    <?php if(!empty($furniture)):?>
                        <?php foreach($furniture as $row):?>
                            <tr class="inv-product">
                                <td><?=$row->ProductID?></td>
                                <td><img src="<?=ROOT?>/<?=$row->Image?>" alt="Product Image"></td>
                                <td><?=$row->Name?></td>
                                <td><?=$row->Quantity?></td>
                                <td>Rs. <?=$row->Cost?>.00</td>
                                <td>
                                    <div>
                                        <a href="<?=ROOT?>/furniture/edit/<?=$row->ProductID?>">Edit</a>
                                        <a href="<?=ROOT?>/furniture/remove/<?=$row->ProductID?>">Remove</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    <?php else:?>
                    <?php endif;?>

                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>