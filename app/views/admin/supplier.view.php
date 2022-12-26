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
            <div class="sup-container">
                <div class="sup-header">
                    <h1>Suppliers</h1>
                    <button onclick="openPopup()">Add Supplier</button>
                </div>

                <div class="popup sup-popup" id="popup">
                    <div class="popup-heading">
                        <h2>Add Supplier</h2>
                        <img src="<?=ROOT?>/assets/images/customer/close.png" alt="Close" onclick="closePopup()">
                    </div>
                    <form class="add-sup-form" method="post">
                        <div class="add-sup-field">
                            <label>Supplier ID</label>
                            <input type="text" name="EmployeeID" placeholder="Supplier ID">
                        </div>

                        <div class="name-field-sup">
                            <div>
                                <label>First Name</label>
                                <input type="text" name="Firstname" placeholder="First Name">
                            </div>
                            <div>
                                <label>Last Name</label>
                                <input type="text" name="Lastname" placeholder="Last Name">
                            </div>
                        </div>

                        <div class="add-sup-field">
                            <label>Email</label>
                            <input type="text" name="Email" placeholder="Email">
                        </div>
                        <div class="add-sup-field">
                            <label>Password</label>
                            <input type="text" name="Password" placeholder="Password">
                        </div>
                        <div class="add-sup-field">
                            <label>Contact</label>
                            <input type="text" name="Contactno" placeholder="Contact">
                        </div>
                        <div class="add-sup-field">
                            <label>Company Name</label>
                            <input type="text" name="Company_name" placeholder="Company Name">
                        </div>

                        <button type="submit" onclick="closePopup()">Save</button>
                    </form>
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
<script src="<?=ROOT?>/assets/javascript/supplier.js"></script>
</html>