<?php $this->view('manager/includes/header') ?>

<body class="manager">
<?php $this->view('manager/includes/manager_header') ?>
    <div class="content manager-body ">
        <div class="dashboard">
            
            <div class="ads">
                <div class="ads-heading">
                    <h1>Pending Designs</h1>
                    <button onclick="openDesignDetailsPopup()">Designs Details</button>
                </div>
                <div class="ad-table">
                <table>

                    <tr>
                        <th>Design ID</th>
                        <th>Image</th>
                        <th>Design Name</th>
                        <th>Designer</th>
                        <th>Status</th>
                        <th>Furniture Category</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>

                    <?php if(!empty($designs)): ?>
                        <?php foreach($designs as $row) : ?>
                            <tr class="ad-details">
                                <td><?=$row->DesignID?></td>
                                <td><img src="<?=ROOT?>/<?= $row->Image ?>" alt=""></td>
                                <td><?=$row->Name?></td>
                                <td><?=$row->Desinger?></td>
                                <td><?=$row->Status?></td>
                                <td><?=$row->Category?></td>
                                <td><?= $row->Date ?></td>
                                <td>
                                    <div class='inv-table-btns manager-btns'>
                                        <button onclick='downloadPdf(`<?=$row->Pdf?>`)'><img src='http://localhost/WoodWorks/public/assets/images/manager/download-svgrepo-com.svg' alt=''></button>
                                        <button style="background-color: #2e69c4;" onclick='getDesignInfo(`<?= $row->DesignID ?>`)'><img src='http://localhost/WoodWorks/public/assets/images/manager/info-svgrepo-com.svg' alt=''></button>
                                        <button style="background-color: #02df00;" onclick='acceptDesign(`<?= $row->DesignID ?>`)'><img src='http://localhost/WoodWorks/public/assets/images/manager/active-svgrepo-com.svg' alt=''></button>
                                        <button style="background-color: #a00505;" onclick='rejectDesign(`<?= $row->DesignID ?>`)'><img src='http://localhost/WoodWorks/public/assets/images/manager/reject-cross-delete-svgrepo-com.svg' alt=''></button>

                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="8" style="text-align: center">No Pending Designs.</td></tr>
                    <?php endif; ?>
                   
                </table>
                </div>
                
            </div>
        </div>

        <div class="popup details-info-popup" id="details-info-popup">
            <div class="popup-heading">
                <h2 id="design-id"></h2>
                <img src="<?= ROOT ?>/assets/images/customer/close.png" alt="Close" onclick="closeDesignDetailsPopup()">
            </div>

            <div class="order-selections">
                <div class="selector designs-selector" name="selector" id="accepted" onclick="getDesignsByStatus('Accepted')">Accepted Designs</div>
                <div class="selector designs-selector" name="selector" id="rejected" onclick="getDesignsByStatus('Rejected')">Rejected Designs</div>
            </div>

            <table class="designs-details-table">
                <thead>
                    <tr>
                        <th>Design ID</th>
                        <th>Image</th>
                        <th>Design Name</th>
                        <th>Designer</th>
                        <th>Status</th>
                        <th>Furniture Category</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="t-body">

                </tbody>
            </table>

        </div>

        <div class="popup details-info-popup" id="design-info-popup">
            <div class="popup-heading">
                <h2 id="design-id"></h2>
                <img src="<?= ROOT ?>/assets/images/customer/close.png" alt="Close" onclick="closeDesignInfoPopup()">
            </div>

           <div class="design-details-container" id="design-info">

           </div>
        </div>
    </div>
    <div class="cat-response" id="response">

    </div>

</body>
<script src="<?=ROOT?>/assets/javascript/designs.js"></script>
</html>