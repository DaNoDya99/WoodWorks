let add_emp_popup = document.getElementById("add-emp-popup");
let edit_emp_popup = document.getElementById("edit-emp-popup");
let add_emp_form = document.getElementById("add-emp-form");
let response = document.getElementById("response");
let edit_emp_form = document.getElementById("edit-emp-form");
let emp_id = '';

add_emp_form.onsubmit = (e) => {
    e.preventDefault();
}

edit_emp_form.onsubmit = (e) => {
    e.preventDefault();
}

function openAddEmpPopup() {
    add_emp_popup.classList.add("open-popup");
}

function closeAddEmpPopup() {
    add_emp_popup.classList.remove("open-popup");
}

function openEditEmpPopup(id) {
    emp_id = id;
    edit_emp_popup.classList.add("open-popup");

    xhr = new XMLHttpRequest();
    xhr.open("GET", "http://localhost/WoodWorks/public/employee/getEmployee/"+id, true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                console.log(data);
                if(data !== 'Employee Not Found'){
                    data = JSON.parse(data);
                    document.getElementById('emp_id').innerHTML = data.EmployeeID;
                    document.getElementById('employee_id').value = data.EmployeeID;
                    document.getElementById('firstname').value = data.Firstname;
                    document.getElementById('lastname').value = data.Lastname;
                    document.getElementById('email').value = data.Email;
                    document.getElementById('contactno').value = data.Contactno;
                }
            }
        }
    }
    xhr.send();
}

function closeEditEmpPopup() {
    edit_emp_popup.classList.remove("open-popup");
    emp_id = '';
}

function addEmployee()
{
    let form_data = new FormData(add_emp_form);

    console.log(form_data);

    let xhr = new XMLHttpRequest();
    xhr.open('POST','http://localhost/WoodWorks/public/admin/add_employee',true);
    xhr.onload = () => {
        if(xhr.readyState === xhr.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data === "success") {
                    response.innerHTML = "<div class='cat-success'>\n" +
                        "        <h2>Employee Added Successfully.</h2>\n" +
                        "    </div>";
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                }else{
                    data = JSON.parse(data);
                    document.getElementById("emp-id-error").innerHTML = data.EmployeeID;
                    document.getElementById("firstname-error").innerHTML = data.Firstname;
                    document.getElementById("lastname-error").innerHTML = data.Lastname;
                    document.getElementById("email-error").innerHTML = data.Email;
                    document.getElementById("contact-error").innerHTML = data.Contactno;
                    document.getElementById("password-error").innerHTML = data.Password;
                    document.getElementById("role-error").innerHTML = data.Role;
                }
            }
        }
    }
    xhr.send(form_data);

}

function save()
{
    let form_data = new FormData(edit_emp_form);

    let xhr = new XMLHttpRequest();
    xhr.open('POST','http://localhost/WoodWorks/public/employee/editEmployee/'+emp_id,true);
    xhr.onload = () => {
        if(xhr.readyState === xhr.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data === "success") {
                    response.innerHTML = "<div class='cat-success'>\n" +
                        "        <h2>Employee Updated Successfully.</h2>\n" +
                        "    </div>";
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                }else{
                    data = JSON.parse(data);
                    document.getElementById("firstname-error").innerHTML = data.Firstname;
                    document.getElementById("lastname-error").innerHTML = data.Lastname;
                    document.getElementById("email-error").innerHTML = data.Email;
                    document.getElementById("contact-error").innerHTML = data.Contactno;
                }
            }
        }
    }
    xhr.send(form_data);
}

function deleteEmployee(id){
    emp_id = id;

    response.innerHTML = "<div class='cat-success cat-deletion'>\n" +
        "        <h2>Do you want to delete this?</h2>\n" +
        "        <div class=\"cat-deletion-btns\">\n" +
        "            <button onclick=\"confirmDeleteEmployee()\">Yes</button>\n" +
        "            <button onclick=\"closeDeleteProductPopup()\">No</button>\n" +
        "        </div>\n" +
        "    </div>"

}

function confirmDeleteEmployee()
{
    let xhr = new XMLHttpRequest();
    xhr.open('GET','http://localhost/WoodWorks/public/employee/delete/'+emp_id,true);
    xhr.onload = () => {
        if(xhr.readyState === xhr.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data === "success") {
                    response.innerHTML = "<div class='cat-success'>\n" +
                        "        <h2>Employee Deleted Successfully.</h2>\n" +
                        "    </div>";
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                }else if(data === "error"){
                    response.innerHTML = "<div class='cat-error'>\n" +
                        "        <h2>Employee Not Found.</h2>\n" +
                        "    </div>";
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                }
            }
        }
    }
    xhr.send();
}

function closeDeleteProductPopup(){
    response.innerHTML = "";
    emp_id = '';
}

