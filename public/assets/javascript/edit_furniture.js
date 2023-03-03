let popup = document.getElementById('popup');
let closeBtn = document.querySelector('.popup-heading img');

function openPopup(id){
    popup.classList.add("open-popup");
    let xhr = new XMLHttpRequest();
    xhr.open('GET','http://localhost/WoodWorks/public/furniture/details/'+id,true);
    xhr.onload = () => {
        if(xhr.readyState === xhr.DONE){
            if(xhr.status === 200){
                document.getElementById('edit-fur-form').innerHTML = xhr.response;
            }
        }
    }
    xhr.send();
}

function closePopup(){
    popup.classList.remove("open-popup");
}
