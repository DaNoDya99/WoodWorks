<?php $this->view('manager/includes/header') ?>

<body class="manager">
    <div class="manager-body">
        <?php $this->view('manager/includes/manager_sidebar') ?>
        <div class="dashboard">
            <div class="dashboard-nav">
                <div class="nav-item-page-name">
                    <h1><?= $title ?></h1>
                </div>
                <div class="nav-item-user">
                    <img src="<?=ROOT?>/assets/images/manager/user.png" alt="Profile picture">
                    <div class="nav-vr"></div>
                    <h1>Hi, <?=Auth::getFirstname()?></h1>
                    <div class="nav-vr"></div>
                    <a href="<?=ROOT?>/logout4">
                        <h1>Logout</h1>
                    </a>
                </div>
            </div>
            <div class="ads">
                <div class="ads-heading">
                    <h1>Pending Advertisements</h1>
                    <button>All Ads</button>
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
</body>
</html>