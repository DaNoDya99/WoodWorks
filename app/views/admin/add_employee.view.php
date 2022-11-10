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
                <h1>Hi, <?=$row[0]->Firstname?></h1>
                <div class="nav-vr"></div>
                <a href="<?=ROOT?>/logout1">
                    <h1>Logout</h1>
                </a>
            </div>
        </div>

        <a class="go-back" href="<?=ROOT?>/admin/employees">
            <img src="<?=ROOT?>/assets/images/admin/back.png" alt="Back Button">
            <h1>Back</h1>
        </a>

        <div class="emp-form-body">
            <div class="emp-form-header">
                <h1>Add Employee</h1>
            </div>
            <form action="" method="post">
                <div class="emp-form-field">
                    <label>Employee ID</label>
                    <input name="EmployeeID" type="text">
                </div>
                <div class="emp-form-field">
                    <label>First Name</label>
                    <input name="Firstname" type="text">
                </div>
                <div class="emp-form-field">
                    <label>Last Name</label>
                    <input name="Lastname" type="text">
                </div>
                <div class="emp-form-field">
                    <label>Email</label>
                    <input name="Email" type="Email">
                </div>
                <div class="emp-form-field">
                    <label>Password</label>
                    <input name="Password" type="password">
                </div>
                <div class="emp-form-field">
                    <label>Role</label>
                    <select name="Role">
                        <option selected>-- Select Role --</option>
                        <option value="Manager">Manager</option>
                        <option value="Cashier">Cashier</option>
                        <option value="Designer">Designer</option>
                        <option value="Driver">Driver</option>
                        <option value="">Driver</option>
                    </select>
                </div>
                <div class="emp-form-field">
                    <label>Contact No</label>
                    <input name="Contactno" type="text">
                </div>
                <div class="add-emp-btn">
                    <button  type="submit">Add Employee</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
