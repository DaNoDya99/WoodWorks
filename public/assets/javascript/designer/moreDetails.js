let doc_form = document.getElementById('edit-doc-form');
let response = document.getElementById('response');


doc_form.onsubmit = (e) => {
    e.preventDefault();
}

function openDocumentPopup(id,event)
{
    event.preventDefault();
    let popup = document.getElementById("popups");
    // let field = document.getElementById('doc-field');
    // let header1 = document.getElementById('header1');
    // let header2 = document.getElementById('header2');
    // let header3 = document.getElementById('header3');
    // let header4 = document.getElementById('header4');
    // let img = document.getElementById('edit-doc-img');

    popup.style.visibility = "visible";


    // if(reason != null) {
    //     field.value= reason;
    // }
    // if(reason == null) {
    //     field.setAttribute('value', 'No reason provided');
    // }
    //
    // if(image != null) {
    //     img.setAttribute('src', 'http://localhost/WoodWorks/public/' + image);
    // }
    // if(image == ''){
    //     img.setAttribute('src', 'http://localhost/WoodWorks/public/assets/images/driver/No_image.jpg');
    // }

}

function closeDocumentPopup()
{
    let popup = document.getElementById("popups");
    popup.style.visibility = "hidden";
}




