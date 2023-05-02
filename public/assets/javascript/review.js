// let rate = 4.5;
let cusRate = '';

// const starsTotal = 5;
//
// const starPercentage = (rate / starsTotal) * 100;
//
// const starPercentageRounded = `${Math.round(starPercentage / 10) * 10}%`;
//
// document.querySelector(".stars-inner").style.width = starPercentageRounded;


function setRate(e) {
  cusRate = e;
}

function saveReview(productId){
    let review = document.getElementById("review").value;
    if(cusRate === '' ){
        document.getElementById("error-rate").innerHTML = "Please select a rating";
    }
    if(review === ''){
        document.getElementById("error-review").innerHTML = "&nbsp * Please write a review.";
    }

    if(cusRate !== '' && review !== ''){
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "http://localhost/WoodWorks/public/review/save/"+productId, true);
        xhr.onload = () => {
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    document.getElementById("response").innerHTML = "<div class='cat-success'>\n" +
                        "                    <h2>Review saved successfully</h2>\n" +
                        "                </div>";
                    setTimeout(() => {
                        window.location.reload();
                    },2000);
                }
            }
        }
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("Rating=" + cusRate + "&Reviews=" + review);
    }
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