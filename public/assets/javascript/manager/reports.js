let activesection = localStorage.getItem('activeSection');
if (activesection == null) {
    activesection = 'products';
}
changeSection(activesection);


var RatingsChart = new Chart(document.getElementById('RatingsChart'), {
    type: 'bar',
    options: {
        aspectRatio: 1.5, responsive: true, animation: {},
        scales: {}, tooltips: {
            enabled: true
        }, plugins: {
            title: {
                display: true, text: 'Top Products By Ratings (For All Time)', align: 'start', font: {
                    size: 20, weight: 'bold'
                }
            }
        }

    }
});

function getTopRatings() {
    fetch("http://localhost/WoodWorks/public/manager/getTop10Products")
        .then(response => response.json())
        .then(data => {
            let labels = [];
            let values = [];
            console.log(data);
            data.forEach(item => {
                labels.push(item.ProductID);
                values.push(item.Average);
            })
            console.log(labels);
            console.log(values);
            RatingsChart.data = {
                labels: labels, datasets: [{
                    label: 'Ratings',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                    data: values
                }]
            };
            RatingsChart.update();
        })
}

var TopSellingChart = new Chart(document.getElementById('Topselling'), {
    type: 'bar',
    options: {
        aspectRatio: 1.5,
        responsive: true,
        animation: {},
        scales: {
            y: {
                beginAtZero: true,
                precision: 0,
                ticks: {
                    stepSize: 1,

                },
                suggestedMax: 10 // Set the suggested maximum value of the y-axis to be 10 greater than the maximum value in your data
            }
        },
        tooltips: {
            enabled: true
        },
        plugins: {
            title: {
                display: true,
                text: 'Highest Sold Products (For All Time)',
                align: 'start',
                font: {
                    size: 20,
                    weight: 'bold'
                }
            }
        }
    }

});

function getTopProducts() {
    fetch("http://localhost/WoodWorks/public/manager/getTopSellingProducts")
        .then(response => response.json())
        .then(data => {
            let labels = [];
            let values = [];
            console.log(data);
            data.forEach(item => {
                labels.push(item.ProductID);
                values.push(item.QuantitySold);
            })
            console.log(labels);
            console.log(values);
            TopSellingChart.data = {
                labels: labels, datasets: [{
                    label: 'Quantity Sold',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                    data: values
                }]
            };
            TopSellingChart.update();
        })
}


//onclick
window.onload = function (e) {
    e.preventDefault();
    //ajax using fetch to send to php
    //
    //
    const date1 = new Date(document.getElementById('date1-input').value);
    const date2 = new Date(document.getElementById('date2-input').value);
    //
    // const diffInDays = Math.floor((date2.getTime() - date1.getTime()) / 86400000);
    //
    // if (diffInDays < 30) {
    //     SalesChart2.options.scales.x.time.unit = 'day';
    //     orderchart.options.scales.x.time.unit = 'day';
    //
    // } else if (diffInDays < 365) {
    //     SalesChart2.options.scales.x.time.unit = 'month';
    //     orderchart.options.scales.x.time.unit = 'month';
    // } else {
    //     SalesChart2.options.scales.x.time.unit = 'year';
    //     orderchart.options.scales.x.time.unit = 'year';
    // }
    // //update chart
    // SalesChart2.data.labels = data.labels;
    // SalesChart2.data.datasets[0].data = data.test;
    //
    getorderchart();
    getTopRatings();
    getOrderDescription();
    getTopProducts();


    // document.getElementById("page-no").innerHTML = 1;


    var data1 = document.querySelector("input[name='date1']").value;
    var data2 = document.querySelector("input[name='date2']").value;
    //
    document.getElementById('date-range-label').innerText = data1 + " to " + data2;
    products(data1, data2, 'Paid');
    inventory();
    getReorderDetails();
    getCatergoryDescription(data1, data2);
    getCatergoryDist()
    salesChart2(data1, data2);

    exportTableToCSV('apple');
    // getorderchart();

}


document.getElementById('form').addEventListener('submit', function (e) {
    e.preventDefault();

    const date1 = new Date(document.getElementById('date1-input').value);
    const date2 = new Date(document.getElementById('date2-input').value);
    if (date1.getTime() <= date2.getTime()) {


        //ajax using fetch to send to php

        const diffInDays = Math.floor((date2.getTime() - date1.getTime()) / 86400000);

        if (diffInDays < 30) {
            orderchart.options.scales.x.time.unit = 'day';
            SalesChart2.options.scales.x.time.unit = 'day';
        } else if (diffInDays < 365) {
            orderchart.options.scales.x.time.unit = 'month';
            SalesChart2.options.scales.x.time.unit = 'month';
        } else {
            orderchart.options.scales.x.time.unit = 'year';
            SalesChart2.options.scales.x.time.unit = 'year';
        }
        //update chart
        getorderchart();


        var dropdownContent = document.querySelector(".dropdown-content");
        dropdownContent.classList.toggle("show");

        var data1 = document.querySelector("input[name='date1']").value;
        var data2 = document.querySelector("input[name='date2']").value;


        document.getElementById('date-range-label').innerText = data1 + " to " + data2;
        products(data1, data2, 'Paid');
        getCatergoryDescription(data1, data2);
        inventory();
        salesChart2(data1, data2);

    } else {
        alert('Invalid Date Range');
    }
});

let data;

function products(date1, date2, paymentStatus) {
    const perPage = 10; // Number of items to display per page
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


                    <td>${data.detailedinfo[i].Name}</td>
                    <td>${data.detailedinfo[i].ProductID}</td>
                    <td>${data.detailedinfo[i].Quantity}</td>
                    <td>Rs. ${data.detailedinfo[i].Revenue}</td>
                    <td>${data.detailedinfo[i].COUNT1}</td>
                    <td>${data.detailedinfo[i].CategoryID}</td>

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
                    if (quantity === 0 || status === 'Out of stock') {
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
    document.querySelector(".products-section").classList.add("hidden-section");
    document.querySelector(".orders-section").classList.add("hidden-section");
    document.querySelector(".inventory-section").classList.add("hidden-section");
    document.querySelector(".catergories-section").classList.add("hidden-section");

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

// Inventory Page Reoder Levels Chart

var salresReorder2 = new Chart(document.getElementById('reorderchart2'), {
    type: 'bar', data: {
        labels: [], datasets: [{
            label: 'Orders', data: [],


            backgroundColor: '#9BD0F5', tension: 0
        }]
    },

    options: {

        maintainAspectRatio: false, // aspectRatio: 1.5,
        tooltips: {
            enabled: true
        }, plugins: {
            title: {
                display: true, text: 'Inventory Reorder Levels', align: 'start', font: {
                    size: 20, weight: 'bold'
                }
            }
        }

    }
});


function getReorderDetails() {
    fetch('http://localhost/WoodWorks/public/manager/getProductsReachedReorderLevel')
        .then(response => response.json())
        .then(data => {
            let labels = []
            let values1 = []
            let values2 = []

            data.forEach(item => {
                labels.push(item.ProductID);
                values1.push(item.Quantity);
                values2.push(item.Reorder_point);
            })
            //
            let chartdata = {
                labels: labels, datasets: [{
                    label: 'Inventory Level',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                    data: values1
                }, {
                    label: 'Reorder Level',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    data: values2
                }]
            }

            salresReorder2.data = chartdata;
            salresReorder2.update();


        })
}


//setup order analytics orders page


var orderchart = new Chart(document.getElementById('orderchart2'), {
    type: 'bar', data: {
        labels: [], datasets: [{
            label: 'Orders', data: [], backgroundColor: '#9BD0F5', tension: 0
        }]
    }, options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true, stepSize: 1
                }
            }]
        }, maintainAspectRatio: false, // aspectRatio: 1.5,
        tooltips: {
            enabled: true
        }, plugins: {
            title: {
                display: true, text: 'Orders', align: 'start', font: {
                    size: 20, weight: 'bold'
                }
            }
        }, aspectRatio: 3, responsive: true, animation: {}, scales: {
            x: {
                type: 'time', time: {
                    unit: 'day',
                }
            }, y: {
                display: true, title: {
                    display: true, text: 'No. of Orders', font: {
                        size: 15,
                    }
                }
            }
        }


    }
});


function getorderchart() {
    fetch("http://localhost/WoodWorks/public/manager/getOrdersForDateRange", {
        method: 'POST', body: new FormData(document.getElementById('form'))
    })
        .then(response => response.json())
        .then(data => {
            let labels = [];
            let value = [];
            // console.log(value);

            //chart definitions

            let chartdata = {
                labels: data.labels, datasets: [{
                    label: 'Orders',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                    data: data.values
                }]
            }
            orderchart.data = chartdata;
            orderchart.update();


        })
        .catch(error => console.log(error));
}

var catergorydistr = new Chart(document.getElementById('catergorydist'), {
    type: 'doughnut',
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
        responsive: true,
        maintainAspectRatio: false,
        aspectRatio: 1,
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Category Distribution Across Inventory',
                align: 'start',  // Align the title to the left
                font: {
                    size: 15,
                }
            }
        }
    }
});

function getCatergoryDist() {
    fetch("http://localhost/WoodWorks/public/manager/CatergoryDist")
        .then(response => response.json())
        .then(data => {
            let labels = [];
            let value = [];
            data.forEach(item => {
                labels.push(item.CategoryID);
                value.push(item.Quantity);
            });
            console.log(data);
            let chartdata = {
                labels: labels,
                datasets: [{
                    label: 'Categories',
                    data: value
                }]
            };
            catergorydistr.data = chartdata;
            catergorydistr.update();
        })
        .catch(error => console.log(error));
}

function getOrderDescription() {


    const perPage = 6; // Number of items to display per page
    let currentPage = 1; // Current page

    fetch("http://localhost/WoodWorks/public/manager/orderlists", {
        method: 'POST', body: new FormData(document.getElementById('form'))
    })
        .then(response => response.json())
        .then(data => {
            const totalItems = data.length;
            console.log(data);
            const totalPages = Math.ceil(totalItems / perPage);
            const renderTableRows = (start, end) => {
                const tableBody = document.getElementById('tableBody-orders');
                tableBody.innerHTML = '';
                for (let i = start; i <= Math.min(end, data.length - 1); i++) {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                    <td>${data[i].Date}</td>
                    <td>123456</td>
                    <td>${data[i].Status}</td>
                    <td>${data[i].Customer}</td>
                    <td>${data[i].Products}</td>
                    <td>${data[i].ItemsSold}</td>
                    <td>${data[i].NetSales}</td>  
                `;
                    tableBody.appendChild(row);
                }
            };

            const renderPaginationButtons = () => {
                const pagination = document.getElementById('pagination-orders');
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
            console.log("Test-> " + data[0].Date);

            renderTableRows(0, perPage - 1);

            renderPaginationButtons();
        })


}

function getCatergoryDescription($date1, $date2) {


    const perPage = 5; // Number of items to display per page
    let currentPage = 1; // Current page

    fetch("http://localhost/WoodWorks/public/manager/catergoryDetails/" + $date1 + "/" + $date2)
        .then(response => response.json())
        .then(data => {
            const totalItems = data.length;
            console.log(data);
            const totalPages = Math.ceil(totalItems / perPage);
            const renderTableRows = (start, end) => {
                const tableBody = document.getElementById('tableBody-categories');
                tableBody.innerHTML = '';
                for (let i = start; i <= Math.min(end, data.length - 1); i++) {
                    const row = document.createElement('tr');
                    console.log('test ' + i);
                    row.innerHTML = `
                    <td>${data[i].CatergoryID}</td>
                    <td>${data[i].Catergory}</td>
                    <td>${data[i].ItemsSold}</td>
                    <td>${data[i].NetSales}</td>
                    <td>${data[i].Orders}</td>
                    
                `;
                    tableBody.appendChild(row);
                }
            };

            const renderPaginationButtons = () => {
                const pagination = document.getElementById('pagination-catergory');
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
            console.log("Test-> " + data[0].Date);

            renderTableRows(0, perPage - 1);

            renderPaginationButtons();
        })


}

var SalesChart2 = new Chart(
    document.getElementById('SalesChart2'), {
    type: 'line',
    data: {},
    options: {
        aspectRatio: 1.5,
        maintainAspectRatio: false,
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


function salesChart2(date1, date2) {

    fetch("http://localhost/WoodWorks/public/manager/getOrdersChart/" + date1 + "/" + date2)
        .then(response => response.json())
        .then(data => {
            let labels = data.labels;
            let values = data.order;

            let chartdata = {
                labels: labels,
                datasets: [{
                    label: 'Sales',
                    data: values,
                    fill: false,
                    borderColor: 'rgb(0, 156, 99)',
                    tension: 0
                }]
            }

            SalesChart2.data = chartdata;
            SalesChart2.update();
        })

}

