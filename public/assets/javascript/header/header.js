    let btn1 = document.querySelector('#btn');
    let btn2 = document.querySelector('#btn2');
    let sidebar = document.querySelector('.sidebar');
    let offlogo = document.querySelector('#off');
    let onlogo = document.querySelector('#on');
    let content = document.querySelector('.content');
    let header = document.querySelector('.header');
    let body = document.querySelector('body');



    btn1.onclick = function () {
    sidebar.classList.toggle('active');
    content.classList.toggle('blur');
    // header.classList.toggle('blur');
    body.classList.toggle('scroll');


    // onlogo.style.opacity=1;
    // offlogo.style.opacity=0;
}
    btn2.onclick = function () {
    sidebar.classList.toggle('active');
    // onlogo.style.opacity=1;
    // offlogo.style.opacity=0;
    body.classList.toggle('scroll');
    content.classList.toggle('blur');
    // header.classList.toggle('blur');

}
