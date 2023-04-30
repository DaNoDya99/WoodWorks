function downloadInvoice(orderId,name){
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/WoodWorks/public/checkout/downloadInvoice/' + orderId + '/' + name, true);
    xhr.onload = () => {
        if(xhr.readyState === xhr.DONE){
            if(xhr.status === 200){
                console.log(xhr.response);
            }
        }
    }
    xhr.send();
}