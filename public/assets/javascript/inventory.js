let popup = document.getElementById('popup');
let edit_popup = document.getElementById('edit-popup');
let closeBtn = document.querySelector('.popup-heading img');
let add_fur_form = document.getElementById('add-fur-form');
let search_form = document.getElementById('search-form');
let response = document.getElementById('response');
let product_id = '';

add_fur_form.onsubmit = function(e){
    e.preventDefault();
}

search_form.onsubmit = (e) => {
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
                   response.innerHTML = res;
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

function searchProducts()
{
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'http://localhost/WoodWorks/public/inventory/search', true);
    xhr.onload = () => {
       if(xhr.readyState === XMLHttpRequest.DONE){
           if(xhr.status === 200){
               document.getElementById("inv-table").innerHTML = xhr.response;
               // console.log(xhr.response);
           }
       }
    }
    let form_data = new FormData(search_form);
    xhr.send(form_data);
}

function deleteProduct(id){
    product_id = id;

    response.innerHTML = "<div class='cat-success cat-deletion'>\n" +
        "        <h2>Do you want to delete this?</h2>\n" +
        "        <div class=\"cat-deletion-btns\">\n" +
        "            <button onclick=\"confirmDeleteProduct()\">Yes</button>\n" +
        "            <button onclick=\"closeDeleteProductPopup()\">No</button>\n" +
        "        </div>\n" +
        "    </div>"

}

function confirmDeleteProduct(){
    let xhr = new XMLHttpRequest();
    xhr.open('POST','http://localhost/WoodWorks/public/inventory/delete/'+product_id,true);
    xhr.onload = () => {
        if(xhr.readyState === xhr.DONE){
            if(xhr.status === 200){
                response.innerHTML = xhr.response;
                product_id = '';
                setTimeout(() => {
                    location.reload();
                },3000);
            }
        }
    }
    xhr.send();
}

function closeDeleteProductPopup(){
    response.innerHTML = "";
}

function openEditInvPopup(id){
    product_id = id;

    edit_popup.classList.add("open-popup");
    let xhr = new XMLHttpRequest();
    xhr.open('GET','http://localhost/WoodWorks/public/inventory/edit/'+product_id,true);
    xhr.onload = () => {
        if(xhr.readyState === xhr.DONE){
            if(xhr.status === 200){
                let res = xhr.response;
                let data = JSON.parse(res);
                document.getElementById("quantity").value = data.Quantity;
                document.getElementById("cost").value = data.Cost;
                document.getElementById("last-received").value = data.Last_received;
                document.getElementById("retail-price").value = data.Retail_price;
                document.getElementById("reorder-point").value = data.Reorder_point;
            }
        }
    }
    xhr.send();
}

function closeEditPopup(){
    edit_popup.classList.remove("open-popup");
}