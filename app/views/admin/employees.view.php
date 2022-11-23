
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
                <img src="<?=ROOT?>/assets/images/admin/user.png" alt="Profile picture">
                <div class="nav-vr"></div>
                <h1>Hi, <?=Auth::getFirstname()?></h1>
                <div class="nav-vr"></div>
                <a href="<?=ROOT?>/logout1">
                    <h1>Logout</h1>
                </a>
            </div>
        </div>
        <div class="add-emp-bar">
            <a href="<?=ROOT?>/admin/add_employee">
                <button>Add Employee</button>
            </a>
            <h1>No of employees : <?=$no_of_emp?></h1>
        </div>
        <div>
            <section class="container">
                <?php foreach ($rows as $row):?>
                    <?php $data['row'] = $row; $this->view('admin/includes/employee_card',$data) ?>
                <?php endforeach;?>
            </section>
        </div>
    </div>
</div>
</body>
</html>