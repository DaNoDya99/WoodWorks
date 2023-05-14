<?php $data['row'] = $row; $this->view('reg_customer/includes/header',$data); ?>

<div class="issues-container">
    <div class="order-item-list">
        <h2>Order Item List - <?= $order_id?></h2>
        <table class="item-list-table">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Warranty Period</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($items as $item): ?>
                <tr>
                    <td><?=$item->ProductID?></td>
                    <td><img src="<?=ROOT?>/<?=$item->Image?>" alt="Product Image"></td>
                    <td><?=$item->Name?></td>
                    <td><?=$item->Quantity?></td>
                    <td><?=$item->Warrenty_period?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="issue-form">
        <div class="issue-form-heading">
            <h2>Report An Issue</h2>
            <button onclick="getIssues('<?= $order_id ?>')">Reported Issues</button>
        </div>
        <form action="" id="report-issue">
            <div class="form-images">
                <label for="">Upload Images (If necessary) <span class="error" id="image_error" ></span></label>
                <div class="uploaded-images">
                    <img id="issue-images" src="<?=ROOT?>/assets/images/admin/No_image.jpg" alt="">
                    <img id="issue-images" src="<?=ROOT?>/assets/images/admin/No_image.jpg" alt="">
                    <img id="issue-images" src="<?=ROOT?>/assets/images/admin/No_image.jpg" alt="">
                    <img id="issue-images" src="<?=ROOT?>/assets/images/admin/No_image.jpg" alt="">
                    <img id="issue-images" src="<?=ROOT?>/assets/images/admin/No_image.jpg" alt="">
                </div>
                <div class="upload-btn-container">
                    <label class="upload-btn">
                        Upload
                        <input onchange="load_images(this.files)" type="file" name="Images[]" multiple>
                    </label>
                </div>
            </div>

            <div class="field issue-field">
                <label style="font-size: unset">Describe Your Issue <span class="error" id="problem_statement_error" ></span></label>
                <textarea name="Problem_statement" cols="30" rows="17"></textarea>
            </div>

            <div class="add-issue-btn">
                <button onclick="reportIssue('<?=$order_id?>')">Report Issue</button>
            </div>
        </form>
    </div>
</div>

<div class="popup issues-info-popup" id="issues-info-popup" >
    <div class="popup-heading" style="margin-bottom: unset">
        <h2>Reported Issues For This Order</h2>
        <img src="<?= ROOT ?>/assets/images/customer/close.png" alt="Close" onclick="closeIssuesPopup()">
    </div>

    <div class="issues-table-container">
        <div class="issues">
            <table>
                <thead>
                <tr>
                    <th></th>
                    <th>ISSUE ID</th>
                    <th>Reported Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="issues">

                </tbody>
            </table>
        </div>
        <div class="issue-details" id="issue-details">

        </div>
    </div>

</div>

<div class="cat-response" id="response">

</div>

<script src="<?=ROOT?>/assets/javascript/customer_issues.js"></script>
<?php $this->view('reg_customer/includes/footer'); ?>
