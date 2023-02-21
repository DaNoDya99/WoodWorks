let category_form = document.getElementById('category-form');
let sub_category_form = document.getElementById('sub-category-form');
let cat_btn = document.getElementById('category-btn');
let sub_cat_btn = document.getElementById('sub-category-btn');
let response = document.getElementById('response');

sub_category_form.onsubmit = (e) => {
    e.preventDefault();
}

category_form.onsubmit = (e) => {
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

function load_subcat_image(file){
    let mylink;
    mylink = window.URL.createObjectURL(file);
    document.querySelector("#subcat-img").src = mylink;
}
