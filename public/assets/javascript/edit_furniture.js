let popup = document.getElementById('popup');
let closeBtn = document.querySelector('.popup-heading img');
let search_by_cat_form = document.getElementById('search-by-cat-form');
let table = document.getElementById('table');
let search = document.getElementById('search-form');

search_by_cat_form.onsubmit = (e) => {
    e.preventDefault();
}

search.onsubmit = (e) => {
    e.preventDefault();
}

function openPopup(id){
    popup.classList.add("open-popup");
    let xhr = new XMLHttpRequest();
    xhr.open('GET','http://localhost/WoodWorks/public/furniture/details/'+id,true);
    xhr.onload = () => {
        if(xhr.readyState === xhr.DONE){
            if(xhr.status === 200){
                document.getElementById('edit-fur-form').innerHTML = xhr.response;
            }
        }
    }
    xhr.send();
}

function closePopup(){
    popup.classList.remove("open-popup");
}

function filterProducts()
{
    let xhr = new XMLHttpRequest();
    xhr.open('POST','http://localhost/WoodWorks/public/furniture/filter/',true);
    xhr.onload = () => {
        if(xhr.readyState === xhr.DONE){
            if(xhr.status === 200){
                table.innerHTML = xhr.response;
                // console.log(xhr.response);
            }
        }
    }
    let formData = new FormData(search_by_cat_form);
    xhr.send(formData);
}

function searchProducts(){
    let xhr = new XMLHttpRequest();
    xhr.open('POST','http://localhost/WoodWorks/public/furniture/search/',true);
    xhr.onload = () => {
        if(xhr.readyState === xhr.DONE){
            if(xhr.status === 200){
                table.innerHTML = xhr.response;
                // console.log(xhr.response);
            }
        }
    }
    let formData = new FormData(search);
    xhr.send(formData);
}
