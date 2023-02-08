<?php $this->view('manager/includes/header') ?>

<body class="manager">
<?php $this->view('manager/includes/manager_header') ?>
    <div class="content manager-body ">
        <div class="dashboard">
            <div class="form-container">
            
                <form method="post">
                    <div class="report-type report-form">
                        <label>Select Report</label>
                        <select name="report_types">
                          <option value="Daily Sales Reports">Daily Sales Reports</option>
                          <option value="Weekly Sales reports">Weekly Sales Reports</option>
                          <option value="Monthly Sales Reports">Monthly Sales Report</option>

                        </select>
                        <p>This reports provides a detailed list of Sales against every settlement in selected time range. Deatils include Daily Sales Reports, Weekly Sales Reports and Monthly Sales Reports</p>


                    </div>
                    <div class="report-type">
                        <label>Select Date</label>
                    </div>

                    <div class="report-type">
                        <label>Select Week</label>


                    </div>
                    <div class="report-type">
                        <label>Select Month</label>
                        <select name="months">
                            <option value="January">January</option>
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


                        </select>
                    </div>

                    <button>Generate Report</button>


                </form>
                
            </div>

           
        </div>
    </div>

</body>
</html>