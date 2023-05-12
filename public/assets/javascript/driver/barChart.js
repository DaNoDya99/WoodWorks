$(document).ready(function () {
    $.ajax({
        url: "http://localhost/woodworks/public/driver_home/barData",
        method: "GET",
        success: function (data) {
            console.log(data);
            var Count = [];
            var date = [];
            var colors = [];

            for (var i in data) {
                Count.push(data[i].numOrders);
                date.push(data[i].Date);
                colors.push(color());
            }
            console.log(Count);
            console.log(date);
            var chartdata = {
                labels: date,
                datasets: [{
                    label: "Number of Orders",
                    backgroundColor: colors,
                    data:Count,

                }]
            };

            var ctx = $("#myBar");

            var barGraph = new Chart(ctx, {
                type: 'bar',
                data: chartdata,
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Uncompleted Orders For This Week',
                            color:'black',
                            font: {
                                size: 15,
                            },
                        },

                    },
                    scales: {
                        y: {
                            title: {
                                display: true,
                                text: 'Number of Orders',
                                color:'black',
                                font: {
                                    size: 15,
                                },

                            },
                            ticks: {
                                color:'black',
                                font: {
                                    size: 15,
                                },
                                precision: 0,

                            },
                            grid: {
                                borderColor: 'black'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Delivery Dates',
                                color:'black',
                                font: {
                                    size: 15,
                                },
                            },
                            ticks: {
                                color:'black',
                                font: {
                                    size: 15,
                                },
                            },
                            grid: {
                                display:true,
                                borderColor: 'black'
                            }
                        },
                    },
                }
            });
        },
        error: function (data) {
            console.log(data);
        }
    });

    function color()
    {
        var r = Math.floor(Math.random() * 256);
        var g = Math.floor(Math.random() * 256);
        var b = Math.floor(Math.random() * 256);

        var rgba = 'rgba(' + r + ',' + g + ',' + b + ',1.0)';
        return rgba;

    }
});