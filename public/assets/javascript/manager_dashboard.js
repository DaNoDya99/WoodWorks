let today = new Date();
let lastWeek = new Date(today.getTime() - 7 * 24 * 60 * 60 * 1000);

const ctx1 = document.getElementById("myChart1").getContext("2d");
const ctx2 = document.getElementById("myChart2").getContext("2d");
const ctx3 = document.getElementById("myChart3").getContext("2d");
const ctx6 = document.getElementById("myChart6").getContext("2d");

window.onload = () => {
    chart1();
    chart2();
    chart3();
    chart6();
    getPendingIssues();
    getPendingDesigns();
    getActiveDiscounts();
    getSoldOutRefurnishedProducts();
}

function chart1() {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/WoodWorks/public/manager/getTopSellingProducts', true);
    xhr.onload = () => {
        if (xhr.readyState === xhr.DONE) {
            if (xhr.status === 200) {
                console.log(xhr.response);
                let res = JSON.parse(xhr.response);
                let labels = [];
                let values = [];

                res.forEach(element => {
                    labels.push(element.ProductID);
                    values.push(element.QuantitySold);
                });

                let data = {
                    labels: labels,
                    datasets: [{
                        data: values,
                        backgroundColor: [
                            "#FF6384",
                            "#36A2EB",
                            "#FFCE56",
                            "#4BC0C0",
                            "#E7E9ED",
                            "#d171e7",
                            "#32ae1d",
                            "#eb9da4",
                            "#999cfe",
                            "#ed9768",
                        ]
                    }]
                };

                let options = {
                    responsive: true,
                    maintainAspectRatio: false,
                    tooltips: {
                        enabled: false,
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Top Selling Products Last Week',
                            font: {
                                size: 16,
                                weight: 'bold',
                            },
                            color: '#000',
                        },
                        dataLabels: {
                            formatter: (value, ctx1) => {
                                let sum = 0;
                                let dataArr = ctx1.chart.data.datasets[0].data;
                                dataArr.map(data => {
                                    sum += data;
                                });
                                return (value * 100 / sum).toFixed(2) + "%";
                            },
                            color: '#fff',
                        },
                        legend: {
                            display: true,
                            position: 'right',
                        }
                    },
                };

                new Chart(ctx1, {
                    type: 'doughnut',
                    data: data,
                    options: options
                });
            }


        }
    }
    xhr.send();

}

function chart2() {

    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/WoodWorks/public/manager/getTop10Products', true);
    xhr.onload = () => {
        if (xhr.readyState === xhr.DONE) {
            if (xhr.status === 200) {
                console.log(xhr.response);
                let res = JSON.parse(xhr.response);
                let labels = [];
                let values = [];

                res.forEach(element => {
                    labels.push(element.ProductID);
                    values.push(element.Average);
                });
                new Chart(ctx2, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Rating',
                            data: values,
                            backgroundColor: 'rgba(24,157,92,0.3)',
                            borderColor: 'rgb(3,128,69)',
                            borderWidth: 2,
                            hoverBackgroundColor: 'rgba(2,198,106,0.3)',
                            fontColor: '#000',
                        }],
                        tension: 0,

                    },
                    options: {
                        responsive: true,
                        aspectRatio: 1,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                ticks: {
                                    color: '#000',
                                },
                                title: {
                                    display: true,
                                    text: 'Customer Rating',
                                    font: {
                                        size: 14,
                                        weight: 'bold',
                                    },
                                    color: '#000',
                                }
                            },
                            x: {
                                ticks: {
                                    color: '#000',
                                },
                                title: {
                                    display: true,
                                    text: 'Products',
                                    font: {
                                        size: 14,
                                        weight: 'bold',
                                    },
                                    color: '#000',
                                }
                            }
                        },
                        plugins: {
                            title: {
                                display: true,
                                text: 'Top Rated Products by the Customers From ' + lastWeek.toLocaleDateString('en-GB') + ' to ' + today.toLocaleDateString('en-GB'),
                                font: {
                                    size: 16,
                                    weight: 'bold',
                                },
                                color: '#000',
                            }
                        }
                    }
                });
            }
        }
    }
    xhr.send();
}

function chart3() {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/WoodWorks/public/manager/getIncomeLastWeek', true);
    xhr.onload = () => {
        if (xhr.readyState === xhr.DONE) {
            if (xhr.status === 200) {
                let res = JSON.parse(xhr.response);
                let labels = [];
                let values = [];

                res.forEach(element => {
                    labels.push(element.OrderDate);
                    values.push(element.TotalIncome);
                });
                const data = {
                    labels: labels,
                    datasets: [
                        {
                            data: values,
                            borderColor: "#0F3D3E",
                            backgroundColor: "transparent",
                            borderWidth: 2
                        }
                    ]
                };


                const options = {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            ticks: {
                                color: '#000',
                            },
                            title: {
                                display: true,
                                text: 'Total Income (Rs.)',
                                font: {
                                    size: 14,
                                    weight: 'bold',
                                },
                                color: '#000',
                            }
                        },
                        x: {
                            ticks: {
                                color: '#000',
                            },
                            title: {
                                display: true,
                                text: 'Days',
                                font: {
                                    size: 14,
                                    weight: 'bold',
                                },
                                color: '#000',
                            }
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Total Income of the Company From ' + lastWeek.toLocaleDateString('en-GB') + ' to ' + today.toLocaleDateString('en-GB'),
                            font: {
                                size: 16,
                                weight: 'bold',
                            },
                            color: '#000',
                        },
                        legend: {
                            display: false,
                        }
                    },

                };


                new Chart(ctx3, {
                    type: "line",
                    data: data,
                    options: options
                });
            }
        }
    }
    xhr.send();
}

function chart6() {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/WoodWorks/public/manager/getProductsReachedReorderLevel', true);
    xhr.onload = () => {
        if (xhr.readyState === xhr.DONE) {
            if (xhr.status === 200) {
                let res = JSON.parse(xhr.response);
                let labels = [];
                let values1 = [];
                let values2 = [];

                res.forEach(element => {
                    labels.push(element.ProductID);
                    values1.push(element.Quantity);
                    values2.push(element.Reorder_point);
                })
                let data = {
                    labels: labels,
                    datasets: [{
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
                };

                let options = {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            ticks: {
                                color: '#000',
                            },
                            title: {
                                display: true,
                                text: 'Inventory Level (Units)',
                                font: {
                                    size: 14,
                                    weight: 'bold',
                                },
                                color: '#000',
                            }
                        },
                        x: {
                            ticks: {
                                color: '#000',
                            },
                            title: {
                                display: true,
                                text: 'Products',
                                font: {
                                    size: 14,
                                    weight: 'bold',
                                },
                                color: '#000',
                            }
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Products Reached Reorder Level (Inventory Levels vs. Reorder Points)',
                            font: {
                                size: 16,
                                weight: 'bold',
                            },
                            color: '#000',
                        }
                    }
                };


                new Chart(ctx6, {
                    type: 'bar',
                    data: data,
                    options: options
                });
            }
        }
    }
    xhr.send();
}

function getPendingIssues() {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/WoodWorks/public/manager/getPendingIssues', true);
    xhr.onload = () => {
        if (xhr.readyState === xhr.DONE) {
            if (xhr.status === 200) {
                let res = JSON.parse(xhr.response);
                document.getElementById('issues').innerHTML = res.Count;
            }
        }
    }
    xhr.send();
}

function getPendingDesigns() {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/WoodWorks/public/manager/getPendingDesigns', true);
    xhr.onload = () => {
        if (xhr.readyState === xhr.DONE) {
            if (xhr.status === 200) {
                let res = JSON.parse(xhr.response);
                document.getElementById('designs').innerHTML = res.Count;
            }
        }
    }
    xhr.send();
}

function getActiveDiscounts() {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/WoodWorks/public/manager/getActiveDiscounts', true);
    xhr.onload = () => {
        if (xhr.readyState === xhr.DONE) {
            if (xhr.status === 200) {
                document.getElementById('active-discounts').innerHTML = xhr.response;
            }
        }
    }
    xhr.send();
}

function getSoldOutRefurnishedProducts() {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/WoodWorks/public/manager/getSoldOutRefurnishedProducts', true);
    xhr.onload = () => {
        if (xhr.readyState === xhr.DONE) {
            if (xhr.status === 200) {
                document.getElementById('sold-out').innerHTML = xhr.response;
            }
        }
    }
    xhr.send();
}

function loadDesignsPage() {
    window.location.href = "http://localhost/WoodWorks/public/manager/designs";
}

function loadIssuesPage() {
    window.location.href = "http://localhost/WoodWorks/public/manager/issues";
}

