let popup = document.getElementById('popup');
let closeBtn = document.querySelector('.popup-heading img');
let search_by_cat_form = document.getElementById('search-by-cat-form');
let table = document.getElementById('table');
let search = document.getElementById('search-form');
let edit_fur_form = document.getElementById('edit-fur-form');

search_by_cat_form.onsubmit = (e) => {
    e.preventDefault();
}

search.onsubmit = (e) => {
    e.preventDefault();
}

edit_fur_form.onsubmit = (e) => {
    e.preventDefault();
}

function openPopup(id,name){
    document.getElementById('product').innerHTML = id+ " - " + name
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

function save(id){
    let formData = new FormData(edit_fur_form);

    console.log(formData);

    if (validate(formData)) {

    }

    let xhr = new XMLHttpRequest();
    xhr.open('POST','http://localhost/WoodWorks/public/furniture/save/'+id,true);
    xhr.onload = () => {
        if(xhr.readyState === xhr.DONE){
            if(xhr.status === 200){
                // table.innerHTML = xhr.response;
                console.log(xhr.response);
            }
        }
    }

    xhr.send(formData);
}

function validate(formData) {
    let valid = true;

    let name = formData.get('Name');
    let categoryId = formData.get('CategoryID');
    let subCategory = formData.get('Sub_category_name');
    let warrenty = formData.get('Warrenty_period');
    let woodType = formData.get('Wood_type');
    let description = formData.get('Description');

    const regex1 = /^[a-zA-Z0-9\s]+$/;
    const regex2 = /^\d+\sYears$/;
    const regex3 = /^[A-Za-z]+$/;


    if (name === "") {
        document.getElementById('name-error').innerHTML = "&nbsp *Name is required";
        valid = false;
    }else if(!regex1.test(name)) {
        document.getElementById('name-error').innerHTML = "&nbsp *Name is invalid";
        valid = false;
    }else{
        document.getElementById('name-error').innerHTML = "";
    }

    if (categoryId === "") {
        document.getElementById('category-error').innerHTML = "&nbsp *Category is required";
        valid = false;
    }else {
        document.getElementById('category-error').innerHTML = "";
    }

    if (subCategory === "") {
        document.getElementById('sub-category-error').innerHTML = "&nbsp *Sub Category is required";
        valid = false;
    }else{
        document.getElementById('sub-category-error').innerHTML = "";
    }

    if (warrenty === "") {
        document.getElementById('warrenty-error').innerHTML = "&nbsp *Warrenty is required";
        valid = false;
    }else if(!regex2.test(warrenty)) {
        document.getElementById('warrenty-error').innerHTML = "&nbsp *Warrenty is invalid";
        valid = false;
    }else {
        document.getElementById('warrenty-error').innerHTML = "";
    }

    if (woodType === "") {
        document.getElementById('wood-type-error').innerHTML = "&nbsp *Wood Type is required";
        valid = false;
    }else if(!regex3.test(woodType)) {
        document.getElementById('wood-type-error').innerHTML = "&nbsp *Wood Type is invalid";
        valid = false;
    }else{
        document.getElementById('wood-type-error').innerHTML = "";
    }

    if (description === "") {
        document.getElementById('description-error').innerHTML = "&nbsp *Description is required";
        valid = false;
    }else {
        document.getElementById('description-error').innerHTML = "";
    }

    return valid;
}

function load_image_primary(file){
    mylink = window.URL.createObjectURL(file[0]);
    document.getElementById('first-img').src = mylink;
}

function load_image_secondary(file){
    mylink1 = window.URL.createObjectURL(file[0]);
    mylink2 = window.URL.createObjectURL(file[1]);

    document.getElementById('second-img').src = mylink1;
    document.getElementById('third-img').src = mylink2;
}