function decreaseQuantity(cartid,productid,quantity,cost)
{
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'http://localhost/WoodWorks/public/cart/decreaseQuantity/'+cartid+'/'+productid+'/'+quantity+'/'+cost , true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                window.location.reload();
            }
        }

    }
    xhr.send();
}

function increaseQuantity(cartid,productid,quantity,cost)
{
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'http://localhost/WoodWorks/public/cart/increaseQuantity/'+cartid+'/'+productid+'/'+quantity+'/'+cost , true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                window.location.reload();
            }
        }

    }
    xhr.send();
}

