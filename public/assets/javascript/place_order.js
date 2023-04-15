let popup = document.getElementById('popup');
let promo = document.querySelector('.promo-field');
let paymentItems = document.querySelector('.payment-items');
let paymentDet = document.querySelector('.payment-details');
let form = document.getElementById('shipping-details');
let response = document.getElementById('response');

form.onsubmit = (e) => {
    e.preventDefault();
}

function openPopup(){
    popup.classList.add("open-popup");
    paymentItems.style.visibility = "hidden";
    paymentDet.style.visibility = "hidden";
}

function closePopup(){
    promo.classList.remove("open-promo-field");
    popup.classList.remove("open-popup");
    paymentItems.style.visibility = "visible";
    paymentDet.style.visibility = "visible";
}

function openPromoField()
{
    // promo.classList.remove('promo-field');
    promo.classList.add("open-promo-field");
}

function checkout(orderID){
    let xhr = new XMLHttpRequest();
    xhr.open('POST',"http://localhost/WoodWorks/public/customer_home/checkout/"+orderID,true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                // console.log(xhr.response);
                window.location.href = JSON.parse(xhr.response);
            }

        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}