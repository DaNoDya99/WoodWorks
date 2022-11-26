<div class="card">
    <div class="card-image">
        <div class="slider_wrapper">
            <div class="slider_wrapper_inner">
                <div class="slider_left"></div>

                <div class="slider_container">
                    <div class="slider_images">
                        <img src="<?=ROOT?>/<?=$row->Image?>" alt="Design picture">
                    </div>
                </div>
                <div class="slider_right"></div>
            </div>

            <div class="slider_thumbs"></div>
        </div>

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
