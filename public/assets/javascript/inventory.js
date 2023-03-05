let popup = document.getElementById('popup');
let closeBtn = document.querySelector('.popup-heading img');
let add_fur_form = document.getElementById('add-fur-form');

add_fur_form.onsubmit = function(e){
    e.preventDefault();
}

function openAddFurPopup(){
    popup.classList.add("open-popup");
}

function closePopup(){
    popup.classList.remove("open-popup");
}

function load_image_primary(file)
{
    let mylink = window.URL.createObjectURL(file[0]);

    document.querySelector('#first-img').src = mylink;
}

function load_image_secondary(file)
{
    let mylink1 = window.URL.createObjectURL(file[0]);
    let mylink2 = window.URL.createObjectURL(file[1]);

    document.querySelector('#second-img').src = mylink1;
    document.querySelector('#third-img').src = mylink2;
}

function addFurniture()
{
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'http://localhost/WoodWorks/public/inventory/add', true);
    xhr.onload = () => {
       if(xhr.readyState === XMLHttpRequest.DONE){
           if(xhr.status === 200){
               let res= xhr.response;
               if(res === "<div class='cat-success'><h3>Successfully Added.</h3>"){
                   document.getElementById("response").innerHTML = res;
                   setTimeout(() => {
                          location.reload();
                   },3000);
               }else{
                   document.getElementById("errors").innerHTML = res;
               }
           }
       }
    }
    let form_data = new FormData(add_fur_form);
    xhr.send(form_data);
}

function close_error(){
    document.getElementById("errors").innerHTML = "";
}