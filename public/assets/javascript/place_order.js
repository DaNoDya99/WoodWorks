let popup = document.getElementById('popup');
let promo = document.querySelector('.promo-field');
let paymentItems = document.querySelector('.payment-items');
let paymentDet = document.querySelector('.payment-details');

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
