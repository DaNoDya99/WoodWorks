let popup = document.getElementById('popup');
let order_card = document.querySelector('.tbox');
let closeBtn = document.querySelector('.popup-heading img');

function openPopup(event){
    event.preventDefault();
    popup.classList.add("open-popup");
    order_card.style.visibility = 'hidden';
     // document.getElementById("popup").style.display = "block";
    document.querySelector("detail-form").submit();
}

function closePopup(){
    popup.classList.remove("open-popup");
    order_card.style.visibility = 'visible';
}

function load_image(file){
    let mylink;
    mylink = window.URL.createObjectURL(file);
    document.querySelector(".image-field img").src = mylink;
}