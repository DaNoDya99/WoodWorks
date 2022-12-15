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
            
            <div class="dashbord-body">
                <div class="container">
         
                    <h2>Order Status</h2>
                    <table>
                        <tr>
                        <th>OrderId</th>
                        <th>Status</th>

                        </tr>

                        <tr>
                            <td>O0001</td>
                            <td>Pending</td>
                        </tr>

                        <tr>
                            <td>O0004</td>
                            <td>Pending</td>
                        </tr>

                        <tr>
                            <td>O0005</td>
                            <td>Processing</td>
                        </tr>

                        <tr>
                            <td>O0008</td>
                            <td>Finished</td>
                        </tr>

                        <tr>
                            <td>O0002</td>
                            <td>Pending</td>
                        </tr>

                        <tr>
                            <td>O0007</td>
                            <td>Pending</td>
                        </tr>

                        <tr>
                            <td>O0004</td>
                            <td>Processing</td>
                        </tr>

                        <tr>
                            <td>O0010</td>
                            <td>Finished</td>
                        </tr>
                            

                    </table>
                </div>

                <div class="container">
                    <h2>Out of stock furniture</h2>
                    <table>
                        <tr>
                            <th>Category</th>
                            <th>Name</th>
                        </tr>

                        




                        
                    </table>
                </div>

                <div class="container">
                    <h2>Advertisements</h2>
                    <table>
                        <th>Date</th>
                        <th>Name</th>
                    </table>
                </div>

                
            </div>


        </div>
        
    </div>
    
</body>
</html>