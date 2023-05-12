let doc_form = document.getElementById('edit-doc-form');
let doc_btn = document.getElementById('doc-btn');
let response = document.getElementById('response');
let doc_id = '';

// doc_form.onsubmit = (e) => {
//     e.preventDefault();
// }

if (doc_form) {
    doc_form.onsubmit = (e) => {
        e.preventDefault();
    }
} else {
    console.log('Form element not found');
}

if (doc_btn) {
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
                    }, 1000);

                }
            }
        }
        let formData = new FormData(doc_form);
        xhr.send(formData);
    }
} else {
    console.log('Button element not found');
}


function openDocumentPopup(id,name,image,date,estDeliDate,event)
{
    event.preventDefault();
    let popup = document.getElementById("upl-doc");
    let field = document.getElementById('doc-field');
    let header1 = document.getElementById('header1');
    let header2 = document.getElementById('header2');
    let header3 = document.getElementById('header3');
    let header4 = document.getElementById('header4');
    let img = document.getElementById('edit-doc-img');

    popup.style.visibility = "visible";
    header1.innerHTML = id;
    header2.innerHTML = name;
    header3.innerHTML = estDeliDate;
    header4.innerHTML = date;
    doc_id = id;
    // if(reason != null) {
    //     field.value= reason;
    // }
    // if(reason == null) {
    //     field.setAttribute('value', 'No reason provided');
    // }

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



