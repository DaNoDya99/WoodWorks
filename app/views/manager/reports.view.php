<?php $this->view('manager/includes/header') ?>

<body class="manager">
    <?php $this->view('manager/includes/manager_header') ?>
    <div class="content manager-body ">
        <div class="select-reports">
            <ul>
                <li id="overview-link" class="select-link active-section" onclick="changeSection('overview')">Overview</li>
                <li id="products-link" class="select-link" onclick="changeSection('products')">Products</li>
                <li id="orders-link" class="select-link" onclick="changeSection('orders')">Orders</li>
                <li id="catergories-link" class="select-link" onclick="changeSection('catergories')">Catergories</li>
                <li id="coupons-link" class="select-link" onclick="changeSection('coupons')">Coupons</li>

            </ul>
        </div>
        <div class="reports" style="width:100%;">
            <div class="dashboard">

                <label for="">Date Range:</label><br><br>
                <div id="date-range" class="dropdown date-range dashboard" onclick="toggleDropdown()">
                    <p id="date-range-label">Select</p><img id="dropdown-icon" style="width:15px;position:absolute; right:10px;" src="<?= ROOT ?>/assets/images/manager/chevron-down-solid.svg" alt="">

                    <div id="date-overlay" class="dropdown-content date-overlay ">
                        <p>Select Range </p> <button class="closebtn" onclick="toggleDropdown()">Close</button>
                        <form id="form" action="">
                            <label for="date1">From</label>
                            <input name="date1" type="date" value="<?php echo date('Y-m-01'); ?>">
                            <label for="date2">To</label>
                            <input name="date2" type="date" value="<?php echo date('Y-m-d'); ?>">
                            <input type="submit" value="Submit">
                            <input type="reset" value="Reset">
                        </form>

                    </div>
                </div>

                <div class="variable-section">
                    <div class="overview-section">
                        <div>

                            <div style="display:flex; justify-content:space-between">
                                <h2>Performance</h2>
                                <div class="more-settings">
                                    <img class="" style="width:5px" src="<?= ROOT ?>/assets/images/manager/ellipsis-vertical-solid.svg" alt="">
                                </div>
                            </div>
                            <div style="display:flex; justify-content:flex-start; grid-column-gap:10px; grid-row-gap:10px; flex-wrap:wrap">
                                <div class="performance-widget">
                                    <h3>Total Sales</h3>
                                    <h2 id="total-sales-value"><i style="color:grey">Select Range</i></h2>
                                </div>
                                <div class="performance-widget">
                                    <h3>Orders</h3>
                                    <h2 id="total-order-count"><i style="color:grey">Select Range</i></h2>
                                </div>
                                <div class="performance-widget">
                                    <h3>Products Sold</h3>
                                    <h2><i style="color:grey">Select Range</i></h2>
                                </div>
                            </div>
                        </div>
                        <h2 style="margin-top: 40px;">Charts</h2>
                        <div class="charts">
                            <div style="display:flex; justify-content:space-between; column-gap:10px">
                                <h2>Performance</h2>
                                <div class="more-settings">
                                    <img class="" style="width:5px" src="<?= ROOT ?>/assets/images/manager/ellipsis-vertical-solid.svg" alt="">
                                </div>
                            </div>
                            <div style="display:flex;">
                                <div class="chart-component">
                                    <h3>Net Sales</h3>
                                    <canvas id="myChart"></canvas>
                                </div>
                                <div class="chart-component">
                                    <canvas id="myChart2"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="products-section hidden-section">
                        <h2 style="margin-top: 40px;">Charts</h2>
                        <div class="charts">
                            <div style="display:flex; justify-content:space-between; column-gap:10px">
                                <h2>Items Sold</h2>
                                <div class="more-settings">
                                    <img class="" style="width:5px" src="<?= ROOT ?>/assets/images/manager/ellipsis-vertical-solid.svg" alt="">
                                </div>
                            </div>
                            <div style="display:flex;">
                                <div class="chart-component" style="height:50vh; width:100%;">
                                    <h3>Net Sales</h3>
                                    <canvas id="myChart3" height="500px" width="500px"></canvas>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div style="width:100%; height:400px;padding:10px;border-radius:10px; background-color:white">
                            <h2>Products Statistics</h2>
                        </div>
                    </div>
                    <div class="orders-section hidden-section">
                        <h2 style="margin-top: 40px;">Charts</h2>
                        <div class="charts">
                            <div style="display:flex; justify-content:space-between; column-gap:10px">
                                <h2>Items Sold</h2>
                                <div class="more-settings">
                                    <img class="" style="width:5px" src="<?= ROOT ?>/assets/images/manager/ellipsis-vertical-solid.svg" alt="">
                                </div>
                            </div>
                            <div style="display:flex;">
                                <div class="chart-component" style="height:50vh; width:100%;">
                                    <h3>Net Sales</h3>
                                    <canvas id="myChart3" height="500px" width="500px"></canvas>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="catergories-section hidden-section">
                    <h2 style="margin-top: 40px;">Charts</h2>
                    <div class="charts">
                        <div style="display:flex; justify-content:space-between; column-gap:10px">
                            <h2>Items Sold</h2>
                            <div class="more-settings">
                                <img class="" style="width:5px" src="<?= ROOT ?>/assets/images/manager/ellipsis-vertical-solid.svg" alt="">
                            </div>
                        </div>
                        <div style="display:flex;">
                            <div class="chart-component" style="height:50vh; width:100%;">
                                <h3>Net Sales</h3>
                                <canvas id="myChart3" height="500px" width="500px"></canvas>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="coupons-section hidden-section">
                    <h2 style="margin-top: 40px;">Charts</h2>
                    <div class="charts">
                        <div style="display:flex; justify-content:space-between; column-gap:10px">
                            <h2>Items Sold</h2>
                            <div class="more-settings">
                                <img class="" style="width:5px" src="<?= ROOT ?>/assets/images/manager/ellipsis-vertical-solid.svg" alt="">
                            </div>
                        </div>
                        <div style="display:flex;">
                            <div class="chart-component" style="height:50vh; width:100%;">
                                <h3>Net Sales</h3>
                                <canvas id="myChart3" height="500px" width="500px"></canvas>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

    </div>
    </div>
    </div>


</body>
<script type="text/javascript">
    // Define the data for the chart
    const data = {
        labels: ['2', 'February', '', 'May', 'July', 'July', 'July', 'July', 'July', 'July'],
        datasets: [{
            label: 'Sales',
            data: [12, 69, 3, 5, 2, 3, 20, 0, 0, 0, 0, 0],
            fill: true,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
        }]
    };

    // Define the configuration for the chart
    const config = {
        type: 'bar',
        data: data,
        options: {
            animation: {
                duration: false
            },

        }
    };
    const config2 = {
        type: 'line',
        data: data,
        options: {
            animation: {
                duration: 0
            },
            responsive: true,
            maintainAspectRatio: false,
        }
    };

    // Create the chart
    var myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
    var myChart2 = new Chart(
        document.getElementById('myChart2'),
        config
    );
    var myChart3 = new Chart(
        document.getElementById('myChart3'),
        config2
    );
    //onclick
    window.onload = function() {
        e.preventDefault();
        //ajax using fetch to send to php
        fetch('http://localhost/woodworks/public/manager/getReport', {
                method: 'POST',
                //formdata
                body: new FormData(document.getElementById('form'))
            }).then(response => response.json())
            //decode and show json on console
            .then(data => {
                console.log(data);
                document.getElementById('total-sales-value').innerHTML = data.total
                document.getElementById('total-order-count').innerHTML = data.completed[0].count
            })

        var dropdownContent = document.querySelector(".dropdown-content");
        dropdownContent.classList.toggle("show");

        var data1 = document.querySelector("input[name='date1']").value;
        var data2 = document.querySelector("input[name='date2']").value;

        document.getElementById('date-range-label').innerText = data1 + " to " + data2;
    };


    document.getElementById('form').addEventListener('submit', function(e) {
        e.preventDefault();
        //ajax using fetch to send to php
        fetch('http://localhost/woodworks/public/manager/getReport', {
                method: 'POST',
                //formdata
                body: new FormData(document.getElementById('form'))
            }).then(response => response.json())
            //decode and show json on console
            .then(data => {
                console.log(data);
                document.getElementById('total-sales-value').innerHTML = data.total
                document.getElementById('total-order-count').innerHTML = data.completed[0].count
            })

        var dropdownContent = document.querySelector(".dropdown-content");
        dropdownContent.classList.toggle("show");

        var data1 = document.querySelector("input[name='date1']").value;
        var data2 = document.querySelector("input[name='date2']").value;

        document.getElementById('date-range-label').innerText = data1 + " to " + data2;
    });

    //close popup


    function toggleDropdown() {
        var dropdownContent = document.querySelector(".dropdown-content");
        var dropdownArrow = document.querySelector("#dropdown-icon");
        dropdownContent.classList.toggle("show");
        dropdownArrow.classList.toggle("rotate");

    }
    var dropdownContent = document.querySelector(".dropdown-content");

    dropdownContent.onclick = function(event) {
        event.stopPropagation();
    }
    window.onclick = function(event) {
        if (!event.target.matches('.dropdown') && !event.target.matches('.dropdown *')) {
            var dropdownContent = document.querySelector(".dropdown-content");
            if (dropdownContent.classList.contains('show')) {
                dropdownContent.classList.remove('show');
            }
        }
    }

    function changeSection(stringw) {
        //switch statement depending on stringw
        document.querySelector(".overview-section").classList.add("hidden-section");
        document.querySelector(".products-section").classList.add("hidden-section");
        document.querySelector(".orders-section").classList.add("hidden-section");
        document.querySelector(".catergories-section").classList.add("hidden-section");
        document.querySelector(".coupons-section").classList.add("hidden-section");

        //select all links and remove active class
        document.querySelectorAll(".select-link");
        document.querySelectorAll(".select-link").forEach(function(element) {
            element.classList.remove("active-section");
        });

        switch (stringw) {
            case "overview":
                //toggle hidden section
                document.querySelector(".overview-section").classList.toggle("hidden-section");
                document.getElementById("overview-link").classList.add("active-section");
                break;
            case "products":
                //toggle hidden section
                document.querySelector(".products-section").classList.toggle("hidden-section");
                document.getElementById("products-link").classList.add("active-section");



                break;
            case "orders":
                //toggle hidden section
                document.querySelector(".orders-section").classList.toggle("hidden-section");
                document.getElementById("orders-link").classList.add("active-section");
                break;
            case "coupons":
                //toggle hidden section
                document.querySelector(".coupons-section").classList.toggle("hidden-section");
                document.getElementById("coupons-link").classList.add("active-section");
                break;
            case "catergories":
                //toggle hidden section
                document.querySelector(".catergories-section").classList.toggle("hidden-section");
                document.getElementById("catergories-link").classList.add("active-section");
                break;

        }
    }
</script>

</html>