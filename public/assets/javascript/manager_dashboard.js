let today = new Date();
let lastWeek = new Date(today.getTime() - 7 * 24 * 60 * 60 * 1000);

const ctx1 = document.getElementById("myChart1").getContext("2d");
const ctx2 = document.getElementById("myChart2").getContext("2d");
const ctx3 = document.getElementById("myChart3").getContext("2d");
const ctx4 = document.getElementById("myChart4").getContext("2d");
const ctx5 = document.getElementById("myChart5").getContext("2d");
const ctx6 = document.getElementById("myChart6").getContext("2d");

window.onload = () => {
    chart1();
    chart2();
    chart3();
    chart4();
    chart5();
    chart6();
}

function chart1(){
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/WoodWorks/public/manager/getTopSellingProducts', true);
    xhr.onload = () => {
        if(xhr.readyState === xhr.DONE){
            if(xhr.status === 200){
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

function chart2(){
    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['Product A', 'Product B', 'Product C', 'Product D', 'Product E'],
            datasets: [{
                label: 'Rating',
                data: [4, 11, 7, 5, 2],
                backgroundColor: 'rgba(24,157,92,0.3)',
                borderColor: 'rgb(3,128,69)',
                borderWidth: 2,
                hoverBackgroundColor: 'rgba(2,198,106,0.3)',
                fontColor: '#000',
            }],
            tension:0,

        },
        options: {
            responsive: true,
            aspectRatio:1,
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
                    text: 'Top Rated Products by the Customers From '+lastWeek.toLocaleDateString('en-GB')+' to '+today.toLocaleDateString('en-GB'),
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

function chart3(){
    const data = {
        labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
        datasets: [
            {
                data: [200, 350, 500, 400, 600, 750, 900],
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
                text: 'Total Income of the Company From '+lastWeek.toLocaleDateString('en-GB')+' to '+today.toLocaleDateString('en-GB'),
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

function chart4(){
    const data = {
        labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
        datasets: [
            {
                data: [200, 350, 500, 400, 600, 750, 900],
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
                    text: 'Total Profit (Rs.)',
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
                text: 'Total Profit Gained by the Company From '+lastWeek.toLocaleDateString('en-GB')+' to '+today.toLocaleDateString('en-GB'),
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


    new Chart(ctx4, {
        type: "line",
        data: data,
        options: options
    });
}

function chart5() {

    const labels = ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6', 'Day 7'];
    const data = {
        labels: labels,
        datasets: [{
            label: 'Number of Orders',
            data: [10, 20, 30, 25, 40, 35, 50],
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
        }]
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
                    text: 'Number of Orders',
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
                text: 'Number of Orders Received From '+lastWeek.toLocaleDateString('en-GB')+' to '+today.toLocaleDateString('en-GB'),
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


    new Chart(ctx5, {
        type: "line",
        data: data,
        options: options
    });
}

function chart6() {
    let data = {
        labels: ['Product 1', 'Product 2', 'Product 3', 'Product 4', 'Product 5'],
        datasets: [{
            label: 'Inventory Level',
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1,
            data: [20, 15, 10, 12, 18]
        }, {
            label: 'Reorder Level',
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1,
            data: [30, 25, 20, 22, 28]
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