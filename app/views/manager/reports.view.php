<?php $this->view('manager/includes/header') ?>

<body class="manager">
<?php $this->view('manager/includes/manager_header') ?>
<div class="content manager-body ">
    <div class="dashboard">
        <div class="form-container">

            <form method="post" class="report-form">
                <div class="form-header" style="width: 100%">
                    <h2>Generate Reports</h2>
                </div>
                <div class="form-fields">
                    <div class="report-type ">
                        <div>
                            <label for="report_types">Select Report</label><br/>
                            <select name="report_types">
                                <option value="Daily Sales Reports">Daily Sales Reports</option>
                                <option value="Weekly Sales reports">Weekly Sales Reports</option>
                                <option value="Monthly Sales Reports">Monthly Sales Report</option>
                            </select>
                        </div>

                    </div>
                    <div class="report-date">
                        <div class="report-from">
                            <label for="dateFrom">From</label>
                            <input type="date" name="dateFrom">
                        </div>


                        <div class="report-to">
                            <label for="dateTo">To</label>
                            <input type="date" name="dateTo">
                            <!-- <select name="months"> -->
                            <!-- <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>


                            </select> -->
                        </div>

                    </div>

                </div>


                <button type="button" onclick="gentable()">Generate Report</button>


            </form>
            <div class="generated-report">
                <div class="inventory-data" id="panel">

                    <div style="display:flex; justify-content:space-between">
                        <h3 style="font-weight:500;">Inventory</h3>
        <div style="display: flex; flex-direction: row; align-items: center; justify-content: center;">
            <a href="#" style="padding-right:30px; text-decoration: none; font-weight: bold; "><p>Export to PDF</p></a>
            <input type="text" name="search" onkeyup="myFunction()" id="myInput"
                   placeholder="Search Orders">

        </div>

                    </div>

                    <table id="myTable">
                        <table>
                            <tr class="thead">
                                <th class="col-name headercol">Product</th>
                                <th class="col-quantity headercol">Quantity Sold</th>
                                <th class="col-cost headercol">Unit Price</th>
                                <th class="col-revenue headercol">Total Revenue</th>
                            </tr>
                            <tr>
                                <td class="col-name">Product 1</td>
                                <td class="col-quantity">100</td>
                                <td class="col-cost">$10.00</td>
                                <td class="col-revenue">$1000.00</td>
                            </tr>
                            <tr>
                                <td class="col-name">Product 2</td>
                                <td class="col-quantity">100</td>
                                <td class="col-cost">$10.00</td>
                                <td class="col-revenue">$1000.00</td>
                            </tr>
                            <tr>
                                <td class="col-name">Product 3</td>
                                <td class="col-quantity">100</td>
                                <td class="col-cost">$10.00</td>
                                <td class="col-revenue">$1000.00</td>
                            </tr>
                            <tr>
                                <td class="col-name">Product 4</td>
                                <td class="col-quantity">100</td>
                                <td class="col-cost">$10.00</td>
                                <td class="col-revenue">$1000.00</td>
                            </tr>   <tr>
                                <td class="col-name">Product 1</td>
                                <td class="col-quantity">100</td>
                                <td class="col-cost">$10.00</td>
                                <td class="col-revenue">$1000.00</td>
                            </tr>
                            <tr>
                                <td class="col-name">Product 2</td>
                                <td class="col-quantity">100</td>
                                <td class="col-cost">$10.00</td>
                                <td class="col-revenue">$1000.00</td>
                            </tr>
                            <tr>
                                <td class="col-name">Product 3</td>
                                <td class="col-quantity">100</td>
                                <td class="col-cost">$10.00</td>
                                <td class="col-revenue">$1000.00</td>
                            </tr>
                            <tr>
                                <td class="col-name">Product 4</td>
                                <td class="col-quantity">100</td>
                                <td class="col-cost">$10.00</td>
                                <td class="col-revenue">$1000.00</td>
                            </tr>   <tr>
                                <td class="col-name">Product 1</td>
                                <td class="col-quantity">100</td>
                                <td class="col-cost">$10.00</td>
                                <td class="col-revenue">$1000.00</td>
                            </tr>
                            <tr>
                                <td class="col-name">Product 2</td>
                                <td class="col-quantity">100</td>
                                <td class="col-cost">$10.00</td>
                                <td class="col-revenue">$1000.00</td>
                            </tr>
                            <tr>
                                <td class="col-name">Product 3</td>
                                <td class="col-quantity">100</td>
                                <td class="col-cost">$10.00</td>
                                <td class="col-revenue">$1000.00</td>
                            </tr>
                            <tr>
                                <td class="col-name">Product 4</td>
                                <td class="col-quantity">100</td>
                                <td class="col-cost">$10.00</td>
                                <td class="col-revenue">$1000.00</td>
                            </tr>
                        </table>

                    </table>

                </div>
            </div>
        </div>


    </div>
</div>

</body>
<script type="text/javascript">
    function gentable(){
        var panel = document.getElementById("panel");
        panel.style.display = "block";
    }
</script>
</html>