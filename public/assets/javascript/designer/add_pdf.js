(function (window,document){

    const pdfFileInput = document.getElementById('pdfFile-input');
    const pdfPreview = document.getElementById('pdf-preview');

    window.showPdfPreview = function() {
        console.log('showPdfPreview');
        const pdfFile = pdfFileInput.files[0];
        const pdfFileName = pdfFile.name;
        // const pdfReader = new FileReader();
        //
        // pdfReader.onload = function() {
        //     const pdfDataUri = pdfReader.result;
        //     const pdfObject = `<object data="${pdfDataUri}" type="application/pdf" width="100%" height="600px">${pdfFileName}</object>`;
        //     pdfPreview.innerHTML = pdfObject;
        // };
        //
        // pdfReader.readAsDataURL(pdfFile);

        pdfPreview.innerHTML = `<div style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
              <img src="http://localhost/WoodWorks/public/assets/images/designer/pdf-file.png" alt="PDF icon" style="width: 70px; height: 70px;">
              <span style="font-size: 15px; font-weight: bold; text-align: center; margin-top: 10px;">Selected Pdf file: ${pdfFileName}</span>
            </div>`;


    }

})(window,document);

