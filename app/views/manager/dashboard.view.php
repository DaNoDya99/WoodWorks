<?php $this->view('manager/includes/header') ?>

<body class="manager">
    <?php $this->view('manager/includes/manager_header') ?>
    <div class="content manager-body ">
        <div class="dashboard">
            
            <div class=" content dashbord-body">

                <div class="container">
         
                    <h2>Order Status</h2>
                    <table>
                        <tr>
                        <th>ProductId</th>
                        <th>Status</th>

                        </tr>

                        <tr>
                            <td>P0001</td>
                            <td>Pending</td>
                        </tr>

                        <tr>
                            <td>P0004</td>
                            <td>Pending</td>
                        </tr>

                        <tr>
                            <td>P0005</td>
                            <td>Processing</td>
                        </tr>

                        <tr>
                            <td>P0008</td>
                            <td>Finished</td>
                        </tr>

                        <tr>
                            <td>P0002</td>
                            <td>Pending</td>
                        </tr>

                        <tr>
                            <td>P0007</td>
                            <td>Pending</td>
                        </tr>

                        <tr>
                            <td>P0004</td>
                            <td>Processing</td>
                        </tr>

                        <tr>
                            <td>P0010</td>
                            <td>Finished</td>
                        </tr>
                            

                    </table>
                </div>

                <div class="container">
                    <h2>Out of stock furniture</h2>
                    <table>
                        <tr>
                            <th>ProductId</th>
                            <th>Name</th>
                        </tr>

                        <tr>
                            <td>P0011</td>
                            <td>Stool</td>
                        </tr>

                        <tr>
                            <td>P0012</td>
                            <td>Bed</td>
                        </tr>

                        <tr>
                            <td>P0015</td>
                            <td>Chair</td>
                        </tr>

                        <tr>
                            <td>P0009</td>
                            <td>Table</td>
                        </tr>
                        <tr>
                            <td>P0013</td>
                            <td>Black stool</td>
                        </tr>
                        <tr>
                            <td>P0014</td>
                            <td>Kettle side table</td>
                        </tr>
                        <tr>
                            <td>P0016</td>
                            <td>Index stool</td>
                        </tr>
                        <tr>
                            <td>P0018</td>
                            <td>Side table</td>
                        </tr>

                        




                        
                    </table>
                </div>

                <div class="counts">
                    <div class="ad-count">
                        <div>
                            <h2># New Advertisements</h2>
                            <img src="<?=ROOT?>/assets/images/manager/billboard.png" alt="Image">
                        </div>
                        <h1>15</h1>
                    </div>
                    <div class="ad-count">
                        <div>
                            <h2># New Issues</h2>
                            <img src="<?=ROOT?>/assets/images/manager/alert.png" alt="Image">
                        </div>
                        <h1>10</h1>
                    </div>
                </div>
                

                
            </div>


        </div>
        
    </div>
    
</body>
</html>