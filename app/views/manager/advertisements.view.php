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

                        <?php if(!empty($errors)) : ?>
                            <div class="error-txt signup-error">
                                <img class="close-error" src="<?=ROOT?>/assets/images/customer/close.png" alt="Close btn" onclick="close_error()">
                                <ul>
                                <?php foreach ($errors as $key => $value):?>
                                    <li><?=$errors[$key]?></li>
                                <?php endforeach;?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <form method="post">
                            <div>
                                <label>Product Name</label>
                                <input type="text" name="Product_name" placeholder="Product Name ">
                            </div>
                            
                            <div>
                                <label>Category ID</label>
                                <select name="CategoryID" >
                                    <option selected>-- Select Category --</option>
                                    <option value = "C001" >C001 - Living Room</option>
                                    <option value = "C002" >C002 - Bed Room</option>
                                    <option value = "C003" >C003 - Dinning Room</option>
                                    <option value = "C004" >C004 - Outdoor</option>
                                    <option value = "C005" >C005 - Office</option>
                                    <option value = "C006" >C006 - Home Office</option>

                                </select>
                            </div>
                            
                            <div>
                                <label>Subcategory Name</label>
                                <input type="text" name="Sub_category_name" placeholder="Subcategory Name">
                            </div>
                            
                            <div>
                                <label>Quantity</label>
                                <input type="number" name="Quantity" placeholder="Quantity">
                            </div>
                            
                            <div>
                                <label>Description</label>
                                <textarea name="Description" cols="30" rows="10" placeholder="Description"></textarea>
                            </div>

                            <div>
                                <label>Price</label>
                                <input type="text" name="Price" placeholder="Price">
                            </div>

                            <button type="submit" >Add</button>
                        </form>

                        
                    </div>

                </div>
                <div class="ad-table">
                <table>
                    <tr>
                        <th>Date</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                    <tr class="ad-details">
                        <td>2022-12-14</td>
                        <td><img src="<?=ROOT?>/assets/images/customer/chair.jpg" alt=""></td>
                        <td>Chair</td>
                        <td>Rs. 15000.00</td>
                        <td>Pending</td>
                        <td>
                            <a href="#">Details</a>
                            <a href="#">Verify</a>
                        </td>
                    </tr>

                    <tr class="ad-details">
                        <td>2022-12-14</td>
                        <td><img src="<?=ROOT?>/assets/images/customer/chair.jpg" alt=""></td>
                        <td>Chair</td>
                        <td>Rs. 15000.00</td>
                        <td>Pending</td>
                        <td>
                            <a href="#">Details</a>
                            <a href="#">Verify</a>
                        </td>
                    </tr>

                    <tr class="ad-details">
                        <td>2022-12-14</td>
                        <td><img src="<?=ROOT?>/assets/images/customer/chair.jpg" alt=""></td>
                        <td>Chair</td>
                        <td>Rs. 15000.00</td>
                        <td>Pending</td>
                        <td>
                            <a href="#">Details</a>
                            <a href="#">Verify</a>
                        </td>
                    </tr>

                    <tr class="ad-details">
                        <td>2022-12-14</td>
                        <td><img src="<?=ROOT?>/assets/images/customer/chair.jpg" alt=""></td>
                        <td>Chair</td>
                        <td>Rs. 15000.00</td>
                        <td>Pending</td>
                        <td>
                            <a href="#">Details</a>
                            <a href="#">Verify</a>
                        </td>
                    </tr>

                    <tr class="ad-details">
                        <td>2022-12-14</td>
                        <td><img src="<?=ROOT?>/assets/images/customer/chair.jpg" alt=""></td>
                        <td>Chair</td>
                        <td>Rs. 15000.00</td>
                        <td>Pending</td>
                        <td>
                            <a href="#">Details</a>
                            <a href="#">Verify</a>
                        </td>
                    </tr>

                    <tr class="ad-details">
                        <td>2022-12-14</td>
                        <td><img src="<?=ROOT?>/assets/images/customer/chair.jpg" alt=""></td>
                        <td>Chair</td>
                        <td>Rs. 15000.00</td>
                        <td>Pending</td>
                        <td>
                            <a href="#">Details</a>
                            <a href="#">Verify</a>
                        </td>
                    </tr>

                    <tr class="ad-details">
                        <td>2022-12-14</td>
                        <td><img src="<?=ROOT?>/assets/images/customer/chair.jpg" alt=""></td>
                        <td>Chair</td>
                        <td>Rs. 15000.00</td>
                        <td>Pending</td>
                        <td>
                            <a href="#">Details</a>
                            <a href="#">Verify</a>
                        </td>
                    </tr>

                    <tr class="ad-details">
                        <td>2022-12-14</td>
                        <td><img src="<?=ROOT?>/assets/images/customer/chair.jpg" alt=""></td>
                        <td>Chair</td>
                        <td>Rs. 15000.00</td>
                        <td>Pending</td>
                        <td>
                            <a href="#">Details</a>
                            <a href="#">Verify</a>
                        </td>
                    </tr>
                </table>
                </div>
                
            </div>
        </div>
    </div>
    <script src="<?=ROOT?>/assets/javascript/customer_profile.js"></script>
</body>
</html>