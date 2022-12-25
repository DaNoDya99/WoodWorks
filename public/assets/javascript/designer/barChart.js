const ctx = document.getElementById("designerBar");

let barChart = new Chart(ctx,{
    type:'bar',
    data:{
        labels:["Rocking Chair","Bed","Sofa","Dining Tables","Book Shelf"],
        datasets:[{
            label:"Designs And Ratings",
            fontsize:25,
            backgroundColor:color(),
            data:[2,4,5,1,3.5]
        }]
    },
    options:{
        plugins:{
            legend:{
                labels: {
                    font: {
                        size: 14,
                        weight: 600,
                    },
                    color: 'black',
                }
            }
        }
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