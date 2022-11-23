<div class="card">
    <div class="card-image">
        <img src="<?=ROOT?>/<?=$row->Image?>" alt="Design picture">
    </div>
    <table class="card-table">
        <tr><td>DesignID : </td><td><?=esc($row->DesignID)?></td></tr>
        <tr><td>Employee ID : </td><td><?=esc($row->EmployeeID)?></td></tr>
        <tr><td>Manager ID : </td><td><?=esc($row->ManagerID)?></td></tr>
        <tr><td>Description : </td><td><?=esc($row->Description)?></td></tr>
        <tr><td>Date : </td><td><?=$row->Date?></td></tr>
    </table>
    <div class="card-btns">
        <button>Update</button>
        <button>Remove</button>
    </div>
</div>
