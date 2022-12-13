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
            <div class="sup-container">
                <div class="sup-header">
                    <h1>Suppliers</h1>
                    <button>Add Supplier</button>
                </div>
                <div class="sup-table">
                    <table>
                        <tr>
                            <th>Supplier ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Company</th>
                        </tr>

                        <?php if(!empty($suppliers)): ?>
                            <?php foreach($suppliers as $row): ?>
                                <tr>
                                    <td class="supplier-data"><?=$row->SupplierID?></td>
                                    <td class="supplier-data"><?=$row->Firstname?> <?=$row->Lastname?></td>
                                    <td class="supplier-data"><?=$row->Email?></td>
                                    <td class="supplier-data"><?=$row->Contactno?></td>
                                    <td class="supplier-data"><?=$row->Company_name?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                        <?php endif; ?>

                    </table>
                </div>

            </div>
        </div>

    </div>
</div>
</body>
</html>