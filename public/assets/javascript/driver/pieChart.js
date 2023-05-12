$(document).ready(function () {
    $.ajax({
        url: "http://localhost/woodworks/public/driver_home/pieData",
        method: "GET",
        success: function (data) {
              //console.log(data);
                var Count = [];
                var Status = [];
                var colors = [];

            for (var i in data) {
                Count.push(data[i].numOrders);
                Status.push(data[i].Order_status);
                colors.push(color());
            }
            // console.log(Count);
            // console.log(Status);
            var chartdata = {
                labels: Status,
                datasets: [{
                    label: "Number of Orders",
                    backgroundColor: colors,
                    data:Count,
                }]
            };

            var ctx = $("#myPie");

            var pieGraph = new Chart(ctx, {
                type: 'pie',
                data: chartdata,
                options: {
                    plugins:{
                        tooltip: {
                            enabled: false
                        },
                        datalabels: {
                            formatter: (value, context) => {
                                return value
                            },
                            font:{
                                size: 30,
                            }
                        },
                        legend: {
                            display: true,
                            labels: {
                                font:{
                                    size: 15,
                                }
                            },
                        },
                        title: {
                            display: true,
                            text: 'Current Status',
                            color:'black',
                            font: {
                                size: 15,
                            },
                        },

                    },
                },
                plugins:[ChartDataLabels]
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