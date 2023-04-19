let doc_form = document.getElementById('edit-doc-form');
let doc_btn = document.getElementById('doc-btn');
let response = document.getElementById('response');
let doc_id = '';

doc_form.onsubmit = (e) => {
    e.preventDefault();
}

doc_btn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'http://localhost/WoodWorks/public/driver_home/upload_document/'+doc_id, true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                response.innerHTML = xhr.response;
                setTimeout(() => {
                    response.innerHTML = "";
                    location.reload();
                }, 9000);

            }
        }
    }
    let formData = new FormData(doc_form);
    xhr.send(formData);
}

function openDocumentPopup(id,name,image,date,event)
{
    event.preventDefault();
    let popup = document.getElementById("upl-doc");
    let header1 = document.getElementById('header1');
    let header2 = document.getElementById('header2');
    let header3 = document.getElementById('header3');
     let img = document.getElementById('edit-doc-img');

    popup.style.visibility = "visible";
    header1.innerHTML = id;
    header2.innerHTML = name;
    header3.innerHTML = date;
    doc_id = id;

    if(image != null) {
        img.setAttribute('src', 'http://localhost/WoodWorks/public/' + image);
    }
    if(image == ''){
        img.setAttribute('src', 'http://localhost/WoodWorks/public/assets/images/driver/No_image.jpg');
    }

}

function closeDocumentPopup()
{
    let popup = document.getElementById("upl-doc");
    popup.style.visibility = "hidden";
}

function load_doc_image(file){
    let mylink;
    mylink = window.URL.createObjectURL(file);
    document.querySelector("#edit-doc-img").src = mylink;
}



