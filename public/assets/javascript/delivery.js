let popup = document.getElementById('popup');
let closeBtn = document.querySelector('.popup-heading img');
let order_items = document.getElementById("order-items");

function openPopupDelivery(id){
    popup.classList.add("open-popup");

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


