<div class="card">
    <div class="card-image">
        <div class="slider_wrapper">
            <div class="slider_wrapper_inner">

                <div class="slider_left" onclick="move('left')" style="cursor: pointer;">
                    <svg style="float: left; margin-top: 100px; " viewBox="0 0 384 512"><path fill="#aaa" d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 278.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/></svg>
                </div>

                <div class="slider_container">
                    <div class="slider_images">

                          <?php

                                $design_images = new Design_images();
                                $result = array();
//                                show($row->DesignID);
                                $result = $design_images->where('DesignID',$row->DesignID);
//                                show($result);
//                                show(count($result));
                             ?>

                        <?php for($i =0; $i < count($result) ; $i++) : ?>

                            <img src="http://localhost/woodworks/public/<?=$result[$i]->Image?>">

                        <?php endfor; ?>

                    </div>
                </div>

                <div class="slider_right" onclick="move('right')" style="cursor: pointer;">
                    <svg  style="float: right; margin-top: 100px; " viewBox="0 0 384 512"><path fill="#aaa" d="M342.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L274.7 256 105.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>
                </div>

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
