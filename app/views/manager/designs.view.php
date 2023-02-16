<?php $this->view('manager/includes/header') ?>

<body class="manager">
<?php $this->view('manager/includes/manager_header') ?>
    <div class="content manager-body ">
        <div class="dashboard">
            
            <div class="ads">
                <div class="ads-heading">
                    <h1>Pending Designs</h1>
                    <a href="<?=ROOT?>/manager/all_designs"><button>All Designs</button></a>
                </div>
                <div class="ad-table">
                <table>

                    <tr>
                        <th>Date</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th></th>
                    </tr>

                    <?php if(!empty($designs)): ?>
                        <?php foreach($designs as $row) : ?>
                            <tr class="ad-details">
                                <td><?= $row->Date ?></td>
                                <td><img src="<?=ROOT?>/<?= $row->Image ?>" alt=""></td>
                                <td><?= $row->Name ?></td>
                                <td>
                                    <a href="<?=ROOT?>/manager/design_details/<?= $row->DesignID ?>">Details</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                   
                </table>
                </div>
                
            </div>
        </div>
    </div>
</body>
</html>