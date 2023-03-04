let popup = document.getElementById('popup');
let closeBtn = document.querySelector('.popup-heading img');
let order_items = document.getElementById("order-items");
let select_driver = document.getElementById('driver');
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
                    console.log(xhr.response);
                }
            }
        }
        xhr.send();
    }
}


