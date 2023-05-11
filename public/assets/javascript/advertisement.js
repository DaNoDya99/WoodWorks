function addToCart(id,cost)
{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "http://localhost/WoodWorks/public/cart/addToCart/"+id+'/'+cost, true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                console.log(xhr.response);
            }
        }
    }
    xhr.send();
}