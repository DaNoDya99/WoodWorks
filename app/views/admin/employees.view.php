
<?php $this->view('admin/includes/header') ?>

<body class="admin">
<div class="admin-body">

    <?php $this->view('admin/includes/admin.header') ?>

    <div class="content">
        
        <div class="emp-container">
            <div class="emp-header">
                <h1>Employees</h1>
                <a href="<?=ROOT?>/admin/add_employee">
                    <button>Add employee</button>
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
                                <a href="#">Edit</a>
                                <a href="<?=ROOT?>/employee/delete/<?=$row->EmployeeID?>">Remove</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>