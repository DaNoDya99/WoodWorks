let doc_form = document.getElementById('edit-doc-form');
let doc_btn = document.getElementById('doc-btn');
let response = document.getElementById('response');
let doc_id = '';

doc_form.onsubmit = (e) => {
    e.preventDefault();
}

doc_btn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'http://localhost/WoodWorks/public/designer/update_design/'+doc_id, true);
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
    let formData = new FormData(doc_form);
    xhr.send(formData);
}

function openDocumentPopup(DesignID,Name,DesignerID,Description,event)
{
    event.preventDefault();
    let popup = document.getElementById("upl-docs");
    let field1 = document.getElementById('doc-field1');
    let field2 = document.getElementById('doc-field2');
    let img = document.getElementById('edit-doc-img');

    popup.style.visibility = "visible";
    doc_id = DesignID;
    if(Name != null) {
        field1.setAttribute('value', Name);
    }
    if(Description != null) {
        field2.setAttribute('value', Description);
    }

    // if(image != null) {
    //     img.setAttribute('src', 'http://localhost/WoodWorks/public/' + image);
    // }
    // if(image == ''){
    //     img.setAttribute('src', 'http://localhost/WoodWorks/public/assets/images/driver/No_image.jpg');
    // }

}

function closeDocumentPopup()
{
    let popup = document.getElementById("upl-docs");
    popup.style.visibility = "hidden";
}

function load_doc_image(file){
    let mylink;
    mylink = window.URL.createObjectURL(file);
    document.querySelector("#edit-doc-img1").src = mylink;
}



