$(document).ready(function () {
    $.ajax({
        url: "http://localhost/woodworks/public/designer/lineData",
        method: "GET",
        success: function (data) {
            // console.log(data);
            var count = [];
            var date = [];
            var colors = [];

            for (var i in data) {
                count.push(data[i].numDesigns);
                date.push(data[i].Date);
                colors.push(color());
            }
            // console.log(count);
            // console.log(date);
            var chartdata = {
                labels: date,
                datasets: [{
                    label: "Number of New Designs",
                    backgroundColor: colors,
                    fill: false,
                    lineTension: 0.5,
                    borderColor: "rgba(52,152,219,1.0)",
                    borderCapStyle: 'round',
                    borderJoinStyle: 'round',
                    PointBorderColor: "rgba(196, 229, 56, 1.0)",
                    pointBackgroundColor:"rgba(0, 98, 102, 1.0)",
                    pointHoverBorderColor:"rgba(26, 188, 156, 1.0)",
                    pointHoverBackgroundColor: "rgba(211, 84, 0, 1.0)",
                    pointHoverBorderWidth:3,
                    pointRadius:3,
                    data:count
                }]
            };

            var ctx = $("#designerLine");

            var lineGraph = new Chart(ctx, {
                type: 'line',
                data: chartdata,
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Number of New Designs and Dates',
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
                                text: 'Number of Designs',
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
                            // beginAtZero: true,
                            grid: {
                                borderColor: 'black'
                            }

                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Dates',
                                color:'black',
                                font: {
                                    size: 15,
                                },
                            },
                            ticks: {
                                color:'black',
                                font: {
                                    size: 15,
                                }
                            },
                            grid: {
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