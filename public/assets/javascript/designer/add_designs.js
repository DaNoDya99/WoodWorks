(function (window,document){

    let fileInput = document.getElementById("file-input");
    let imageContainer = document.getElementById("images");
    var numOfFiles = document.getElementById("num-of-files");
    var input = document.getElementById('file-input');

    const pdfFileInput = document.getElementById('pdfFile-input');
    const pdfPreview = document.getElementById('pdf-preview');

    window.preview = function () {
        if (input.files.length === 3) {

            imageContainer.innerHTML = "";
            numOfFiles.textContent = `${fileInput.files.length} Images have been Selected`;

            for (i of fileInput.files) {
                let reader = new FileReader();
                let figure = document.createElement("figure");
                let figCap = document.createElement("figcaption");

                figCap.innerText = i.name;
                figure.appendChild(figCap);
                reader.onload = () => {
                    let img = document.createElement("img");
                    img.setAttribute("src", reader.result);
                    figure.insertBefore(img, figCap);
                }
                imageContainer.appendChild(figure);
                reader.readAsDataURL(i);

            }

        }else {

            numOfFiles.textContent = "please select exactly 3 Images";
            numOfFiles.style.cssText = "color:#721c24; " +
                "                       background : #f8d7da; " +
                "                       border : 1px solid #f5c6c;" +
                "                       border-radius : 5px; " +
                "                       padding: 8px 10px; " +
                "                       text-align: center; " +
                "                       margin: auto; " +
                "                       width: 300px;" +
                "                       margin-bottom: 10px";

        }

    }


})(window,document);

