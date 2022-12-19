let eyeicon = document.getElementById("eyeicon");
let password = document.getElementById("password");

eyeicon.onclick = function(){
    if(password.type === "password"){
        password.type= "text";
        eyeicon.src = "./assets/images/login3/eye-open.png";
    }else{
        password.type = "password";
        eyeicon.src = "./assets/images/login3/eye-close.png";
    }
}