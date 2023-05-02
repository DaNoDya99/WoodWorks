const order_items = document.getElementById("order-items");
const first = document.getElementById("first");

window.addEventListener('load', function() {
    first.click();
});

function getOrderDetails(orderId) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "http://localhost/WoodWorks/public/customer_home/getOrderDetails/"+orderId, true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                order_items.innerHTML = xhr.response;
            }
        }
    }
    xhr.send();
}