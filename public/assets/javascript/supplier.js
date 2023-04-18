let popup = document.getElementById('popup');
let sup_table = document.querySelector('.sup-container');
let add_sup = document.getElementById('add-sup-form');

add_sup.onsubmit = (e) => {
    e.preventDefault();
}
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

function addSupplier(){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "http://localhost/stock/public/supplier/add", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                console.log(data);
            }
        }
    }
    let formData = new FormData(add_sup);
    xhr.send(formData);
}