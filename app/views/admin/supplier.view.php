<?php $this->view('admin/includes/header') ?>

<body class="admin">
    <div class="admin-body">
        <?php $this->view('admin/includes/admin.header') ?>
        <div class="dashboard content">
           
            <div class="sup-container">
                <div class="sup-header">
                    <h1>Suppliers</h1>
                    <button onclick="openPopup()">Add Supplier</button>
                </div>

                <div class="popup sup-popup" id="popup">
                    <div class="popup-heading">
                        <h2>Add Supplier</h2>
                        <img src="<?= ROOT ?>/assets/images/customer/close.png" alt="Close" onclick="closePopup()">
                    </div>
                    <form class="add-sup-form" id="add-sup-form" method="post">
                        <div class="add-sup-field">
                            <label>Supplier ID<span id="add-supplierid-error" class="error font-sm"></span></label>
                            <input type="text" name="SupplierID" placeholder="Supplier ID">
                        </div>

                        <div class="name-field-sup">
                            <div>
                                <label>First Name<span id="add-firstname-error" class="error font-sm"></label>
                                <input type="text" name="Firstname" placeholder="First Name">
                            </div>
                            <div>
                                <label>Last Name<span id="add-lastname-error" class="error font-sm"></label>
                                <input type="text" name="Lastname" placeholder="Last Name">
                            </div>
                        </div>

                        <div class="add-sup-field">
                            <label>Email<span id="add-email-error" class="error font-sm"></label>
                            <input type="text" name="Email" placeholder="Email">
                        </div>
                        <div class="add-sup-field">
                            <label>Password<span id="add-password-error" class="error font-sm"></label>
                            <input type="text" name="Password" placeholder="Password">
                        </div>
                        <div class="add-sup-field">
                            <label>Contact<span id="add-contactno-error" class="error font-sm"></label>
                            <input type="text" name="Contactno" placeholder="Contact">
                        </div>
                        <div class="add-sup-field">
                            <label>Company Name<span id="add-companyname-error" class="error font-sm"></label>
                            <input type="text" name="Company_name" placeholder="Company Name">
                        </div>

                        <button type="submit" onclick="addSupplier()">ADD</button>
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
                            <th>Actions</th>
                        </tr>

                        <?php if (!empty($suppliers)) : ?>
                            <?php foreach ($suppliers as $row) : ?>
                                <tr>
                                    <td class="supplier-data"><?= $row->SupplierID ?></td>
                                    <td class="supplier-data"><?= $row->Firstname ?> <?= $row->Lastname ?></td>
                                    <td class="supplier-data"><?= $row->Email ?></td>
                                    <td class="supplier-data"><?= $row->Contactno ?></td>
                                    <td class="supplier-data"><?= $row->Company_name ?></td>
                                    <td>
                                        <div class="inv-table-btns">
                                            <button onclick="openEditSupplierPopup('<?=$row->SupplierID?>')"><img src="<?=ROOT?>/assets/images/admin/edit-4-svgrepo-com.svg" alt=""></button>
                                            <button onclick="deleteSupplier('<?=$row->SupplierID?>')"><img src="<?=ROOT?>/assets/images/admin/delete-svgrepo-com.svg" alt=""></button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                        <?php endif; ?>

                    </table>
                </div>

            </div>
        </div>

    </div>
    </div>

    <div class="popup edit-sup-popup" id="edit-popup">
        <div class="popup-heading">
            <h2>Edit Supplier - <span id="supplier_id"></span></h2>
            <img src="<?= ROOT ?>/assets/images/customer/close.png" alt="Close" onclick="closeEditSupplierPopup()">
        </div>
        <form class="add-sup-form" id="edit-sup-form" method="post">
            <div class="add-sup-field">
                <label>Supplier ID</label>
                <input type="text" name="SupplierID" id="emp_id" disabled>
            </div>

            <div class="name-field-sup">
                <div>
                    <label>First Name</label>
                    <input type="text" name="Firstname" id="firstname">
                </div>
                <div>
                    <label>Last Name</label>
                    <input type="text" name="Lastname" id="lastname">
                </div>
            </div>

            <div class="add-sup-field">
                <label>Email</label>
                <input type="text" name="Email" id="email">
            </div>
            <div class="add-sup-field">
                <label>Contact</label>
                <input type="text" name="Contactno" id="contactno">
            </div>
            <div class="add-sup-field">
                <label>Company Name</label>
                <input type="text" name="Company_name" id="company_name">
            </div>

            <button class="sup-btn" type="submit" onclick="save()">Save</button>
        </form>
    </div>


    <div class="cat-response" id="response">

    </div>
</body>
<script src="<?= ROOT ?>/assets/javascript/supplier.js"></script>

</html>