let response = document.getElementById('response');

function decreaseQuantity(cartId,orderId,productid,quantity,cost)
{
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'http://localhost/WoodWorks/public/cart/decreaseQuantity/'+cartId+'/'+orderId+'/'+productid+'/'+quantity+'/'+cost , true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                if(xhr.response !== ''){
                    response.innerHTML = xhr.response;
                    setTimeout(() => {
                        response.innerHTML = '';
                        window.location.reload();
                    },2000);
                }else{
                    window.location.reload();
                }
            }
        }

    }
    xhr.send();
}

function increaseQuantity(cartId,orderId,productid,quantity,cost)
{
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'http://localhost/WoodWorks/public/cart/increaseQuantity/'+cartId+'/'+orderId+'/'+productid+'/'+quantity+'/'+cost , true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                if(xhr.response !== ''){
                    response.innerHTML = xhr.response;
                    setTimeout(() => {
                        response.innerHTML = '';
                        window.location.reload();
                    },2000);
                }else{
                    window.location.reload();
                }

            }
        }

    }
    xhr.send();
}

