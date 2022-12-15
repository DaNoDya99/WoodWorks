let popup = document.getElementById('popup');
let sup_table = document.querySelector('.sup-container');

function openPopup(){
    popup.classList.add("open-popup");
    sup_table.style.visibility = 'hidden';
}

function closePopup(){
    popup.classList.remove("open-popup");
    sup_table.style.visibility = 'visible';
}

function load_image(file){
    let mylink;
    mylink = window.URL.createObjectURL(file);
    document.querySelector(".image-field img").src = mylink;
}
