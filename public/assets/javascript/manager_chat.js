let contacts = document.getElementById("contacts");

setInterval(() => {
    let xhr = new XMLHttpRequest();
    xhr.open("GET","http://localhost/WoodWorks/public/message/getManagerChats",true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE)
        {
            if(xhr.status === 200)
            {
                let data = xhr.response;
                contacts.innerHTML = data;
                console.log(data);
            }
        }
    }
    xhr.send();
},500)



