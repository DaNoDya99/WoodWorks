let popup = document.getElementById('popup');
let closeBtn = document.querySelector('.popup-heading img');
let order_items = document.getElementById("order-items");
let select_driver = document.getElementById('driver');
let reponse = document.getElementById('response');
let orderId = '';

let xhr = new XMLHttpRequest();
xhr.open('GET',"http://localhost/WoodWorks/public/driver_home/available_drivers", true);
xhr.onload = () => {
    if(xhr.readyState === xhr.DONE){
        if(xhr.status === 200){
            select_driver.innerHTML = xhr.response;
        }
    }
}
xhr.send();

function openPopupDelivery(id){
    popup.classList.add("open-popup");
    orderId = id;
    let xhr = new XMLHttpRequest();
    xhr.open('GET','http://localhost/WoodWorks/public/order/orderDetails/'+id,true);
    xhr.onload = () => {
        if(xhr.readyState === xhr.DONE){
            if(xhr.status === 200){
                order_items.innerHTML = xhr.response;
            }
        }
    }
    xhr.send();
}

function getOrderDetails(id){
    document.getElementById("order-details-popup").classList.add("open-popup");
    document.getElementById("order-id").innerHTML = id;

    let xhr = new XMLHttpRequest();
    xhr.open('GET','http://localhost/WoodWorks/public/order/orderDetails/'+id,true);
    xhr.onload = () => {
        if(xhr.readyState === xhr.DONE){
            if(xhr.status === 200){
                document.getElementById("order-items-details").innerHTML = xhr.response;
            }
        }
    }
    xhr.send();
}

function closeOrderDetailsPopup(){
    document.getElementById("order-details-popup").classList.remove("open-popup");
}

function closePopup(){
    popup.classList.remove("open-popup");
}

select_driver.onchange = () => {

    let driver = select_driver.value;
    if(driver !== "-- Assign Driver --"){
        let xhr = new XMLHttpRequest();
        xhr.open('POST','http://localhost/WoodWorks/public/driver_home/assign_driver/'+orderId+'/'+driver,true);
        xhr.onload = () => {
            if(xhr.readyState === xhr.DONE){
                if(xhr.status === 200){
                    if(xhr.response === "success"){
                        reponse.innerHTML = "<div class='cat-success'>\n" +
                            "        <h2>Driver Assigned Successfully.</h2>\n" +
                            "    </div>";

                        setTimeout(() => {
                            location.reload();
                        },2000)
                    }

                }
            }
        }
        xhr.send();
    }
}

function openDeliveryHistoryPopup()
{
    document.getElementById("delivery-history-popup").classList.add("open-popup");
    document.getElementById("processing").click();
}

function closeDeliveryHistoryPopup()
{
    document.getElementById("delivery-history-popup").classList.remove("open-popup");
}


function getOrders(status)
{
    document.querySelectorAll("div[status='status']").forEach(element => {
        element.classList.remove("selected");
    })

    document.getElementById(status.toLowerCase()).classList.add("selected");

    let xhr = new XMLHttpRequest();
    xhr.open('GET','http://localhost/WoodWorks/public/order/getOrdersByStatus/'+status,true);
    xhr.onload = () => {
        if(xhr.readyState === xhr.DONE){
            if(xhr.status === 200){
                document.getElementById("delivery-orders-table").innerHTML = xhr.response;
                // console.log(xhr.response)
            }
        }
    }
    xhr.send();
}

function getDeliveredOrders(status)
{
    document.querySelectorAll("div[status='status']").forEach(element => {
        element.classList.remove("selected");
    })

    document.getElementById(status.toLowerCase()).classList.add("selected");

    let xhr = new XMLHttpRequest();
    xhr.open('GET','http://localhost/WoodWorks/public/order/getDeliveredOrders/'+status,true);
    xhr.onload = () => {
        if(xhr.readyState === xhr.DONE){
            if(xhr.status === 200){
                document.getElementById("delivery-orders-table").innerHTML = xhr.response;
                // console.log(xhr.response)
            }
        }
    }
    xhr.send();
}