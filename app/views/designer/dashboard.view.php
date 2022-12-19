<?php $this->view('designer/includes/header') ?>

<body class="designer">
<div class="designer-body">
    <?php $this->view('designer/includes/designer_sidebar') ?>
    <div class="dashboard">

        <div class="dashboard-nav">
            <div class="nav-item-page-name">
                <h1><?= $title ?></h1>
            </div>
            <div class="nav-item-user">
                <img src="<?=ROOT?>/assets/images/designer/user.png" alt="Profile picture">
                <div class="nav-vr"></div>
                <h1>Hi, <?=ucfirst(substr(Auth::getFirstname(),0,1))?>.<?=Auth::getLastname()?></h1>
                <div class="nav-vr"></div>
                <a href="<?=ROOT?>/login3">
                    <h1>Logout</h1>
                </a>
            </div>
        </div>

        <div class="containers-designer-chart">

            <div class="designer-box" id="chart-designer-container">
                <canvas id="designerBar" width="300" height="400"></canvas>
            </div>

            <div class="designer-tbox">

                    <table class="designer-content-table">
                        <thead>

                        <th class="th">Name</th>
                        <th class="th">Image</th>
                        <th class="th">Date</th>

                        </thead>
                        <tbody>
                            <?php foreach ($rows as $row):?>

                                <tr class="designs-table-rows">
                                    <td><?=esc($row->Name)?></td>
                                    <td><img src="<?=ROOT?>/<?=$row->Image?>" alt="Design Image"></td>
                                    <td><?=$row->Date?></td>
                                </tr>

                            <?php endforeach;?>
                        </tbody>
                    </table>

            </div>


        </div>

    </div>
</div>
</body>
<?php $this->view('designer/includes/footer'); ?>
</html>