$(document).ready(function () {
    $.ajax({
        url: "http://localhost/woodworks/public/designer/barData",
        method: "GET",
        success: function (data) {
            // console.log(data);
            var Count = [];
            var date = [];
            var colors = [];

            for (var i in data) {
                Count.push(data[i].numDesigns);
                date.push(data[i].category);
                colors.push(color());
            }

            var chartdata = {
                labels: date,
                datasets: [{
                    label: "Number of Designs",
                    backgroundColor: colors,
                    data:Count,

                }]
            };

            var ctx = $("#designerBar");

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
                            text: 'Number of designs per category',
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
                            grid: {
                                borderColor: 'black'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Category Names',
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

    function color() {
        var r = Math.floor(Math.random() * 106) + 150;
        var g = Math.floor(Math.random() * 106) + 150;
        var b = Math.floor(Math.random() * 106) + 150;

        var rgba = 'rgba(' + r + ',' + g + ',' + b + ',1.0)';
        return rgba;

    }
});
