<?php $this->view('manager/includes/header') ?>

<body class="manager">
<?php $this->view('manager/includes/manager_header') ?>
    <div class="manager-body content">
        <div class="dashboard">
            <div class="ads">
                <div class="ads-heading">
                    <h1>Advertisements</h1>
                    <button onclick = "openPopup()">Add</button>
                    <div class="popup advertisement-popup" id="popup">
                        <div class="popup-heading">
                            <h2>Add Advertisements</h2>
                            <img src="<?=ROOT?>/assets/images/customer/close.png" alt="Close" onclick="closePopup()">
                        </div>

                        <div id="ad-errors" class="error-txt signup-error">
                            
                            
                        </div>
                    

                        <form id="ref-fur" method="post" enctype="multipart/form-data">
                            <div class="refur-fur-img-container">
                                <div class="refur-fur-img">
                                    <img id="first-image" src="<?= ROOT ?>/assets/images/manager/No_image.jpg" alt="Refurnished furniture Image">
                                </div>
                                <label>
                                    Primary Images
                                    <input onchange="load_image_primary(this.files)" type="file" name="PrimaryImage">
                                </label>

                                <div class="refur-fur-img">
                                    <img id="second-image" src="<?= ROOT ?>/assets/images/manager/No_image.jpg" alt="Product Image">
                                    <img id="third-image" src="<?= ROOT ?>/assets/images/manager/No_image.jpg" alt="Product Image">
                                </div>

                                <label>
                                    Secondary Images
                                    <input onchange="load_image_secondary(this.files)" type="file" name="Images[]" multiple>
                                </label>
                            </div>

                            <div class="fields-container">
                                <div class="fields-left">
                                    <div>
                                        <label>Advertisement ID (RF001)</label>
                                        <input type="text" name="AdvertisementID" placeholder="SKU">
                                    </div>

                                    <div>
                                        <label>Quantity</label>
                                        <input type="number" name="Quantity" placeholder="Quantity">
                                    </div>
                                </div>
                                <div class="fields-right">
                                    <div>
                                        <label>Product Name</label>
                                        <input type="text" name="Product_name" placeholder="Product Name">
                                    </div>

                                    <div>
                                        <label>Price</label>
                                        <input type="text" name="Price" placeholder="Price">
                                    </div>
                                </div>
                            </div>

                            <div class="ref-description">
                                <label>Description</label>
                                <textarea name="Description" cols="30" rows="10" placeholder="Description"></textarea>
                            </div>

                            <button id='ref-fur-btn' type="submit" >Add</button>
                        </form>

                        
                    </div>

                    <div class="popup advertisement-popup" id="edit-ad-popup">
                        <div class="popup-heading">
                            <h2>Edit Advertisements</h2>
                            <img src="<?=ROOT?>/assets/images/customer/close.png" alt="Close" onclick="closeEditAdPopup()">
                        </div>

                        <div id="ad-errors" class="error-txt signup-error">


                        </div>


                        <form id="edit-ref-fur" method="post" enctype="multipart/form-data">
                            <div class="refur-fur-img-container">
                                <div class="refur-fur-img">
                                    <img id="first-image-edit" src="<?= ROOT ?>/assets/images/manager/No_image.jpg" alt="Refurnished furniture Image">
                                </div>
                                <label>
                                    Primary Images
                                    <input id="primary-image" onchange="load_image_primary2(this.files)" type="file" name="PrimaryImage">
                                </label>

                                <div class="refur-fur-img">
                                    <img id="second-image-edit" src="<?= ROOT ?>/assets/images/manager/No_image.jpg" alt="Product Image">
                                    <img id="third-image-edit" src="<?= ROOT ?>/assets/images/manager/No_image.jpg" alt="Product Image">
                                </div>

                                <label>
                                    Secondary Images
                                    <input id="secondary-images" onchange="load_image_secondary2(this.files)" type="file" name="Images[]" multiple>
                                </label>
                            </div>

                            <div class="fields-container">
                                <div class="fields-left">
                                    <div>
                                        <label>Advertisement ID (RF001)<span class="error-form font-sm" id="ad-id-error"></span></label>
                                        <input type="text" name="AdvertisementID" placeholder="SKU" id="ad-id" disabled>
                                    </div>

                                    <div>
                                        <label>Quantity<span class="error-form font-sm" id="ad-quantity-error"></span></label>
                                        <input type="number" name="Quantity" placeholder="Quantity" id="ad-quantity">
                                    </div>
                                </div>
                                <div class="fields-right">
                                    <div>
                                        <label>Product Name<span class="error-form font-sm" id="ad-name-error"></span></label>
                                        <input type="text" name="Product_name" placeholder="Product Name" id="ad-name">
                                    </div>

                                    <div>
                                        <label>Price<span class="error-form font-sm" id="ad-price-error"></span></label>
                                        <input type="text" name="Price" placeholder="Price" id="ad-price">
                                    </div>
                                </div>
                            </div>

                            <div class="ref-description">
                                <label>Description<span class="error-form font-sm" id="ad-description-error"></span></label>
                                <textarea name="Description" cols="30" rows="10" placeholder="Description" id="ad-description"></textarea>
                            </div>

                            <button onclick="save()">Save</button>
                        </form>


                    </div>

                </div>
                <div class="ad-table">
                <table>
                    <tr>
                        <th>AdvertisementID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Qunatity</th>
                        <th>Price</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                    <?php if(!empty($advertisements)): ?>
                        <?php foreach($advertisements as $row): ?>
                            <tr class="ad-details">
                                <td><?= $row->AdvertisementID?></td>
                                <td><img src="<?=ROOT?>/<?= $row->Image ?>" alt=""></td>
                                <td><?= $row->Product_name ?></td>
                                <td><?= $row->Quantity ?></td>
                                <td>Rs. <?= $row->Price ?>.00</td>
                                <td><?= $row->Date?></td>
                                <td>
                                    <div class="inv-table-btns">
                                        <button onclick="openEditAdPopup('<?= $row->AdvertisementID ?>')"><img src="<?=ROOT?>/assets/images/admin/edit-4-svgrepo-com.svg" alt=""></button>
                                        <button onclick="deleteAd('<?= $row->AdvertisementID ?>')"><img src="<?=ROOT?>/assets/images/admin/delete-svgrepo-com.svg" alt=""></button>
                                        <button onclick="navigateDetailsPage('<?= $row->AdvertisementID ?>')"><img src="<?=ROOT?>/assets/images/manager/info-svgrepo-com.svg" alt=""></button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td>No Refurnished Furniture To Show.</td>
                        </tr>
                    <?php endif; ?>
                    
                    

                    
                </table>
                </div>
                
            </div>
        </div>
    </div>

    <div class="cat-response" id="response">

    </div>

    <script src="<?=ROOT?>/assets/javascript/customer_profile.js"></script>
    <script src="<?=ROOT?>/assets/javascript/ref_furniture.js"></script>
</body>
</html>