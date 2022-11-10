
    <div class="card">
        <div class="card-image">
            <img src="<?=ROOT?>/<?=$row->Image?>" alt="Profile picture">
        </div>
        <h2><?=$row->Firstname?> <?=$row->Lastname?></h2>
        <table class="card-table">
            <tr><td>Employee ID : </td><td><?=$row->EmployeeID?></td></tr>
            <tr><td>Email : </td><td><?=$row->Email?></td></tr>
            <tr><td>Role : </td><td><?=$row->Role?></td></tr>
            <tr><td>Contact No : </td><td><?=$row->Contactno?></td></tr>
            <tr><td>Date : </td><td><?=$row->Date?></td></tr>
        </table>
        <div class="card-btns">
            <button>Update</button>
            <button>Remove</button>
        </div>
    </div>
