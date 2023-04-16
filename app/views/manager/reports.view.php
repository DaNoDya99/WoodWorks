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
        <div class="reports">
            <div class="dashboard">

                <label for="">Date Range:</label><br><br>
                <div id="date-range" class="dropdown date-range dashboard" onclick="toggleDropdown()">
                    <p id="date-range-label">Select</p><img id="dropdown-icon" src="<?= ROOT ?>/assets/images/manager/chevron-down-solid.svg" alt="">

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
                            <div class="widget-header">
                                <h2>Performance</h2>
                            </div>
                            <div class="widget-holder">
                                <div class="performance-widget">
                                    <div class="widget-title-area">
                                        <h3>Total Sales</h3>
                                        <img src="<?= ROOT ?>/assets/images/manager/info.svg" alt="" onmouseover="tooltip(1)" onmouseleave="tooltipoff(1)">
                                        <div class="tooltip tooltip1 hidden-section">Revenue from Sales</div>
                                    </div>
                                    <h2 id="total-sales-value"><i style="color:grey">Select Range</i></h2>
                                </div>
                                <div class="performance-widget">
                                    <div class="widget-title-area">
                                        <h3>Orders</h3>
                                        <img src="<?= ROOT ?>/assets/images/manager/info.svg" alt="" onmouseover="tooltip(2)" onmouseleave="tooltipoff(2)">
                                        <div class="tooltip tooltip2 hidden-section">Revenue from Sales</div>

                                    </div>
                                    <h2 id="total-order-count"><i style="color:grey">Select Range</i></h2>
                                </div>
                                <div class="performance-widget">
                                    <div class="widget-title-area">
                                        <h3>Products Sold</h3>
                                        <img src="<?= ROOT ?>/assets/images/manager/info.svg" alt="" onmouseover="tooltip(3)" onmouseleave="tooltipoff(3)">
                                        <div class="tooltip tooltip3 hidden-section">Revenue from Sales</div>

                                    </div>
                                    <h2 id="total-products-sold"><i style="color:grey">Select Range</i></h2>
                                </div>
                            </div>
                        </div>
                        <h2>Charts</h2>
                        <div class="charts">
                            <div class="chart-container">
                                <div class="chart-component">
                                    <canvas id="mainSalesChart"></canvas>
                                </div>
                                <div class="chart-component">
                                    <canvas id="ordercount"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product Section -->
                    <div class="products-section hidden-section">
                        <div>
                            <div class="widget-header">
                                <h2>Performance</h2>
                            </div>
                            <div class="widget-holder">
                                <div class="performance-widget">
                                    <div class="widget-title-area">
                                        <h3>Total Sales</h3>
                                        <img src="<?= ROOT ?>/assets/images/manager/info.svg" alt="" onmouseover="tooltip(1)" onmouseleave="tooltipoff(1)">
                                        <div class="tooltip tooltip1 hidden-section">Revenue from Sales</div>
                                    </div>
                                    <h2 id="total-sales-value"><i style="color:grey">Select Range</i></h2>
                                </div>
                                <div class="performance-widget">
                                    <div class="widget-title-area">
                                        <h3>Orders</h3>
                                        <img src="<?= ROOT ?>/assets/images/manager/info.svg" alt="" onmouseover="tooltip(2)" onmouseleave="tooltipoff(2)">
                                        <div class="tooltip tooltip2 hidden-section">Revenue from Sales</div>

                                    </div>
                                    <h2 id="total-order-count"><i style="color:grey">Select Range</i></h2>
                                </div>
                                <div class="performance-widget">
                                    <div class="widget-title-area">
                                        <h3>Products Sold</h3>
                                        <img src="<?= ROOT ?>/assets/images/manager/info.svg" alt="" onmouseover="tooltip(3)" onmouseleave="tooltipoff(3)">
                                        <div class="tooltip tooltip3 hidden-section">Revenue from Sales</div>

                                    </div>
                                    <h2 id="total-products-sold"><i style="color:grey">Select Range</i></h2>
                                </div>
                            </div>
                        </div>

                        <div class="charts">
                            <div class="chart-container">
                                <div class="chart-component">
                                    <canvas id="SalesChart2"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="list product-list">
                            <div class="product-list-header">
                                <h3>Products</h3>
                                <div>
                                    <input type="text" placeholder="Search for a product" style="height:40px; width:300px; padding:10px; border-radius:5px; border:1px solid grey; margin-right:10px;">
                                    <a href="#">Export to PDF</a>
                                </div>

                            </div>

                            <table>
                                <thead>
                                    <tr style="border-radius:5px;border-bottom: 1px solid black; background-color:wheat; height:50px">
                                        <th>Product Name</th>
                                        <th>SKU</th>
                                        <th>Items Sold</th>
                                        <th>Net Sales</th>
                                        <th>Orders</th>
                                        <th>Catergory</th>
                                        <th>Stock</th>
                                    </tr>
                                </thead>

                                <tbody id="products">
                                    <!-- get rows from ajax call -->



                                </tbody>

                            </table>
                            <div class="pager-button">
                                <button onclick="page('prev')"><img style="width:15px" src="<?= ROOT ?>/assets/images/manager/caret-left-solid.svg" alt=""></button>
                                <p id="page-no">1</p>
                                <button onclick="page('next')"><img style="width:15px" src="<?= ROOT ?>/assets/images/manager/caret-right-solid.svg" alt=""></button>


                            </div>

                        </div>
                    </div>
                </div>
                <div class="orders-section hidden-section">

                </div>
                <div class="catergories-section hidden-section">

                </div>
                <div class="coupons-section hidden-section">
                </div>
            </div>


        </div>

    </div>
    </div>
    </div>
</body>
<script type="text/javascript">
    var activesection = localStorage.getItem('activeSection');
    if (activesection == null) {
        activesection = 'overview';
    }
    changeSection(activesection);

    // Create the chart
    var mainSalesChart = new Chart(
        document.getElementById('mainSalesChart'), {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'Sales',
                    data: [],
                    fill: false,
                    borderColor: 'rgb(0, 156, 99)',
                    tension: 0
                }]
            },
            options: {
                aspectRatio: 1.5,

                animation: {},
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: 'day',
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Rupees',
                            font: {
                                size: 15,
                            }
                        }
                    }
                },
                tooltips: {
                    enabled: true
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Sales',
                        align: 'start',
                        font: {
                            size: 20,
                            weight: 'bold'
                        }
                    }
                }

            }
        }
    );
    var SalesChart2 = new Chart(
        document.getElementById('SalesChart2'), {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'Sales',
                    data: [],
                    fill: false,
                    borderColor: 'rgb(0, 156, 99)',
                    tension: 0
                }]
            },
            options: {
                aspectRatio: 3,

                animation: {},
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: 'day',
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Rupees',
                            font: {
                                size: 15,
                            }
                        }
                    }
                },
                tooltips: {
                    enabled: true
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Sales',
                        align: 'start',
                        font: {
                            size: 20,
                            weight: 'bold'
                        }
                    }
                }

            }
        }
    );
    var ordercount = new Chart(
        document.getElementById('ordercount'), {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: 'Orders',
                    data: [],


                    backgroundColor: '#9BD0F5',
                    tension: 0
                }]
            },

            options: {

                animation: {},
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: 'day',
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Quanitity',
                            //size
                            font: {
                                size: 15,

                            }
                        }
                    }
                },
                aspectRatio: 1.5,
                tooltips: {
                    enabled: true
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Orders',
                        align: 'start',
                        font: {
                            size: 20,
                            weight: 'bold'
                        }
                    }
                }

            }
        }
    );

    //onclick
    window.onload = function(e) {
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
                document.getElementById('total-sales-value').innerHTML = "Rs. " + data.total
                document.getElementById('total-order-count').innerHTML = data.completed[0].count
                document.getElementById('total-products-sold').innerHTML = data.products_sold[0].total;
                const date1 = new Date(data.date1);
                const date2 = new Date(data.date2);

                const diffInDays = Math.floor((date2.getTime() - date1.getTime()) / 86400000);

                if (diffInDays < 30) {
                    mainSalesChart.options.scales.x.time.unit = 'day';
                    SalesChart2.options.scales.x.time.unit = 'day';
                    ordercount.options.scales.x.time.unit = 'day';
                } else if (diffInDays < 365) {
                    mainSalesChart.options.scales.x.time.unit = 'month';
                    SalesChart2.options.scales.x.time.unit = 'month';
                    ordercount.options.scales.x.time.unit = 'month';
                } else {
                    mainSalesChart.options.scales.x.time.unit = 'year';
                    ordercount.options.scales.x.time.unit = 'year';
                    SalesChart2.options.scales.x.time.unit = 'year';
                }
                //update chart
                mainSalesChart.data.labels = data.labels;
                mainSalesChart.data.datasets[0].data = data.test;
                SalesChart2.data.labels = data.labels;
                ordercount.data.labels = data.labels;
                ordercount.data.datasets[0].data = data.ordercount;
                SalesChart2.data.datasets[0].data = data.test;

                mainSalesChart.update();
                ordercount.update();
            })

        var dropdownContent = document.querySelector(".dropdown-content");
        // dropdownContent.classList.toggle("show");
        document.getElementById("page-no").innerHTML = 1;


        var data1 = document.querySelector("input[name='date1']").value;
        var data2 = document.querySelector("input[name='date2']").value;

        document.getElementById('date-range-label').innerText = data1 + " to " + data2;
        products(1);

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


                const date1 = new Date(data.date1);
                const date2 = new Date(data.date2);

                const diffInDays = Math.floor((date2.getTime() - date1.getTime()) / 86400000);

                if (diffInDays < 30) {
                    mainSalesChart.options.scales.x.time.unit = 'day';
                    ordercount.options.scales.x.time.unit = 'day';
                } else if (diffInDays < 365) {
                    mainSalesChart.options.scales.x.time.unit = 'month';
                    ordercount.options.scales.x.time.unit = 'month';
                } else {
                    mainSalesChart.options.scales.x.time.unit = 'year';
                    ordercount.options.scales.x.time.unit = 'year';
                }
                //update chart
                mainSalesChart.data.labels = data.labels;
                mainSalesChart.data.datasets[0].data = data.test;
                ordercount.data.labels = data.labels;
                ordercount.data.datasets[0].data = data.ordercount;
                SalesChart2.data.labels = data.labels;
                SalesChart2.data.datasets[0].data = data.test;

                mainSalesChart.update();

                ordercount.update();
                SalesChart2.update();

            })

        document.getElementById("page-no").innerHTML = 1;
        var dropdownContent = document.querySelector(".dropdown-content");
        dropdownContent.classList.toggle("show");

        var data1 = document.querySelector("input[name='date1']").value;
        var data2 = document.querySelector("input[name='date2']").value;



        document.getElementById('date-range-label').innerText = data1 + " to " + data2;
        products(1);
    });

    function products(pageno) {
        fetch('http://localhost/woodworks/public/manager/productinfo/' + pageno, {
                method: 'POST',
            }).then(response => response.json())
            //decode and show json on console
            .then(data => {
                // data = JSON.stringify(data);
                // data = JSON.parse(data);
                console.log(data.detailedinfo[0]);
                var tbody = document.getElementById("products");
                tbody.innerHTML = "";

                data.detailedinfo.forEach(rowData => {
                    const row = document.createElement('tr'); // Create a new table row

                    // Create cells for each column
                    const cell1 = document.createElement('td');
                    cell1.textContent = rowData.Name; // Replace with the appropriate data property
                    row.appendChild(cell1); // Append cell to the row

                    const cell2 = document.createElement('td');
                    cell2.textContent = rowData.ProductID; // Replace with the appropriate data property
                    row.appendChild(cell2); // Append cell to the row

                    const cell3 = document.createElement('td');
                    cell3.textContent = rowData.Quantity; // Replace with the appropriate data property
                    row.appendChild(cell3); // Append cell to the row

                    const cell4 = document.createElement('td');
                    cell4.textContent = rowData.Revenue; // Replace with the appropriate data property
                    row.appendChild(cell4); // Append cell to the row

                    const cell5 = document.createElement('td');
                    cell5.textContent = rowData.COUNT1; // Replace with the appropriate data property
                    row.appendChild(cell5); // Append cell to the row

                    const cell6 = document.createElement('td');
                    cell6.textContent = rowData.CategoryID; // Replace with the appropriate data property
                    row.appendChild(cell6); // Append cell to the row

                    const cell7 = document.createElement('td');
                    cell7.textContent = rowData.Availability; // Replace with the appropriate data property
                    row.appendChild(cell7); // Append cell to the row


                    tbody.appendChild(row); // Append row to the table body
                });
            })

    }

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
                localStorage.setItem('activeSection', stringw);
                break;
            case "products":
                //toggle hidden section
                document.querySelector(".products-section").classList.toggle("hidden-section");
                document.getElementById("products-link").classList.add("active-section");
                localStorage.setItem('activeSection', stringw);

                break;
            case "orders":
                //toggle hidden section
                document.querySelector(".orders-section").classList.toggle("hidden-section");
                document.getElementById("orders-link").classList.add("active-section");
                localStorage.setItem('activeSection', stringw);

                break;
            case "coupons":
                //toggle hidden section
                document.querySelector(".coupons-section").classList.toggle("hidden-section");
                document.getElementById("coupons-link").classList.add("active-section");
                localStorage.setItem('activeSection', stringw);

                break;
            case "catergories":
                //toggle hidden section
                document.querySelector(".catergories-section").classList.toggle("hidden-section");
                document.getElementById("catergories-link").classList.add("active-section");
                localStorage.setItem('activeSection', stringw);

                break;

        }
    }

    function tooltip(num) {
        var tooltip1 = document.getElementsByClassName("tooltip1");
        var tooltip2 = document.getElementsByClassName("tooltip2");
        var tooltip3 = document.getElementsByClassName("tooltip3");
        if (num == 1) {
            tooltip1[0].classList.toggle("hidden-section");
        } else if (num == 2) {
            tooltip2[0].classList.toggle("hidden-section");
        } else if (num == 3) {
            tooltip3[0].classList.toggle("hidden-section");
        }
    }

    function tooltipoff(num) {
        var tooltip1 = document.getElementsByClassName("tooltip1");
        var tooltip2 = document.getElementsByClassName("tooltip2");
        var tooltip3 = document.getElementsByClassName("tooltip3");
        if (num == 1) {
            tooltip1[0].classList.toggle("hidden-section");
        } else if (num == 2) {
            tooltip2[0].classList.toggle("hidden-section");
        } else if (num == 3) {
            tooltip3[0].classList.toggle("hidden-section");
        }
    }

    function bar() {
        mainSalesChart.config.type = 'bar';

        mainSalesChart.update();
    }

    function page(direction) {
        pageno = 1;
        no_of_records_per_page = 5;
        total_pages = Math.ceil(10 / 5);

        if (direction == "next" && pageno < total_pages) {
            pageno++;
        } else if (direction == "prev" && pageno > 1) {
            pageno--;
        }

        products(pageno);

        document.getElementById("page-no").innerHTML = pageno;

    }
</script>

</html>