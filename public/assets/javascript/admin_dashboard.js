let today = new Date();
let lastWeek = new Date(today.getTime() - 7 * 24 * 60 * 60 * 1000);
let rateId = '';

const ctx1 = document.getElementById('myChart1').getContext('2d');
const ctx2 = document.getElementById('myChart2').getContext('2d');
const ctx3 = document.getElementById('myChart3').getContext('2d');
const ctx4 = document.getElementById('myChart4').getContext('2d');

let add_popup = document.getElementById('add-popup');
let edit_popup = document.getElementById('edit-popup');
let response = document.getElementById('response');
let add_form = document.getElementById('add-form');
let edit_form = document.getElementById('edit-form');

window.onload = () => {
    chart1();
    chart2();
    chart3();
    deliveryCosts();
    chart4();
}

add_form.onsubmit = (e) => {
    e.preventDefault();
}

edit_form.onsubmit = (e) => {
    e.preventDefault();
}

function addRatesPopup()
{
    add_popup.classList.add('open-popup');
}

function closeAddRatesPopup()
{
    add_popup.classList.remove('open-popup');
}

function editRate(id)
{
    rateId = id;
    edit_popup.classList.add('open-popup');

    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/WoodWorks/public/delivery/getRate/'+id, true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                console.log(xhr.response);
                let data = JSON.parse(xhr.response);
                document.getElementById('distance-from-edit').value = data.Distance_from;
                document.getElementById('distance-to-edit').value = data.Distance_to;
                document.getElementById('cost-per-km-edit').value = data.Cost_per_km;
            }
        }
    }
    xhr.send();
}

function saveDeliveryRate(){
    let form_data = new FormData(edit_form);

    if(validate(form_data)){
        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'http://localhost/WoodWorks/public/delivery/updateRate/'+rateId, true);
        xhr.onload = () => {
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    console.log(xhr.response);
                    if(xhr.response === 'success') {
                        response.innerHTML ="<div class='cat-success'>\n" +
                            "        <h2>Delivery Rate Updated Successfully.</h2>\n" +
                            "    </div>";

                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    }else{
                        response.innerHTML ="<div class='cat-success cat-deletion'>\n" +
                            "        <h2>Delivery Rate Update Failed.</h2>\n" +
                            "    </div>";
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    }
                }
            }
        }
        xhr.send(form_data);
    }
}

function addDeliveryRate(){
    let form_data = new FormData(add_form);

    if(validate(form_data)){
        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'http://localhost/WoodWorks/public/delivery/addRate', true);
        xhr.onload = () => {
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    if(xhr.response === 'success') {
                        response.innerHTML ="<div class='cat-success'>\n" +
                            "        <h2>Delivery Rate Added Successfully.</h2>\n" +
                            "    </div>";

                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    }
                }
            }
        }
        xhr.send(form_data);
    }
}

function deleteRate(id)
{
    rateId = id;

    response.innerHTML = "<div class='cat-success cat-deletion'>\n" +
        "        <h2>Do you want to delete this?</h2>\n" +
        "        <div class=\"cat-deletion-btns\">\n" +
        "            <button onclick=\"confirmDeleteRate()\">Yes</button>\n" +
        "            <button onclick=\"closeDeleteRatePopup()\">No</button>\n" +
        "        </div>\n" +
        "    </div>"
}

function closeDeleteRatePopup()
{
    response.innerHTML = "";
    rateId = '';
}

function confirmDeleteRate()
{
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/WoodWorks/public/delivery/deleteRate/'+rateId, true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                console.log(xhr.response);
                if(xhr.response === 'success') {
                    response.innerHTML ="<div class='cat-success'>\n" +
                        "        <h2>Delivery Rate Deleted Successfully.</h2>\n" +
                        "    </div>";

                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                }else{
                    response.innerHTML ="<div class='cat-success cat-deletion'>\n" +
                        "        <h2>Delivery Rate Deletion Failed.</h2>\n" +
                        "    </div>";
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                }
            }
        }
    }
    xhr.send();
}

function validate(form_data){
    let valid = true;

    let distance_from = form_data.get('Distance_from');
    let distance_to = form_data.get('Distance_to');
    let cost_per_km = form_data.get('Cost_per_km');

    const regex1 = /^\d+(\.\d{1,2})?$/;
    const regex2 = /^(\d{1,3}(\.\d{0,2})?|999(\.99)?)$/;


    if(distance_from === ''){
        valid = false;
        document.getElementById('distance-from-error').innerHTML = '&nbsp *Distance From is required';
    }else if(distance_from < 0){
        valid = false;
        document.getElementById('distance-from-error').innerHTML = '&nbsp *Distance From cannot be negative';
    }else if(distance_from > distance_to){
        valid = false;
        document.getElementById('distance-from-error').innerHTML = '&nbsp *Distance From cannot be greater than Distance To';
    }else if(!regex1.test(distance_from)){
        valid = false;
        document.getElementById('distance-from-error').innerHTML = '&nbsp *Distance From is invalid';
    }

    if(distance_to === ''){
        valid = false;
        document.getElementById('distance-to-error').innerHTML = '&nbsp *Distance To is required';
    }else if(distance_to < 0){
        valid = false;
        document.getElementById('distance-to-error').innerHTML = '&nbsp *Distance To cannot be negative';
    }else if(distance_to < distance_from){
        valid = false;
        document.getElementById('distance-to-error').innerHTML = '&nbsp *Distance To cannot be less than Distance From';
    }else if(!regex1.test(distance_to)){
        valid = false;
        document.getElementById('distance-to-error').innerHTML = '&nbsp *Distance To is invalid';
    }

    if (cost_per_km === '') {
        valid = false;
        document.getElementById('cost-per-km-error').innerHTML = '&nbsp *Cost Per Km is required';
    }else if(cost_per_km < 0){
        valid = false;
        document.getElementById('cost-per-km-error').innerHTML = '&nbsp *Cost Per Km cannot be negative';
    }else if(!regex1.test(cost_per_km) || !regex2.test(cost_per_km)){
        valid = false;
        document.getElementById('cost-per-km-error').innerHTML = '&nbsp *Cost Per Km is invalid';
    }

    return valid;
}

function closeEditRatesPopup()
{
    edit_popup.classList.remove('open-popup');
    rateId = '';
}

function chart1(){
    let xhr1 = new XMLHttpRequest();
    xhr1.open('GET', 'http://localhost/WoodWorks/public/admin/getWeeklySalesOfProducts', true);
    xhr1.onload = () => {
        if (xhr1.readyState === XMLHttpRequest.DONE) {
            if (xhr1.status === 200) {
                let response = JSON.parse(xhr1.response);
                let labels = [];
                let data = [];

                response.forEach((item) => {
                    labels.push(item.ProductID);
                    data.push(item.SoldQuantity);
                });

                let config = {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            borderColor: 'rgb(15, 61, 62)',
                            borderWidth: 2,
                            tension: 0,
                        }]
                    },
                    options: {
                        responsive: true,
                        title: {
                            display: true,
                            text: 'Weekly Sales Of Products From ' + lastWeek.toLocaleDateString('en-US') + ' To ' + today.toLocaleDateString('en-US'),
                            fontSize: 18,
                            fontColor: 'rgb(0,0,0)',// black
                        },
                        legend: {
                            display: false,
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    fontSize: 14, // set font size for y-axis labels
                                    fontColor: 'rgb(0,0,0)',// black
                                    precision: 0,
                                },
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Quantities',
                                    fontSize: 16,
                                    fontColor: 'rgb(0,0,0)',// black
                                }
                            }],
                            xAxes: [{
                                ticks: {
                                    fontSize: 14,// set font size for x-axis labels
                                    fontColor: 'rgb(0,0,0)',// black
                                },
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Product ID',
                                    fontSize: 16,
                                    fontColor: 'rgb(0,0,0)',// black
                                }
                            }]

                        },
                    },
                };
                new Chart(ctx1, config);
            }
        }
    }

    xhr1.send();
}

function chart2(){
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/WoodWorks/public/admin/getProductsReachedReorderLevel', true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let response = JSON.parse(xhr.response);
                let labels = [];
                let data1 = [];
                let data2 = [];

                response.forEach((item) => {
                    labels.push(item.ProductID);
                    data1.push(item.Quantity);
                    data2.push(item.Reorder_point);
                });

                let config = {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Quantity',
                            data: data1,
                            backgroundColor: Array(data1.length).fill('rgb(15, 61, 62)'),
                            borderColor: Array(data1.length).fill('rgb(15, 61, 62)'),
                            borderWidth: 2,
                            fontColor: 'rgb(0,0,0)',// black
                        },
                        {
                            label: 'Reorder Point',
                            data: data2,
                            backgroundColor: Array(data2.length).fill('rgb(1,120,1)'),
                            borderColor: Array(data2.length).fill('rgb(1,120,1)'),
                            borderWidth: 2,
                            fontColor: 'rgb(0,0,0)',// black
                        }]
                    },
                    options: {
                        responsive: true,
                        title: {
                            display: true,
                            text: 'Products Reached Reorder Level (Inventory Levels vs. Reorder Points)',
                            fontSize: 18,
                            fontColor: 'rgb(0,0,0)',// black
                        },
                        scales: {
                            xAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    fontSize: 14, // set font size for x-axis labels
                                    fontColor: 'rgb(0,0,0)',// black
                                },
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Inventory Level',
                                    fontSize: 16,
                                    fontColor: 'rgb(0,0,0)',// black
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                    fontSize: 14, // set font size for y-axis labels
                                    fontColor: 'rgb(0,0,0)',// black
                                },
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Product ID',
                                    fontSize: 16,
                                    fontColor: 'rgb(0,0,0)',// black
                                }
                            }]
                        }
                    }
                }

                new Chart(ctx2, config);
            }
        }
    }
    xhr.send();
}

function chart3()
{
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/WoodWorks/public/admin/getOrderStatus', true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let response = JSON.parse(xhr.response);
                // console.log(response);
                let labels = [];
                let dataset = [];

                response.forEach((item) => {
                    labels.push(item.Order_status);
                    dataset.push(item.numOrders);
                }  );

                let data = {
                    labels: labels,
                    datasets: [{
                        data: dataset,
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#d0e626' ],
                    }]
                };

                // Set the options for the pie chart
                let options = {
                    aspectRatio: 1,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true
                        },
                        title: {
                            display: true,
                            text: 'From ' + lastWeek.toLocaleDateString('en-US') + ' To ' + today.toLocaleDateString('en-US'),
                            color: 'black',// black
                        }
                    }
                };

                // Create the pie chart
                var myPieChart = new Chart(ctx3, {
                    type: 'pie',
                    data: data,
                    options: options
                });
            }
        }
    }
    xhr.send();
}

function deliveryCosts()
{
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/WoodWorks/public/delivery/getDeliveryCost', true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200)
            {
                document.getElementById('delivery-rates').innerHTML = xhr.response;
            }
        }
    }
    xhr.send();
}

function chart4(){
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/WoodWorks/public/admin/getTop5Products', true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log(xhr.response);
                let response = JSON.parse(xhr.response);
                let labels = [];
                let data = [];

                response.forEach((item) => {
                    labels.push(item.ProductID);
                    data.push(item.Average);
                });

                let config = {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            borderColor: 'rgb(15, 61, 62)',
                            borderWidth: 2,
                            tension: 0,
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        responsive: true,
                        title: {
                            display: true,
                            text: 'Top 5 Products (Based on Customer Ratings This Week)',
                            fontSize: 16,
                            fontColor: 'rgb(0,0,0)',// black
                        },
                        legend: {
                            display: false,
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    fontSize: 14, // set font size for y-axis labels
                                    fontColor: 'rgb(0,0,0)',// black
                                    precision: 0,
                                },
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Rating',
                                    fontSize: 14,
                                    fontColor: 'rgb(0,0,0)',// black
                                }
                            }],
                            xAxes: [{
                                ticks: {
                                    fontSize: 14,// set font size for x-axis labels
                                    fontColor: 'rgb(0,0,0)',// black
                                },
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Product ID',
                                    fontSize: 14,
                                    fontColor: 'rgb(0,0,0)',// black
                                }
                            }]

                        },
                    },
                };
                new Chart(ctx4, config);
            }
        }
    }
    xhr.send();
}
