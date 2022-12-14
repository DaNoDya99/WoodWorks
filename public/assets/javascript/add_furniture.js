function load_image_primary(file)
{
    let mylink = window.URL.createObjectURL(file[0]);

    document.querySelector('#first-img').src = mylink;
}

function load_image_secondary(file)
{
    let mylink1 = window.URL.createObjectURL(file[0]);
    let mylink2 = window.URL.createObjectURL(file[1]);

    document.querySelector('#second-img').src = mylink1;
    document.querySelector('#third-img').src = mylink2;
}