let popup = document.getElementById('popup');
let sup_table = document.querySelector('.sup-container');
let add_sup = document.getElementById('add-sup-form');
let edit_popup = document.getElementById('edit-popup');
let response = document.getElementById('response');
let edit_sup_form = document.getElementById('edit-sup-form');
let supplier_id = '';

add_sup.onsubmit = (e) => {
    e.preventDefault();
}

edit_sup_form.onsubmit = (e) => {
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

function openEditSupplierPopup(id){
    edit_popup.classList.add("open-popup");
    sup_table.style.visibility = 'hidden';

    supplier_id = id;

    xhr = new XMLHttpRequest();
    xhr.open("GET", "http://localhost/WoodWorks/public/supplier/getSupplier/"+id, true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data !== 'Supplier Not Found'){
                    data = JSON.parse(data);
                    document.getElementById('supplier_id').innerHTML = data.SupplierID;
                    document.getElementById('emp_id').value = data.SupplierID;
                    document.getElementById('firstname').value = data.Firstname;
                    document.getElementById('lastname').value = data.Lastname;
                    document.getElementById('email').value = data.Email;
                    document.getElementById('contactno').value = data.Contactno;
                    document.getElementById('company_name').value = data.Company_name;
                }
            }
        }
    }

    xhr.send();
}

function closeEditSupplierPopup(){
    edit_popup.classList.remove("open-popup");
    sup_table.style.visibility = 'visible';
    supplier_id = '';
}

function load_image(file){
    let mylink;
    mylink = window.URL.createObjectURL(file);
    document.querySelector(".image-field img").src = mylink;
}

function addSupplier(){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "http://localhost/WoodWorks/public/supplier/add", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data === "Supplier Added Successfully"){
                    response.innerHTML = "<div class='cat-success'>\n" +
                        "        <h2>Supplier Added Successfully</h2>\n" +
                        "    </div>";
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                }else{
                    let errors = JSON.parse(data);
                    document.getElementById('add-supplierid-error').innerHTML = errors.SupplierID;
                    document.getElementById('add-firstname-error').innerHTML = errors.Firstname;
                    document.getElementById('add-lastname-error').innerHTML = errors.Lastname;
                    document.getElementById('add-email-error').innerHTML = errors.Email;
                    document.getElementById('add-contactno-error').innerHTML = errors.Contactno;
                    document.getElementById('add-companyname-error').innerHTML = errors.Company_name;
                    document.getElementById('add-password-error').innerHTML = errors.Password;
                }
            }
        }
    }
    let formData = new FormData(add_sup);
    xhr.send(formData);
}

function deleteSupplier(id){
    supplier_id = id;

    response.innerHTML = "<div class='cat-success cat-deletion'>\n" +
        "        <h2>Do you want to delete this?</h2>\n" +
        "        <div class=\"cat-deletion-btns\">\n" +
        "            <button onclick=\"confirmDeleteSupplier()\">Yes</button>\n" +
        "            <button onclick=\"closeDeleteSupplierPopup()\">No</button>\n" +
        "        </div>\n" +
        "    </div>";
}


function closeDeleteSupplierPopup(){
    response.innerHTML = "";
    supplier_id = '';
}

function confirmDeleteSupplier()
{
    let xhr = new XMLHttpRequest();

    xhr.open("GET", "http://localhost/WoodWorks/public/supplier/delete/"+supplier_id, true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                response.innerHTML = xhr.response;
                supplier_id = '';
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            }
        }
    }

    xhr.send();
}

function save()
{
    let formData = new FormData(edit_sup_form);

    if(validate(formData)) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "http://localhost/WoodWorks/public/supplier/save/" + supplier_id, true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    if(data !== "Supplier Not Found") {
                        response.innerHTML = data;
                        setTimeout(() => {
                            window.location.reload();
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
    let firstname = formData.get('Firstname');
    let lastname = formData.get('Lastname');
    let email = formData.get('Email');
    let contactno = formData.get('Contactno');
    let company_name = formData.get('Company_name');

    let regex1 = /^[a-zA-Z]+$/;
    let regex2 = /^[0-9]+$/;
    let regex3 = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    let regex4 = /^[a-zA-Z0-9._-]+( [a-zA-Z0-9._-]+)*$/;

    if(firstname.length === 0) {
        document.getElementById('firstname_error').innerHTML = "&nbsp *First name is required";
        valid = false;
    }else if(!regex1.test(firstname)) {
        document.getElementById('firstname_error').innerHTML = "&nbsp *First name should only contain letters";
        valid = false;
    }else if(firstname.length < 2) {
        document.getElementById('firstname_error').innerHTML = "&nbsp *First name should be atleast 2 characters";
        valid = false;
    }

    if(lastname.length === 0) {
        document.getElementById('lastname_error').innerHTML = "&nbsp *Last name is required";
        valid = false;
    }else if(!regex1.test(lastname)) {
        document.getElementById('lastname_error').innerHTML = "&nbsp *Last name should only contain letters";
        valid = false;
    }else if(lastname.length < 2) {
        document.getElementById('lastname_error').innerHTML = "&nbsp *Last name should be atleast 2 characters";
        valid = false;
    }

    if(email.length === 0) {
        document.getElementById('email_error').innerHTML = "&nbsp *Email is required";
        valid = false;
    }else if(!regex3.test(email)) {
        document.getElementById('email_error').innerHTML = "&nbsp *Invalid email format";
        valid = false;
    }

    if(contactno.length === 0) {
        document.getElementById('contactno_error').innerHTML = "&nbsp *Contact number is required";
        valid = false;
    } else if(!regex2.test(contactno)) {
        document.getElementById('contactno_error').innerHTML = "&nbsp *Contact number should only contain numbers";
        valid = false;
    }

    if(company_name.length === 0) {
        document.getElementById('company_name_error').innerHTML = "&nbsp *Company name is required";
        valid = false;
    } else if(!regex4.test(company_name)) {
        document.getElementById('company_name_error').innerHTML = "&nbsp *Invalid company name format";
        valid = false;
    }

    return valid;
}