function load_image(file)
{
    let mylink1 = window.URL.createObjectURL(file[0]);
    let mylink2 = window.URL.createObjectURL(file[1]);
    let mylink3 = window.URL.createObjectURL(file[2]);

    document.querySelector('#first-img').src = mylink1;
    document.querySelector('#second-img').src = mylink2;
    document.querySelector('#third-img').src = mylink3;
}