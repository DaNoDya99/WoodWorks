let category_form = document.getElementById('category-form');
let sub_category_form = document.getElementById('sub-category-form');
let cat_btn = document.getElementById('category-btn');
let sub_cat_btn = document.getElementById('sub-category-btn');
let response = document.getElementById('response');
let edit_cat_btn = document.getElementById('edit-cat-btn');
let edit_cat_form = document.getElementById('edit-cat-form');
let edit_sub_cat_btn = document.getElementById('edit-sub-cat-btn');
let edit_sub_cat_form = document.getElementById('edit-sub-cat-form');
let cat_id = '';
let sub_cat_id = '';
let sub_cat_name = '';

sub_category_form.onsubmit = (e) => {
    e.preventDefault();
}

category_form.onsubmit = (e) => {
    e.preventDefault();
}

edit_cat_form.onsubmit = (e) => {
    e.preventDefault();
}

edit_sub_cat_form.onsubmit = (e) => {
    e.preventDefault();
}

cat_btn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'http://localhost/WoodWorks/public/category/addcategory', true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                response.innerHTML = xhr.response;
                setTimeout(() => {
                    response.innerHTML = "";
                    location.reload();
                }, 3000);

            }
        }
    }
    let formData = new FormData(category_form);
    xhr.send(formData);
}

sub_cat_btn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'http://localhost/WoodWorks/public/category/addSubcategory', true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                response.innerHTML = xhr.response;
                setTimeout(() => {
                    response.innerHTML = "";
                    location.reload();
                }, 3000);
            }
        }
    }
    let formData = new FormData(sub_category_form);
    xhr.send(formData);
}

function load_cat_image(file){
    let mylink;
    mylink = window.URL.createObjectURL(file);
    document.querySelector("#cat-img").src = mylink;
}

function load_edit_cat_image(file){
    let mylink;
    mylink = window.URL.createObjectURL(file);
    document.querySelector("#edit-cat-img").src = mylink;
}

function load_edit_sub_cat_image(file){
    let mylink;
    mylink = window.URL.createObjectURL(file);
    document.querySelector("#edit-sub-cat-img").src = mylink;
}

function load_subcat_image(file){
    let mylink;
    mylink = window.URL.createObjectURL(file);
    document.querySelector("#subcat-img").src = mylink;
}

function deleteCategory(id){
    cat_id = id;

    response.innerHTML = "<div class='cat-success cat-deletion'>\n" +
        "        <h2>Do you really want to delete this?</h2>\n" +
        "        <div class=\"cat-deletion-btns\">\n" +
        "            <button onclick=\"confirmDeleteCategory()\">Yes</button>\n" +
        "            <button onclick=\"closeDeleteCatPopup()\">No</button>\n" +
        "        </div>\n" +
        "    </div>"

}

function confirmDeleteCategory(){
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/WoodWorks/public/category/deleteCategory/'+cat_id, true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                response.innerHTML = xhr.response;
                cat_id = '';
                setTimeout(() => {
                    response.innerHTML = "";
                    location.reload();
                }, 1500);
            }
        }
    }
    xhr.send();
}

function openEditCatPopup(id,name,image)
{
    let popup = document.getElementById('edit-cat');
    let field = document.getElementById('cat-field');
    let header = document.getElementById('edit-cat-header');
    let img = document.getElementById('edit-cat-img');

    popup.style.visibility = "visible";
    cat_id = id;
    field.setAttribute('value', name);
    header.innerHTML = id + " - " + name;
    if(image != null) {
        img.setAttribute('src', 'http://localhost/WoodWorks/public/' + image);
    }
}

function closeEditCatPopup()
{
    let popup = document.getElementById('edit-cat');
    popup.style.visibility = "hidden";
}

edit_cat_btn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'http://localhost/WoodWorks/public/category/editCategory/'+cat_id, true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                response.innerHTML = xhr.response;
                setTimeout(() => {
                    response.innerHTML = "";
                    location.reload();
                }, 1500);
            }
        }
    }
    let formData = new FormData(edit_cat_form);
    xhr.send(formData);
}

function openEditSubCatPopup(id,name,image)
{
    let popup = document.getElementById("edit-sub-cat");
    let img = document.getElementById("edit-sub-cat-img");
    let field = document.getElementById("sub-cat-field");
    let header = document.getElementById("edit-sub-cat-header");

    sub_cat_id = id;
    sub_cat_name = name;
    img.setAttribute('src', 'http://localhost/WoodWorks/public/' + image);
    field.setAttribute('value', name);
    header.innerHTML = name;
    popup.style.visibility = "visible";
}

function closeEditSubCatPopup()
{
    let popup = document.getElementById("edit-sub-cat");

    popup.style.visibility = "hidden";
}

edit_sub_cat_btn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'http://localhost/WoodWorks/public/category/editSubCategory/'+sub_cat_id+'/'+sub_cat_name, true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                response.innerHTML = xhr.response;
                setTimeout(() => {
                    response.innerHTML = "";
                    location.reload();
                }, 1500);
            }
        }
    }
    let formData = new FormData(edit_sub_cat_form);
    xhr.send(formData);
}

function deleteSubCategory(){
    response.innerHTML = "<div class='cat-success cat-deletion'>\n" +
        "        <h2>Do you really want to delete this?</h2>\n" +
        "        <div class=\"cat-deletion-btns\">\n" +
        "            <button onclick=\"confirmDeleteSubCategory()\">Yes</button>\n" +
        "            <button onclick=\"closeDeleteCatPopup()\">No</button>\n" +
        "        </div>\n" +
        "    </div>"


}

function confirmDeleteSubCategory(){
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/WoodWorks/public/category/deleteSubCategory/'+sub_cat_id+'/'+sub_cat_name, true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                response.innerHTML = xhr.response;
                setTimeout(() => {
                    response.innerHTML = "";
                    location.reload();
                }, 1500);
            }
        }
    }
    xhr.send();
}

function closeDeleteCatPopup()
{
    response.innerHTML = "";
}