let popup = document.getElementById('popup');
let profile_card = document.querySelector('.admin-profile-card');
let closeBtn = document.querySelector('.popup-heading img');

function openPopup(){
    popup.classList.add("open-popup");
    profile_card.style.visibility = 'hidden';
}

function closePopup(){
    popup.classList.remove("open-popup");
    profile_card.style.visibility = 'visible';
}

function load_image(file){
    let mylink;
    mylink = window.URL.createObjectURL(file);
    document.querySelector(".image-field img").src = mylink;
}