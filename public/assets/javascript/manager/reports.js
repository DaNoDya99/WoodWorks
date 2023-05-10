let activesection = localStorage.getItem('activeSection');
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
            responsive: true,
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
window.onload = function (e) {

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
            SalesChart2.update();
            ordercount.update();
        })

    // document.getElementById("page-no").innerHTML = 1;


    var data1 = document.querySelector("input[name='date1']").value;
    var data2 = document.querySelector("input[name='date2']").value;

    document.getElementById('date-range-label').innerText = data1 + " to " + data2;
    products(data1, data2, 'Paid');
    inventory();
};


document.getElementById('form').addEventListener('submit', function (e) {
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

    var dropdownContent = document.querySelector(".dropdown-content");
    dropdownContent.classList.toggle("show");

    var data1 = document.querySelector("input[name='date1']").value;
    var data2 = document.querySelector("input[name='date2']").value;


    document.getElementById('date-range-label').innerText = data1 + " to " + data2;
    products(data1, data2, 'Paid');
    inventory();
});

let data;

function products(date1, date2, paymentStatus) {
    const perPage = 5; // Number of items to display per page
    let currentPage = 1; // Current page

    // Fetch data from API
    fetch('http://localhost/woodworks/public/manager/productinfo/' + date1 + '/' + date2 + '/' + paymentStatus)
        .then(response => response.json())
        .then(data => {
            console.log(data.detailedinfo);
            const totalItems = data.detailedinfo.length;
            const totalPages = Math.ceil(totalItems / perPage);
            console.log(totalPages);

            // Function to render table rows
            const renderTableRows = (start, end) => {
                const tableBody = document.getElementById('tableBody');
                tableBody.innerHTML = '';
                for (let i = start; i <= end; i++) {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                    <td style>${i + 1}</td>

                    <td>${data.detailedinfo[i].Name}</td>
                    <td>${data.detailedinfo[i].ProductID}</td>
                    <td>${data.detailedinfo[i].Quantity}</td>
                    <td>Rs.${data.detailedinfo[i].Revenue}</td>
                    <td>${data.detailedinfo[i].COUNT1}</td>
                    <td>${data.detailedinfo[i].CategoryID}</td>
                    <td>${data.detailedinfo[i].Availability}</td>  
                `;
                    tableBody.appendChild(row);
                }
            };


            // Function to render pagination buttons
            const renderPaginationButtons = () => {
                const pagination = document.getElementById('pagination');
                console.log(totalPages);
                pagination.innerHTML = '';
                for (let i = 1; i <= totalPages; i++) {
                    console.log(i);
                    const button = document.createElement('button');
                    button.textContent = i;
                    if (i === currentPage) {
                        button.disabled = true;
                    }
                    button.addEventListener('click', () => {
                        currentPage = i;
                        renderTableRows((currentPage - 1) * perPage, currentPage * perPage - 1);
                        renderPaginationButtons();
                    });
                    pagination.appendChild(button);
                }
            };

            renderTableRows(0, perPage - 1);
            renderPaginationButtons();

        })
        .catch(error => console.error(error));

}

function inventory() {
    const perPage = 10; // Number of items to display per page
    let currentPage = 1; // Current page
    // Fetch data from API
    fetch('http://localhost/woodworks/public/manager/inventoryinfo')
        .then(response => response.json())
        .then(data => {
            console.log("inventory");

            console.log(data.inventory);
            const totalItems = data.inventory.length;
            const totalPages = Math.ceil(totalItems / perPage);
            console.log(totalPages);

            // Function to render table rows
            const renderTableRows = (start, end) => {
                const tableBody = document.getElementById('tableBody-inventory');
                tableBody.innerHTML = '';

                for (let i = start; i <= end; i++) {
                    const row = document.createElement('tr');
                    const quantity = data.inventory[i].Quantity;
                    const reorderPoint = data.inventory[i].Reorder_point;
                    const status = data.inventory[i].Status;
                    // Check the stock level and set the appropriate background color
                    if (quantity === 0 || status === 'Out of stock' ) {
                        row.style.backgroundColor = '#f99';
                    } else if (quantity > 0 && quantity <= reorderPoint + 5) {
                        row.style.backgroundColor = '#FFAE42';
                    } else {
                        row.style.backgroundColor = '#D0F0C0';
                    }

                    row.innerHTML = `
            <td>${i + 1}</td>
            <td>${data.inventory[i].ProductID}</td>
            <td>${data.inventory[i].Status}</td>
            <td>${data.inventory[i].Quantity}</td>
            <td>${data.inventory[i].Reorder_point}</td>
            <td>${data.inventory[i].Last_ordered}</td>
            <td>${data.inventory[i].Last_received}</td>  
        `;
                    tableBody.appendChild(row);
                }
            };



            // Function to render pagination buttons
            const renderPaginationButtons = () => {
                const pagination = document.getElementById('pagination-inventory');
                console.log(totalPages);
                pagination.innerHTML = '';
                for (let i = 1; i <= totalPages; i++) {
                    console.log(i);
                    const button = document.createElement('button');
                    button.textContent = i;
                    if (i === currentPage) {
                        button.disabled = true;
                    }
                    button.addEventListener('click', () => {
                        currentPage = i;
                        renderTableRows((currentPage - 1) * perPage, currentPage * perPage - 1);
                        renderPaginationButtons();
                    });
                    pagination.appendChild(button);
                }
            };

            renderTableRows(0, perPage - 1);
            renderPaginationButtons();

        })
        .catch(error => console.error(error));
}

var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Category A', 'Category B', 'Category C'],
        datasets: [
            {
                label: 'Stock',
                data: [20, 15, 30],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            },
            {
                label: 'Reorder Point',
                data: [10, 12, 25],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }
        ]
    },
    options: {
        aspectRatio: 1.5,
        scales: {
            y: {
                beginAtZero: true
            }
        },
        plugins: {
            title: {
                display: true,
                text: 'Stock vs. Reorder Point',
                align: 'start',
                font: {
                    size: 20,
                    weight: 'bold'
                }
            }
        }
    }
});

//close popup

document.getElementById('paymentStatus').addEventListener('change', (event) => {
    const paymentStatus = event.target.value;
    var date1 = document.querySelector("input[name='date1']").value;
    var date2 = document.querySelector("input[name='date2']").value;

    console.log(date1);
    console.log(date2);
    console.log(paymentStatus);
    products(date1, date2, paymentStatus);
});

function toggleDropdown() {
    var dropdownContent = document.querySelector(".dropdown-content");
    var dropdownArrow = document.querySelector("#dropdown-icon");
    dropdownContent.classList.toggle("show");
    dropdownArrow.classList.toggle("rotate");

}

var dropdownContent = document.querySelector(".dropdown-content");

dropdownContent.onclick = function (event) {
    event.stopPropagation();
}
window.onclick = function (event) {
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
    document.querySelector(".inventory-section").classList.add("hidden-section");
    document.querySelector(".catergories-section").classList.add("hidden-section");
    document.querySelector(".coupons-section").classList.add("hidden-section");

    //select all links and remove active class
    document.querySelectorAll(".select-link");
    document.querySelectorAll(".select-link").forEach(function (element) {
        element.classList.remove("active-section");
        //enable and color #date-range
        document.getElementById("date-range").setAttribute("onclick", "toggleDropdown()");
        document.getElementById("date-range").style.cursor = "pointer";
        document.getElementById("date-range").style.color = "#000";
        document.getElementById("date-range").style.border = "1px solid #000";
        document.getElementById("date-range").style.backgroundColor = "#fff";


    });

    switch (stringw) {
        case "overview":
            //toggle hidden section
            document.querySelector(".overview-section").classList.toggle("hidden-section");
            document.getElementById("overview-link").classList.add("active-section");
            localStorage.setItem('activeSection', stringw);
            //enable and color #date-range
            document.getElementById("date-range").setAttribute("onclick", "toggleDropdown()");
            document.getElementById("date-range").style.cursor = "pointer";
            document.getElementById("date-range").style.color = "#000";
            document.getElementById("date-range").style.border = "1px solid #000";
            document.getElementById("date-range").style.backgroundColor = "#fff";


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
            //enable and color #date-range
            document.getElementById("date-range").setAttribute("onclick", "toggleDropdown()");
            document.getElementById("date-range").style.cursor = "pointer";
            document.getElementById("date-range").style.color = "#000";
            document.getElementById("date-range").style.border = "1px solid #000";
            document.getElementById("date-range").style.backgroundColor = "#fff";


            break;
        case "inventory":
            document.querySelector(".inventory-section").classList.toggle("hidden-section");
            document.getElementById("inventory-link").classList.add("active-section");
            localStorage.setItem('activeSection', stringw);

            //disable #date-range onclick event
            document.getElementById("date-range").removeAttribute("onclick");
            document.getElementById("date-range").style.cursor = "default";
            //grey out #date-range
            document.getElementById("date-range").style.color = "#bfbfbf";
            document.getElementById("date-range").style.border = "1px solid #bfbfbf";
            document.getElementById("date-range").style.backgroundColor = "#f2f2f2";

            break;
        case "coupons":
            //toggle hidden section
            document.querySelector(".coupons-section").classList.toggle("hidden-section");
            document.getElementById("coupons-link").classList.add("active-section");
            localStorage.setItem('activeSection', stringw);

            //enable and color #date-range
            document.getElementById("date-range").setAttribute("onclick", "toggleDropdown()");
            document.getElementById("date-range").style.cursor = "pointer";
            document.getElementById("date-range").style.color = "#000";
            document.getElementById("date-range").style.border = "1px solid #000";
            document.getElementById("date-range").style.backgroundColor = "#fff";


            break;
        case "catergories":
            //toggle hidden section
            document.querySelector(".catergories-section").classList.toggle("hidden-section");
            document.getElementById("catergories-link").classList.add("active-section");
            localStorage.setItem('activeSection', stringw);
            //enable and color #date-range
            document.getElementById("date-range").setAttribute("onclick", "toggleDropdown()");
            document.getElementById("date-range").style.cursor = "pointer";
            document.getElementById("date-range").style.color = "#000";
            document.getElementById("date-range").style.border = "1px solid #000";
            document.getElementById("date-range").style.backgroundColor = "#fff";


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

function exportCSV(reportType) {

    var data1 = document.querySelector("input[name='date1']").value;
    var data2 = document.querySelector("input[name='date2']").value;
    var status = document.getElementById('paymentStatus').value;

    fetch('http://localhost/woodworks/public/manager/reportCSV/' + reportType + '/' + data1 + '/' + data2 + '/' + status, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: reportType,
    })
        //download csv file
        .then(response => response.text())
        .then(csv => {
            const blob = new Blob([csv], {
                type: 'text/csv'
            });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = reportType + '_' + data1 + '_to_' + data2 + '.csv';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        })
}