let rate = 4.5;
let cusRate = '';

const starsTotal = 5;

const starPercentage = (rate / starsTotal) * 100;

const starPercentageRounded = `${Math.round(starPercentage / 10) * 10}%`;

document.querySelector(".stars-inner").style.width = starPercentageRounded;

function setRate(e) {
  cusRate = e;
}

function saveReview(){
    let review = document.getElementById("review").value;
}

function getProductDetails(orderId,productId){
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "http://localhost/WoodWorks/public/order/getorderitem/" + orderId + "/" +productId, true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                const item_container = document.getElementById("item-container");
                item_container.innerHTML = xhr.response;
            }
        }
    }
    xhr.send();
}