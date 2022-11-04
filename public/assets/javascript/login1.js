const errorMsg = document.querySelector(".login-form form .error-txt");
const btn = document.querySelector(".button button");

btn.onclick = () =>{
    errorMsg.style.removeProperty('display')
}