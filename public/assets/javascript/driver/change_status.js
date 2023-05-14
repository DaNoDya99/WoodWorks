let response = document.getElementById('response');
let order_id = '';

function changeStatus(id) {

    order_id = id;

    response.innerHTML = "<div class='cat-successful'>\n" +
        "        <h2>Do you want to change the order status?</h2>\n" +
        "        <div class=\"cat-success-btns\">\n" +
        "            <button onclick=\"confirmChangeStatus()\">Yes</button>\n" +
        "            <button onclick=\"closeChangeStatusPopup()\">No</button>\n" +
        "        </div>\n" +
        "    </div>";
}


function confirmChangeStatus() {
    let select = document.getElementsByName("status")[0];
    let status = select.value;

    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'http://localhost/WoodWorks/public/driver_home/change_order_status/'+order_id, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');


    xhr.onload = () => {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                console.log(xhr.response);
                if(xhr.response === 'success'){
                    response.innerHTML = "<div class='cat-successful'>\n" +
                        "        <h2>Order Status Changed Successfully.</h2>\n" +
                        "    </div>";
                    setTimeout(() => {
                        window.location.href = 'http://localhost/WoodWorks/public/driver_home/order';
                    }, 2000);
                }else
                {
                    response.innerHTML = "<div class='cat-success cat-deletion'>\n" +
                        "        <h2>Order Status change Failed.</h2>\n" +
                        "    </div>";
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                }
            }
        }
    };
    xhr.send('status=' + status); // send status value to server
}


function closeChangeStatusPopup() {
    response.innerHTML = '';
    design_id = ''; // reset design_id variable
    window.location.href = 'http://localhost/WoodWorks/public/driver_home/order';
}




