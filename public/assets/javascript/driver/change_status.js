let doc_form = document.getElementById('edit-doc-form');
let response = document.getElementById('response');
let order_id = '';

function changeStatus(id)
{
    design_id = id;

    response.innerHTML = "<div class='cat-success'>\n" +
        "        <h2>Do you want to change the order status?</h2>\n" +
        "        <div class=\"cat-deletion-btns\">\n" +
        "            <button onclick=\"confirmChangeStatus()\">Yes</button>\n" +
        "            <button onclick=\"closeChangeStatusPopup()\">No</button>\n" +
        "        </div>\n" +
        "    </div>";
}

function confirmChangeStatus()
{
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'http://localhost/WoodWorks/public/driver_home/change_order_status/'+design_id, true);
    xhr.onload = () => {
        if (xhr.readyState === 4 )
        {
            if (xhr.status === 200) {
                if(xhr.response === 'success'){
                    response.innerHTML = "<div class='cat-success'>\n" +
                        "        <h2>Order Status Changed.</h2>\n" +
                        "    </div>";
                    setTimeout(() => {
                        window.location.href = 'http://localhost/WoodWorks/public/driver_home/index';
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
    }
    xhr.send();
}

function closeChangeStatusPopup()
{
    response.innerHTML = '';
    order_id = null;
}



