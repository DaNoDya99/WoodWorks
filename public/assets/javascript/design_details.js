let response = document.getElementById('response');

function acceptDesign(id){
    let xhr = new XMLHttpRequest();
    xhr.open('POST',"http://localhost/WoodWorks/public/designer/acceptdesign/"+id,true);
    xhr.onload = () => {
        if(xhr.readyState === xhr.DONE){
            if(xhr.status === 200) {
                response.innerHTML = xhr.response;
                setTimeout(
                    ()=>{
                        location.reload()
                    }, 3000
                )
            }
        }
    }
    xhr.send();
}

function rejectDesign(id){
    let xhr = new XMLHttpRequest();
    xhr.open('POST',"http://localhost/WoodWorks/public/designer/rejectdesign/"+id,true);
    xhr.onload = () => {
        if(xhr.readyState === xhr.DONE){
            if(xhr.status === 200) {
                response.innerHTML = xhr.response;
                setTimeout(
                    ()=>{
                        location.reload()
                    }, 3000
                )
            }
        }
    }
    xhr.send();
}