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
    body.classList.toggle('scroll');
}
btn2.onclick = function () {
    sidebar.classList.toggle('active');
    body.classList.toggle('scroll');
    content.classList.toggle('blur');
}

function dropdown() {
    document.getElementById("myDropdown").classList.toggle("show");
}

window.onclick = function (event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}

