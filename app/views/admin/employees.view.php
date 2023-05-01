
<?php $this->view('admin/includes/header') ?>

<body class="admin">
<div class="admin-body">

    <?php $this->view('admin/includes/admin.header') ?>

    <div class="content">
        
        <div class="emp-container">
            <div class="emp-header">
                <h1>Employees</h1>
                <a href="#">
                    <button onclick="openAddEmpPopup()">Add employee</button>
                </a>
            </div>
            <div class="emps">
                <table>
                    <tr>
                        <th>Employee ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Contact</th>
                        <th>Joined Date</th>
                        <th></th>
                    </tr>

                    <?php foreach ($rows as $row): ?>
                        <tr>
                            <td><?=$row->EmployeeID?></td>
                            <td class="emp-img"><img src="<?=ROOT?>/<?=$row->Image?>" alt="Image"></td>
                            <td><?=$row->Firstname?> <?=$row->Lastname?></td>
                            <td><?=$row->Email?></td>
                            <td><?=$row->Role?></td>
                            <td><?=$row->Contactno?></td>
                            <td><?=$row->Date?></td>
                            <td>
                                <a  onclick="openEditEmpPopup('<?=$row->EmployeeID?>')">Edit</a>
                                <a onclick="deleteEmployee('<?=$row->EmployeeID?>')">Remove</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>

        <div class="popup emp-popup" id="add-emp-popup">
            <div class="popup-heading">
                <h2>Add Employee</h2>
                <img src="<?= ROOT ?>/assets/images/customer/close.png" alt="Close" onclick="closeAddEmpPopup()">
            </div>

            <form action="" method="post" enctype="multipart/form-data" id="add-emp-form">
                <div class="emp-form-field">
                    <label>Employee ID<span id="emp-id-error" class="error font-sm"></label>
                    <input name="EmployeeID" type="text" placeholder="Enter Employee ID">
                </div>
                <div class="emp-form-field">
                    <label>First Name<span id="firstname-error" class="error font-sm"></label>
                    <input name="Firstname" type="text" placeholder="Enter First Name">
                </div>
                <div class="emp-form-field">
                    <label>Last Name<span id="lastname-error" class="error font-sm"></label>
                    <input name="Lastname" type="text" placeholder="Enter Last Name">
                </div>
                <div class="emp-form-field">
                    <label>Email<span id="email-error" class="error font-sm"></label>
                    <input name="Email" type="Email" placeholder="Enter Email">
                </div>
                <div class="emp-form-field">
                    <label>Password<span id="password-error" class="error font-sm"></label>
                    <input name="Password" type="password" placeholder="Enter Password">
                </div>
                <div class="emp-form-field">
                    <label>Role<span id="role-error" class="error font-sm"></label>
                    <select name="Role">
                        <option selected value="">-- Select Role --</option>
                        <option value="Manager">Manager</option>
                        <option value="Cashier">Cashier</option>
                        <option value="Designer">Designer</option>
                        <option value="Driver">Driver</option>
                    </select>
                </div>
                <div class="emp-form-field">
                    <label>Contact No<span id="contact-error" class="error font-sm"></label>
                    <input name="Contactno" type="text" placeholder="Enter Contact No">
                </div>
                <div class="add-emp-btn">
                    <button onclick="addEmployee()">Add Employee</button>
                </div>
            </form>
        </div>

        <div class="popup emp-popup" id="edit-emp-popup">
            <div class="popup-heading">
                <h2>Edit Employee Details - <span id="emp_id"></span></h2>
                <img src="<?= ROOT ?>/assets/images/customer/close.png" alt="Close" onclick="closeEditEmpPopup()">
            </div>

            <form action="" method="post" enctype="multipart/form-data" id="edit-emp-form">
                <div class="emp-form-field">
                    <label>Employee ID<span id="emp-id-error" class="error font-sm"></label>
                    <input name="EmployeeID" type="text" id="employee_id"  disabled>
                </div>
                <div class="emp-form-field">
                    <label>First Name<span id="firstname-error" class="error font-sm"></label>
                    <input name="Firstname" type="text" id="firstname" >
                </div>
                <div class="emp-form-field">
                    <label>Last Name<span id="lastname-error" class="error font-sm"></label>
                    <input name="Lastname" type="text" id="lastname">
                </div>
                <div class="emp-form-field">
                    <label>Email<span id="email-error" class="error font-sm"></label>
                    <input name="Email" type="Email" id="email">
                </div>
                <div class="emp-form-field">
                    <label>Contact No<span id="contact-error" class="error font-sm"></label>
                    <input name="Contactno" type="text" id="contactno">
                </div>
                <div class="add-emp-btn">
                    <button onclick="save()">Save</button>
                </div>
            </form>
        </div>


    </div>
</div>

<div class="cat-response" id="response">

</div>

<script src="<?=ROOT?>/assets/javascript/employee.js"></script>
</body>
</html>