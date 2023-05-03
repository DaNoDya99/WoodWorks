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

function openDocumentPopup(DesignID,Name,DesignerID,Description,image1,image2,image3,pdf,event)
{
    event.preventDefault();
    let popup = document.getElementById("upl-docs");
    let field1 = document.getElementById('doc-field1');
    let field2 = document.getElementById('doc-field2');
    let firstImg = document.getElementById("first-img");
    let secondImg = document.getElementById("second-img");
    let thirdImg = document.getElementById("third-img");
    const pdfPreview = document.getElementById('pdf-preview');

    popup.style.visibility = "visible";
    doc_id = DesignID;
    if(Name != null) {
        field1.setAttribute('value', Name);
    }
    if(Description != null) {
        field2.value= Description;
    }

    if (image1 != null && image2 != null && image3 != null) {
        firstImg.setAttribute("src", "http://localhost/WoodWorks/public/"+image1);
        secondImg.setAttribute("src", "http://localhost/WoodWorks/public/"+image2);
        thirdImg.setAttribute("src", "http://localhost/WoodWorks/public/"+image3);
    } else {
        firstImg.setAttribute("src", "http://localhost/WoodWorks/public/assets/images/designer/No_image.jpg");
        secondImg.setAttribute("src", "http://localhost/WoodWorks/public/assets/images/designer/No_image.jpg");
        thirdImg.setAttribute("src", "http://localhost/WoodWorks/public/assets/images/designer/No_image.jpg");
    }

    console.log(pdf);

    if(pdf != null) {

        // Get the last occurrence of "/" to isolate the file name
        const lastSlashIndex = pdf.lastIndexOf("/");
        const fileNameWithExtension = pdf.substring(lastSlashIndex + 1);

        // Get the substring starting from the 0th index up to the last occurrence of "." to remove the file extension
        const fileName = fileNameWithExtension.substring(0, fileNameWithExtension.lastIndexOf("."));

        // Get the first 7 characters of the file name using substring
        const trimmedFileName = fileName.substring(0, 7) + ".." + fileName.substring(fileName.length - 5);

        pdfPreview.innerHTML = `<div style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
              <img src="http://localhost/WoodWorks/public/assets/images/designer/pdf-file.png" alt="PDF icon" style="width: 70px; height: 70px;">
              <span style="font-size: 15px; font-weight: bold; text-align: center; margin-top: 10px;">Selected Pdf file: ${trimmedFileName}.pdf</span>
            </div>`;
    }

}

function closeDocumentPopup()
{
    let popup = document.getElementById("upl-docs");
    popup.style.visibility = "hidden";
}





