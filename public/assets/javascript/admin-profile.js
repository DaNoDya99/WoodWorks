function load_image(file){
    let mylink;
    mylink = window.URL.createObjectURL(file);
    document.querySelector(".edit-img").src = mylink;
}

let tab = 'tab1';