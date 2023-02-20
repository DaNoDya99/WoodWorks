let popup = document.getElementById('popup');
let order_card = document.querySelector('.tbox');
let closeBtn = document.querySelector('.popup-heading img');

function openPopup(event){
    event.preventDefault();
    popup.classList.add("open-popup");
    console.log("Hi");
    order_card.style.visibility = 'hidden';
}

function closePopup(){
    popup.classList.remove("open-popup");
    console.log("Hi");
    order_card.style.visibility = 'visible';
}

function load_image(file){
    let mylink;
    mylink = window.URL.createObjectURL(file);
    document.querySelector(".image-field img").src = mylink;
}