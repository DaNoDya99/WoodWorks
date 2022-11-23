<div class="tbox">
    <h3 class="text"> DESIGNS DETAILS</h3><br>
    <table class="content-table">
        <thead>
        <tr>
            <th class="th">Design ID</th>
            <th class="th">Image</th>
            <th class="th">Description</th>
            <th class="th">Employee ID</th>
            <th class="th">Manager ID</th>
            <th class="th">Date</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($rows as $row):?>
            <tr>
                <td><?=$row->DesignID?></td>
                <td><?=$row->Image?></td>
                <td><?=$row->Description?></td>
                <td><?=$row->EmployeeID?></td>
                <td><?=$row->ManagerID?></td>
                <td><?=$row->Date?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>
