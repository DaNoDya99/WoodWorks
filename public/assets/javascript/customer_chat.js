let cus_chat = document.getElementById("cus-chat");
let dis_chat = document.getElementById("dis-chat");
let chat_btn = document.getElementById("chat-btn");
let manager = document.getElementById("manager-chat-selector");
let designer = document.getElementById("designer-chat-selector");
let button_manager = document.getElementById("button-manager");
let button_designer = document.getElementById("button-designer");
let chat_form_1 = document.getElementById("chat-form-1");
let chat_form_2 = document.getElementById("chat-form-2");
let chat_manager = document.getElementById("chat-manager");
let chat_designer = document.getElementById("chat-designer");
let field = document.getElementById("field");
let countPrev = 0;
let count = 0;

function openChat(){
    manager.style.visibility = "visible";
    designer.style.visibility = "visible";
    setTimeout(() => {
        manager.style.visibility = "hidden";
        designer.style.visibility = "hidden";
    },8000);
}

function closeChat(){
    cus_chat.style.visibility = "hidden";
    dis_chat.style.visibility = "hidden";
    chat_btn.style.visibility = "visible";
}

function openManagerChat(){
    cus_chat.style.visibility = "visible";
    manager.style.visibility = "hidden";
    designer.style.visibility = "hidden";
    chat_btn.style.visibility = "hidden";
}

function openDesignerChat(){
    dis_chat.style.visibility = "visible";
    manager.style.visibility = "hidden";
    designer.style.visibility = "hidden";
    chat_btn.style.visibility = "hidden";
}

chat_form_1.onsubmit = (e) => {
    e.preventDefault();
}

chat_form_2.onsubmit = (e) => {
    e.preventDefault();
}

button_manager.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "http://localhost/WoodWorks/public/message/sendMsgToManager",true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                field.value = "";
            }
        }
    }
    let formData = new FormData(chat_form_1);
    xhr.send(formData);
}

button_designer.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "http://localhost/WoodWorks/public/message/sendMsgToDesigner",true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                field.value = "";
            }
        }
    }
    let formData = new FormData(chat_form_2);
    xhr.send(formData);
}

setInterval(() => {
    let xhr = new XMLHttpRequest();
    xhr.open("GET","http://localhost/WoodWorks/public/message/getCustomerMessages/3");
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){

                    countPrev = chat_manager.childElementCount;
                    chat_manager.innerHTML = xhr.response;
                    count = chat_manager.childElementCount;

                    if(countPrev < count){
                        chat_manager.scrollTop = chat_manager.scrollHeight;
                    }

            }
        }
    }
    xhr.send();
},500)

setInterval(() => {
    let xhr = new XMLHttpRequest();
    xhr.open("GET","http://localhost/WoodWorks/public/message/getCustomerMessages/4");
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){

                countPrev = chat_designer.childElementCount;
                chat_designer.innerHTML = xhr.response;
                count = chat_designer.childElementCount;

                if(countPrev < count){
                    chat_designer.scrollTop = chat_designer.scrollHeight;
                }

            }
        }
    }
    xhr.send();
},500)
