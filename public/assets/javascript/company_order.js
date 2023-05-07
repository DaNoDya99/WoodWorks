let select_supplier = document.getElementById('select-supplier');
let reorder_form = document.getElementById('reorder-form');
let response = document.getElementById('response');
let details_table = document.getElementById('details-table');

let supplier = '';
let order_id = '';

reorder_form.onsubmit = (e) => {
    e.preventDefault();
}


window.onload = () => {
    supplier = select_supplier.value;
    supplier = supplier.split('-')[0];
    loadSupplierProducts(supplier);
    document.getElementById('accepted').click();
}

function loadSupplierProducts(supplier) {
    console.log(supplier);
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/WoodWorks/public/supplier/getSupplierProdcuts/' + supplier, true);
    xhr.onload = () => {
        if (xhr.readyState === 4 )
        {
            if (xhr.status === 200) {
                document.getElementById('t-body').innerHTML = xhr.response;
            }
        }
    }
    xhr.send();
}

select_supplier.onchange = () => {
    let supplier = select_supplier.value;
    document.getElementById('supplier-name').innerHTML = supplier;
    supplier = supplier.split('-')[0];
    loadSupplierProducts(supplier);
}

function getSelectedProducts() {
    let selected = [];
    let checkboxes = document.getElementsByName('product');
    for (let i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            selected.push(checkboxes[i].value);
        }
    }


    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'http://localhost/WoodWorks/public/order/getSelectedProducts', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = () => {
        if (xhr.readyState === 4 )
        {
            if (xhr.status === 200) {
                if(xhr.response !== '') {
                    document.getElementById('company-order-tbody').innerHTML = xhr.response;
                }else{
                    document.getElementById('company-order-tbody').innerHTML = '<tr><td colspan="4" class="text-center">No Products Selected</td></tr>';
                }
            }
        }
    }
    xhr.send('selected=' + JSON.stringify(selected));
}

function placeOrder()
{
    let formData = new FormData(reorder_form);
    let products = document.querySelectorAll("input[type='number']");

    if(products.length > 0){
        let productArray = [];
        for(let i = 0; i < products.length; i++){
            productArray.push(products[i].value);
        }
        formData.append('products', JSON.stringify(productArray));
    }

    formData.append('supplier', supplier);

    if(validate(formData)){
        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'http://localhost/WoodWorks/public/order/placeCompanyOrder', true);
        xhr.onload = () => {
            if (xhr.readyState === 4 )
            {
                if (xhr.status === 200) {
                    console.log(xhr.response);
                    if(xhr.response === 'success'){
                        response.innerHTML = "<div class='cat-success'>\n" +
                            "        <h2>Order Placed Successfully.</h2>\n" +
                            "    </div>";
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    }

                }
            }
        }
        xhr.send(formData);
    }
}

function validate(formData)
{
    let valid = true;

    let products = JSON.parse(formData.get('products'));
    let supplier = formData.get('supplier');
    let comment = formData.get('Comments');

    if(products === null || products === ''){
        valid = false;
        document.getElementById('product-error').innerHTML = '&nbsp *Please Select Products';
    }else{
        products.forEach(product => {
            if(product === '' || product === null){
                valid = false;
                document.getElementById('product-error').innerHTML = '&nbsp *Please Enter Valid Quantities';
            }else if(product < 0){
                valid = false;
                document.getElementById('product-error').innerHTML = '&nbsp *Quantity cannot be negative';
            }else if(product === '0'){
                valid = false;
                document.getElementById('product-error').innerHTML = '&nbsp *Quantity cannot be zero';
            }else if(Number.isInteger(Number(product)) === false){
                valid = false;
                document.getElementById('product-error').innerHTML = '&nbsp *Quantity cannot be decimal';
            }
        })
    }


    if(supplier === null || supplier === ''){
        valid = false;
        document.getElementById('supplier-error').innerHTML = '&nbsp *Please Select Supplier';
    }

    return valid;
}

function openOrderDetailsPopup()
{
    document.getElementById('orders-info-popup').classList.add('open-popup');
}

function closeOrderDetailsPopup()
{
    document.getElementById('orders-info-popup').classList.remove('open-popup');
}

function getAcceptedOrders(){
    document.getElementById('accepted').classList.add('selected');
    document.getElementById('rejected').classList.remove('selected');
    document.getElementById('pending').classList.remove('selected');
    document.getElementById('completed').classList.remove('selected');
    document.getElementById('received').classList.remove('selected');

    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/WoodWorks/public/order/getCompanyAcceptedOrders', true);
    xhr.onload = () => {
        if (xhr.readyState === 4 )
        {
            if (xhr.status === 200) {
                details_table.innerHTML = xhr.response;
            }
        }
    }
    xhr.send();
}

function getRejectedOrders(){
    document.getElementById('accepted').classList.remove('selected');
    document.getElementById('rejected').classList.add('selected');
    document.getElementById('pending').classList.remove('selected');
    document.getElementById('completed').classList.remove('selected');
    document.getElementById('received').classList.remove('selected');

    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/WoodWorks/public/order/getCompanyRejectedOrders', true);
    xhr.onload = () => {
        if (xhr.readyState === 4 )
        {
            if (xhr.status === 200) {
               details_table.innerHTML = xhr.response;
            }
        }
    }
    xhr.send();
}

function getPendingOrders(){
    document.getElementById('accepted').classList.remove('selected');
    document.getElementById('rejected').classList.remove('selected');
    document.getElementById('pending').classList.add('selected');
    document.getElementById('completed').classList.remove('selected');
    document.getElementById('received').classList.remove('selected');

    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/WoodWorks/public/order/getCompanyPendingOrders', true);
    xhr.onload = () => {
        if (xhr.readyState === 4 )
        {
            if (xhr.status === 200) {
                details_table.innerHTML = xhr.response;
            }
        }
    }
    xhr.send();
}

function getCompletedOrders(){
    document.getElementById('accepted').classList.remove('selected');
    document.getElementById('rejected').classList.remove('selected');
    document.getElementById('pending').classList.remove('selected');
    document.getElementById('completed').classList.add('selected');
    document.getElementById('received').classList.remove('selected');

    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/WoodWorks/public/order/getCompanyCompletedOrders', true);
    xhr.onload = () => {
        if (xhr.readyState === 4 )
        {
            if (xhr.status === 200) {
                details_table.innerHTML = xhr.response;
            }
        }
    }
    xhr.send();
}

function getReceivedOrders(){
    document.getElementById('accepted').classList.remove('selected');
    document.getElementById('rejected').classList.remove('selected');
    document.getElementById('pending').classList.remove('selected');
    document.getElementById('completed').classList.remove('selected');
    document.getElementById('received').classList.add('selected');

    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/WoodWorks/public/order/getCompanyReceivedOrders', true);
    xhr.onload = () => {
        if (xhr.readyState === 4 )
        {
            if (xhr.status === 200) {
                details_table.innerHTML = xhr.response;
            }
        }
    }
    xhr.send();
}

function deleteCompanyOrder(id)
{
    order_id = id;

    response.innerHTML = "<div class='cat-success cat-deletion'>\n" +
        "        <h2>Do you want to delete this?</h2>\n" +
        "        <div class=\"cat-deletion-btns\">\n" +
        "            <button onclick=\"confirmDeleteCompanyOrder()\">Yes</button>\n" +
        "            <button onclick=\"closeDeleteCompanyOrderPopup()\">No</button>\n" +
        "        </div>\n" +
        "    </div>";
}

function confirmDeleteCompanyOrder()
{
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'http://localhost/WoodWorks/public/order/deleteCompanyOrder/'+order_id, true);
    xhr.onload = () => {
        if (xhr.readyState === 4 )
        {
            if (xhr.status === 200) {
                if(xhr.response === 'success'){
                    response.innerHTML = "<div class='cat-success cat-deletion'>\n" +
                        "        <h2>Order Deleted Successfully.</h2>\n" +
                        "    </div>";
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                }else
                {
                    response.innerHTML = "<div class='cat-success cat-deletion'>\n" +
                        "        <h2>Order Deletion Failed.</h2>\n" +
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

function closeDeleteCompanyOrderPopup()
{
    response.innerHTML = '';
    order_id = null;
}

function orderReceived(id)
{
    order_id = id;

    response.innerHTML = "<div class='cat-success'>\n" +
        "        <h2>Have you received this order?</h2>\n" +
        "        <div class=\"cat-deletion-btns\">\n" +
        "            <button style='background-color: #17c330;' onclick=\"confirmOrderReceived()\">Yes</button>\n" +
        "            <button style='background-color: #17c330;' onclick=\"closeOrderReceivedPopup()\">No</button>\n" +
        "        </div>\n" +
        "    </div>";
}

function confirmOrderReceived()
{
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'http://localhost/WoodWorks/public/order/orderReceived/'+order_id, true);
    xhr.onload = () => {
        if (xhr.readyState === 4 )
        {
            if (xhr.status === 200) {
                if(xhr.response === 'success'){
                    response.innerHTML = "<div class='cat-success'>\n" +
                        "        <h2>Updated Successfully</h2>\n" +
                        "    </div>";
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                }else
                {
                    response.innerHTML = "<div class='cat-success cat-deletion'>\n" +
                        "        <h2>Update Failed.</h2>\n" +
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

function closeOrderReceivedPopup() {
    response.innerHTML = '';
    order_id = null;
}

function editCompanyOrder(id)
{
    order_id = id;

    document.getElementById('order-id').innerHTML = order_id;

    document.getElementById('order-edit-popup').classList.add('open-popup');

    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/WoodWorks/public/order/editCompanyOrder/'+order_id, true);
    xhr.onload = () => {
        if (xhr.readyState === 4 )
        {
            if (xhr.status === 200) {
                document.getElementById('edit-form-container').innerHTML = xhr.response;
            }
        }
    }
    xhr.send();
}

function closeEditCompanyOrderPopup()
{
    document.getElementById('order-edit-popup').classList.remove('open-popup');
    order_id = null;
}

function updateCompanyOrder(id)
{
    let edit_form = document.getElementById('order-edit-form');

    edit_form.onsubmit = (e) => {
        e.preventDefault();
    }

    let formData = new FormData(edit_form);
    let comment = formData.get('Comments');

    if(edit_validate(formData))
    {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'http://localhost/WoodWorks/public/order/updateCompanyOrder/'+id, true);
        xhr.onload = () => {
            if (xhr.readyState === 4 )
            {
                if (xhr.status === 200) {
                    console.log(xhr.response)
                    if(xhr.response === 'success'){
                        response.innerHTML = "<div class='cat-success'>\n" +
                            "        <h2>Updated Successfully</h2>\n" +
                            "    </div>";
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    }else
                    {
                        response.innerHTML = "<div class='cat-success cat-deletion'>\n" +
                            "        <h2>Update Failed.</h2>\n" +
                            "    </div>";
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    }

                }
            }
        }
        formData.append('Comments', comment);
        xhr.send(formData);
    }
}

function edit_validate(data)
{
    let valid = true;

    data.delete('Comments');

    data.forEach((value, key) => {
        console.log(key, value);
        if(value === '') {
            document.getElementById('quantity-error').innerHTML = '&nbsp *Quantities are required.';
            valid = false;
        }else if(value < 0){
            document.getElementById('quantity-error').innerHTML = '&nbsp *Quantities cannot be negative.';
            valid = false;
        }else if(Number.isInteger(Number(value)) === false){
            document.getElementById('quantity-error').innerHTML = '&nbsp *Quantities must be integers.';
            valid = false;
        }else if(Number(value) === 0){
            document.getElementById('quantity-error').innerHTML = '&nbsp *Quantities cannot be zero.';
            valid = false;
        }
    })

    return valid;

}

function getCompanyOrderInfo(id)
{
    document.getElementById('order-id-details').innerHTML = id;

    document.getElementById('order-details-popup').classList.add('open-popup');

    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/WoodWorks/public/order/getCompanyOrderDetails/'+id, true);
    xhr.onload = () => {
        if (xhr.readyState === 4 )
        {
            if (xhr.status === 200) {
                document.getElementById('order-info-container').innerHTML = xhr.response;
            }
        }
    }
    xhr.send();
}

function closeCompanyOrderDetailsPopup()
{
    document.getElementById('order-details-popup').classList.remove('open-popup');
}