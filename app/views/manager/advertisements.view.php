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
                                        <label>Product ID</label>
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

                </div>
                <div class="ad-table">
                <table>
                    <tr>
                        <th>Date</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Qunatity</th>
                        <th>Price</th>
                        <th></th>
                    </tr>
                    <?php if(!empty($advertisements)): ?>
                        <?php foreach($advertisements as $row): ?>
                            <tr class="ad-details">
                                <td><?= $row->Date ?></td>
                                <td><img src="<?=ROOT?>/<?= $row->Image ?>" alt=""></td>
                                <td><?= $row->Product_name ?></td>
                                <td><?= $row->Quantity ?></td>
                                <td>Rs. <?= $row->Price ?>.00</td>
                                <td>
                                    <a href="#">Details</a> 
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
    <script src="<?=ROOT?>/assets/javascript/customer_profile.js"></script>
    <script src="<?=ROOT?>/assets/javascript/ref_furniture.js"></script>
</body>
</html>