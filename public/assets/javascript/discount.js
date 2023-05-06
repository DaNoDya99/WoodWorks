let form = document.getElementById('form');
let discounts_popup = document.getElementById('discounts-popup');
let response = document.getElementById('response');
let edit_form = document.getElementById('edit-form');
let dis_id = '';

form.onsubmit = (e) => {
    e.preventDefault();
}

edit_form.onsubmit = (e) => {
    e.preventDefault();
}

function add_discount()
{
    let data = new FormData(form);
    let res = validate(data);

    const checkboxes1 = document.querySelectorAll('input[name="products"]:checked');
    let products = [];

    checkboxes1.forEach((checkbox) => {
        products.push(checkbox.value);
    })

    if(res.valid){
        let xhr = new XMLHttpRequest();
        xhr.open('POST','http://localhost/WoodWorks/public/discount/add',true);
        xhr.onload = () => {
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    document.getElementById('response').innerHTML = xhr.response;
                    setTimeout(() => {
                        location.reload();
                    },2000);
                }
            }
        }

        xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
        xhr.send('Name='+data.get('Name')+'&Discount_percentage='+data.get('Discount_percentage')+'&Active='+data.get('Active')+'&Expired_at='+data.get('Expired_at')+'&categories='+res.categories+'&products='+products);
    }
}



function validate(data){
    let valid = true;
    let categories = [];

    let name = data.get('Name');
    let discount = data.get('Discount_percentage');
    let active  = data.get('Active');
    let expired_at =  data.get('Expired_at');
    categories.push(data.get('category1'));
    categories.push(data.get('category2'));
    categories.push(data.get('category3'));
    categories.push(data.get('category4'));
    categories.push(data.get('category5'));
    categories.push(data.get('category6'));
    categories.push(data.get('category7'));

    let expired_date = new Date(expired_at);

    let filteredArray = categories.filter(function (el) {
        return el != null;
    });

    const regex1 = /^[0-9]+$/;
    const regex2 = /^[a-zA-Z ]+$/;
    const regex3 = /^[a-zA-Z0-9 ]+$/;


    if(name === ""){
        valid = false;
        document.getElementById('name').innerHTML = "*Please enter the discount name.";
    }else if(name.length < 3){
        valid = false;
        document.getElementById('name').innerHTML = "*Discount name should be atleast 4 characters.";
    }else if(regex2.test(name) === false){
        valid = false;
        document.getElementById('name').innerHTML = "*Discount name should contain only letters and spaces.";
    }

    if(discount === ""){
        valid = false;
        document.getElementById('discount').innerHTML = "*Please enter the discount percentage.";
    // }else if(regex1.test(discount)){
    //     valid = false;
    //     document.getElementById('discount').innerHTML = "*Discount percentage should contain only numbers.";
    }else if(discount.length>2){
        valid = false;
        document.getElementById('discount').innerHTML = "*Discount percentage should maximum of two numbers.";
    }

    if(expired_at === ""){
        valid = false;
        document.getElementById('expired_at').innerHTML = "*Please enter the expired date.";
    }
    else if(expired_date < new Date()){
        valid = false;
        document.getElementById('expired_at').innerHTML = "*Please enter a valid expired date.";
    }

    let flag = true;

    for(let i=0;i<categories.length;i++){
        if(categories[i] !== null){
            flag = false;
        }
    }

    console.log(categories);

    if(flag){
        valid = false;
        document.getElementById('category').innerHTML = "*Please select atleast one category.";
    }

    return {
        'valid': valid,
        'categories': filteredArray
    };
}

function getSubCategories(id){

    let e = document.getElementById(id);

    if(e.checked){
        let xhr=new XMLHttpRequest();
        xhr.open('GET','http://localhost/WoodWorks/public/category/getSubCategories/'+id,true);
        xhr.onload= () => {
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    document.getElementById('sub-cats').innerHTML = xhr.response;
                    console.log(xhr.response);
                }
            }
        }
        xhr.send();
    }
    else{
        document.getElementById('sub-cats').innerHTML = "<span class='dis-err'>Please select a category.</span>";
    }
}

function selectSubCategory(id){
    let xhr = new XMLHttpRequest();
    xhr.open('GET','http://localhost/WoodWorks/public/category/getSubCategories/'+id,true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                document.getElementById('sub-cats').innerHTML = xhr.response;
            }
        }
    }

    xhr.send();
}

function selectAllCategoryProducts(name)
{
    let checkboxes = document.querySelectorAll('input[category="'+name+'"]');
    let checkbox = document.getElementById(name);

    console.log(checkboxes);

    if(checkbox.checked){
        checkboxes.forEach((checkbox) => {
            checkbox.checked = true;
        });
    }else{
        checkboxes.forEach((checkbox) => {
            checkbox.checked = false;
        });
    }
}

function openDiscountsPopup()
{
    discounts_popup.classList.add('open-popup');
}

function closeDiscountsPopup()
{
    discounts_popup.classList.remove('open-popup');
}

function getDiscountsInfo(id,percentage)
{
    document.getElementById('discounts-info-popup').classList.add('open-popup');

    let xhr = new XMLHttpRequest();
    xhr.open('GET','http://localhost/WoodWorks/public/discount/getDiscountInfo/'+id+'/'+percentage,true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                document.getElementById('t-body-info').innerHTML = xhr.response;
            }
        }
    }
    xhr.send();
}

function closeDiscountsInfoPopup()
{
    document.getElementById('discounts-info-popup').classList.remove('open-popup');
}

window.addEventListener('load', function() {
    document.getElementById('ongoing-discounts').click();
});

function getActiveDiscounts()
{
    document.getElementById('ongoing-discounts').classList.add('selected');
    document.getElementById('past-discounts').classList.remove('selected');

    let xhr = new XMLHttpRequest();

    xhr.open('GET','http://localhost/WoodWorks/public/discount/getActiveDiscounts',true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                document.getElementById('t-body').innerHTML = xhr.response;
            }
        }
    }
    xhr.send();
}

function getPastDiscounts()
{
    document.getElementById('past-discounts').classList.add('selected');
    document.getElementById('ongoing-discounts').classList.remove('selected');

    let xhr = new XMLHttpRequest();

    xhr.open('GET','http://localhost/WoodWorks/public/discount/getPastDiscounts',true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                document.getElementById('t-body').innerHTML = xhr.response;
            }
        }
    }
    xhr.send();
}

function deleteDiscount(id)
{
    dis_id = id;

    response.innerHTML = "<div class='cat-success cat-deletion'>\n" +
        "        <h2>Do you want to delete this?</h2>\n" +
        "        <div class=\"cat-deletion-btns\">\n" +
        "            <button onclick=\"confirmDeleteDiscount()\">Yes</button>\n" +
        "            <button onclick=\"closeDeleteDiscountPopup()\">No</button>\n" +
        "        </div>\n" +
        "    </div>";
}

function confirmDeleteDiscount()
{
    let xhr = new XMLHttpRequest();
    xhr.open('GET','http://localhost/WoodWorks/public/discount/deleteDiscount/'+dis_id,true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                response.innerHTML = xhr.response;
                dis_id = '';
                setTimeout(function () {
                    window.location.reload();
                },2000);
            }
        }
    }
    xhr.send();
}

function closeDeleteDiscountPopup()
{
    response.innerHTML = "";
}

function editDiscount(id)
{
    document.getElementById('discounts-edit-popup').classList.add('open-popup');
    dis_id = id;

    let xhr = new XMLHttpRequest();
    xhr.open('GET','http://localhost/WoodWorks/public/discount/editDiscount/'+id,true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = JSON.parse(xhr.response);
                document.getElementById('dis-id').innerHTML = data.DiscountID;
                document.getElementById('discount-name').value = data.Name;
                document.getElementById('discount-percentage').value = data.Discount_percentage;
                document.getElementById('discount-expired-date').value = data.Expired_at;
                document.getElementById('discount-status').checked = data.Active === 1;

            }
        }
    }
    xhr.send();
}

function closeDiscountsEditPopup() {
    document.getElementById('discounts-edit-popup').classList.remove('open-popup');
    dis_id = '';
}

function saveDiscount()
{
    let formData = new FormData(edit_form);

    if(formData.has('Active',true))
    {
        formData.set('Active','1');
    }else
    {
        formData.set('Active','0');
    }

    if(validateEdit(formData))
    {
        let xhr = new XMLHttpRequest();
        xhr.open('POST','http://localhost/WoodWorks/public/discount/updateDiscount/'+dis_id,true);
        xhr.onload = () => {
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    response.innerHTML = xhr.response;
                    setTimeout(function () {
                        window.location.reload();
                    },2000);
                }
            }
        }
        xhr.send(formData);
    }
}

function validateEdit(formData)
{
    let valid = true;

    let name = formData.get('Name');
    let percentage = formData.get('Discount_percentage');
    let expired_date = formData.get('Expired_at');

    const regex1 = /^[0-9]+$/;
    const regex2 = /^[a-zA-Z ]+$/;

    let date = new Date(expired_date);

    if(name === '')
    {
        document.getElementById('name-error').innerHTML = "&nbsp *Please enter a name.";
        valid = false;
    }else if(!regex2.test(name))
    {
        document.getElementById('name-error').innerHTML = "&nbsp *Please enter a valid name.";
        valid = false;
    }

    if (percentage === '')
    {
        document.getElementById('percentage-error').innerHTML = "&nbsp *Please enter a percentage.";
        valid = false;
    }else if(!regex1.test(percentage))
    {
        document.getElementById('percentage-error').innerHTML = "&nbsp *Please enter a valid percentage.";
        valid = false;
    }else if(percentage < 0 || percentage > 100)
    {
        document.getElementById('percentage-error').innerHTML = "&nbsp *Please enter a valid percentage.";
        valid = false;
    }

    if(expired_date === '')
    {
        document.getElementById('expired-date-error').innerHTML = "&nbsp *Please enter an expired date.";
        valid = false;
    }else if(date < new Date())
    {
        document.getElementById('expired-date-error').innerHTML = "&nbsp *Please enter a valid expired date.";
        valid = false;
    }

    return valid;
}