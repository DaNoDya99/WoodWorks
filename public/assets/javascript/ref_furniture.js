
let form = document.getElementById('ref-fur');
let btn = document.getElementById('ref-fur-btn');

form.onsubmit = (e) => {
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

btn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open('POST',"http://localhost/WoodWorks/public/advertisement/insertRefurnishedFurniture",true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                document.getElementById('ad-errors').innerHTML = xhr.response;
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}
