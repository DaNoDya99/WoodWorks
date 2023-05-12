let contacts1 = document.getElementById("contacts-1");
let contacts2 = document.getElementById("contacts-2");
let button = document.getElementById("button");
let form = document.getElementById("chat-designer-form");
let select_contact = document.getElementById("select_contact");
let search = document.getElementById("search");
let messages = document.getElementById("msg");
let field = document.getElementById("field");
let user = '';
let countPrev = 0;
let count = 0;

setInterval(() => {
    let xhr = new XMLHttpRequest();
    xhr.open("GET","http://localhost/WoodWorks/public/message/getDesignerChats",true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE)
        {
            if(xhr.status === 200)
            {
                contacts1.innerHTML = xhr.response;
            }
        }
    }
    xhr.send();
},500)

function load_messages(id){
    user = id;
    let xhr = new XMLHttpRequest();
    xhr.open("GET","http://localhost/WoodWorks/public/message/getDesignerMessages/"+id,true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE)
        {
            if(xhr.status === 200)
            {
                form.style.visibility = "visible";
                select_contact.style.visibility = "hidden";
                messages.innerHTML = xhr.response;
                messages.scrollTop = messages.scrollHeight;
            }
        }
    }
    xhr.send();
}

function load_header(){
    let xhr = new XMLHttpRequest();
    xhr.open("GET","http://localhost/WoodWorks/public/message/getDesignerMessagesHeader/"+user,true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE)
        {
            if(xhr.status === 200)
            {
                let data = xhr.response;
                let header = document.getElementById("header");
                header.innerHTML = data;
            }
        }
    }
    xhr.send();
}

setInterval(() => {
    if(user !== ''){
        let xhr = new XMLHttpRequest();

        load_header();

        xhr.open("GET","http://localhost/WoodWorks/public/message/getDesignerMessages/"+user,true);
        xhr.onload = () => {
            if(xhr.readyState === XMLHttpRequest.DONE)
            {
                if(xhr.status === 200)
                {
                    countPrev = messages.childElementCount;
                    messages.innerHTML = xhr.response;
                    count = messages.childElementCount;

                    if(countPrev < count){
                        messages.scrollTop = messages.scrollHeight;
                    }
                }
            }
        }
        xhr.send();
    }
},500);

form.onsubmit = (e) => {
    e.preventDefault();
}

button.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST","http://localhost/WoodWorks/public/message/sendMsgsToCustomerByDesigner/"+user,true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE)
        {
            if(xhr.status === 200)
            {
                field.value = "";
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}

search.onkeyup = () => {
    let search_value = search.value;

    if (search_value === "") {
        contacts1.style.display = "block";
        contacts2.style.setProperty("display","none","important");
    }else{
        contacts1.style.display = "none";
        contacts2.style.setProperty("display","block","important");
    }

    let xhr = new XMLHttpRequest();
    xhr.open("POST","http://localhost/WoodWorks/public/message/searchDesignerChats",true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                contacts2.innerHTML = xhr.response;
            }
        }

    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("search="+search_value);
}





