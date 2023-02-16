let contacts = document.getElementById("contacts");
let button = document.getElementById("button");
let form = document.getElementById("chat-manager-form");
let user = '';

// form.onsubmit = (e) => {
//     e.preventDefault();
// }

setInterval(() => {
    let xhr = new XMLHttpRequest();
    xhr.open("GET","http://localhost/WoodWorks/public/message/getManagerChats",true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE)
        {
            if(xhr.status === 200)
            {
                contacts.innerHTML = xhr.response;
            }
        }
    }
    xhr.send();
},500)

function load_messages(id){
    user = id;
    let messages = document.getElementById("msgs");
    let xhr = new XMLHttpRequest();
    xhr.open("GET","http://localhost/WoodWorks/public/message/getManagerMessages/"+id,true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE)
        {
            if(xhr.status === 200)
            {
                messages.innerHTML = xhr.response;
            }
        }
    }
    xhr.send();
}


setInterval(() => {
    if(user !== ''){
        let messages = document.getElementById("msgs");
        let xhr = new XMLHttpRequest();
        xhr.open("GET","http://localhost/WoodWorks/public/message/getManagerMessages/"+user,true);
        xhr.onload = () => {
            if(xhr.readyState === XMLHttpRequest.DONE)
            {
                if(xhr.status === 200)
                {
                    messages.innerHTML = xhr.response;
                }
            }
        }
        xhr.send();
    }
},500);

button.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST","http://localhost/WoodWorks/public/message/sendMsgsToCustomer/"+user,true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE)
        {
            if(xhr.status === 200)
            {

            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}



