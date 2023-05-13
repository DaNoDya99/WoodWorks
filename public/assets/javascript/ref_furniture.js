let edit_ad_form = document.getElementById('edit-ref-fur');
let form = document.getElementById('ref-fur');
let btn = document.getElementById('ref-fur-btn');
let response = document.getElementById('response');

let fur_id = '';

form.onsubmit = (e) => {
    e.preventDefault();
}

edit_ad_form.onsubmit = (e) => {
    e.preventDefault();
}

function load_image_primary(file){
    mylink = window.URL.createObjectURL(file[0]);
    document.getElementById('first-image').src = mylink;
}

function load_image_secondary(file){
    mylink1 = window.URL.createObjectURL(file[0]);
    mylink2 = window.URL.createObjectURL(file[1]);

    document.getElementById('second-image').src = mylink1;
    document.getElementById('third-image').src = mylink2;
}

function load_image_primary2(file){
    mylink = window.URL.createObjectURL(file[0]);
    document.getElementById('first-image-edit').src = mylink;
}

function load_image_secondary2(file){
    mylink1 = window.URL.createObjectURL(file[0]);
    mylink2 = window.URL.createObjectURL(file[1]);

    document.getElementById('second-image-edit').src = mylink1;
    document.getElementById('third-image-edit').src = mylink2;
}


btn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open('POST',"http://localhost/WoodWorks/public/advertisement/insertRefurnishedFurniture",true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                document.getElementById('ad-errors').innerHTML = xhr.response;
                setTimeout(() => {
                    location.reload()
                },1000);
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}

function navigateDetailsPage(id){
    window.location.href = "http://localhost/WoodWorks/public/advertisement/details/"+id;
}

function openEditAdPopup(id)
{
    document.getElementById('edit-ad-popup').classList.add('open-popup');

    fur_id = id;
    let xhr = new XMLHttpRequest();
    xhr.open('GET',"http://localhost/WoodWorks/public/advertisement/getAdDetails/"+id,true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let ad = JSON.parse(xhr.response);
                document.getElementById('first-image-edit').src ="http://localhost/WoodWorks/public/" + ad.primary_image;
                document.getElementById('second-image-edit').src = " http://localhost/WoodWorks/public/"+ad.secondary_image1;
                document.getElementById('third-image-edit').src = "http://localhost/WoodWorks/public/" + ad.secondary_image2;
                document.getElementById('ad-id').value = ad.advertisement_id;
                document.getElementById('ad-quantity').value = ad.quantity;
                document.getElementById('ad-price').value = ad.price;
                document.getElementById('ad-description').innerHTML = ad.description;
                document.getElementById('ad-name').value = ad.name;
            }
        }
    }
    xhr.send();
}

function closeEditAdPopup()
{
    document.getElementById('edit-ad-popup').classList.remove('open-popup');
    fur_id = '';
}

function save()
{
    let formData = new FormData(edit_ad_form);

    if(validate(formData)){
        let xhr = new XMLHttpRequest();
        xhr.open('POST',"http://localhost/WoodWorks/public/advertisement/updateRefurnishedFurniture/"+fur_id,true);
        xhr.onload = () => {
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    console.log(xhr.response);
                    if(xhr.response === "success"){
                        response.innerHTML ="<div class='cat-success'>\n" +
                            "        <h2>Advertisement Updated Successfully.</h2>\n" +
                            "    </div>";

                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    }else {
                        response.innerHTML = "<div class='cat-success cat-deletion'>\n" +
                            "        <h2>Updating Advertisement Failed.</h2>\n" +
                            "    </div>";
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    }
                }
            }
        }
        xhr.send(formData);
    }
}

function validate(formData)
{
    let valid = true;

    let quantity = formData.get('Quantity');
    let price = formData.get('Price');
    let description = formData.get('Description');
    let name = formData.get('Product_name');

    const regex1 = /^[0-9]+$/;
    const regex2 = /^[a-zA-Z ]+$/;
    const regex4 = /^[0-9]+(\.[0-9]{1,2})?$/;

    if(quantity === ""){
        document.getElementById('ad-quantity-error').innerHTML = "&nbsp *Quantity is required";
        valid = false;
    }else if(!regex1.test(quantity)){
        document.getElementById('ad-quantity-error').innerHTML = "&nbsp *Invalid Quantity";
        valid = false;
    }else if(quantity < 1){
        document.getElementById('ad-quantity-error').innerHTML = "&nbsp *Quantity should be greater than 0";
        valid = false;
    }

    if(price === ""){
        document.getElementById('ad-price-error').innerHTML = "&nbsp *Price is required";
        valid = false;
    }else if(!regex4.test(price)){
        document.getElementById('ad-price-error').innerHTML = "&nbsp *Invalid Price";
        valid = false;
    }else if(price < 1){
        document.getElementById('ad-price-error').innerHTML = "&nbsp *Price should be greater than 0";
        valid = false;
    }

    if(description === ""){
        document.getElementById('ad-description-error').innerHTML = "&nbsp *Description is required";
        valid = false;
    }

    if(name === ""){
        document.getElementById('ad-name-error').innerHTML = "&nbsp *Product Name is required";
        valid = false;
    }else if(!regex2.test(name)){
        document.getElementById('ad-name-error').innerHTML = "&nbsp *Invalid Product Name";
        valid = false;
    }

    return valid;
}

function deleteAd(id){
    fur_id = id;

    response.innerHTML = "<div class='cat-success cat-deletion'>\n" +
        "        <h2>Do you want to delete this?</h2>\n" +
        "        <div class=\"cat-deletion-btns\">\n" +
        "            <button onclick=\"confirmDeleteAd()\">Yes</button>\n" +
        "            <button onclick=\"closeDeleteAdPopup()\">No</button>\n" +
        "        </div>\n" +
        "    </div>"
}

function confirmDeleteAd() {
    let xhr = new XMLHttpRequest();
    xhr.open('DELETE',"http://localhost/WoodWorks/public/advertisement/deleteRefurnishedFurniture/"+fur_id,true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                console.log(xhr.response);
                if(xhr.response === 'success') {
                    response.innerHTML ="<div class='cat-success'>\n" +
                        "        <h2>Advertisement Deleted Successfully.</h2>\n" +
                        "    </div>";

                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                }else{
                    response.innerHTML ="<div class='cat-success cat-deletion'>\n" +
                        "        <h2>Advertisement Deletion Failed.</h2>\n" +
                        "    </div>";
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                }
            }
        }
    }
    xhr.send();
}

function closeDeleteAdPopup() {
    response.innerHTML = "";
    fur_id = '';
}