let form = document.getElementById('form');

form.onsubmit = (e) => {
    e.preventDefault();
}

function add_discount()
{
    let data = new FormData(form);
    let res = validate(data);

    if(res.valid){
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
    }else if(regex1.test(discount)){
        valid = false;
        document.getElementById('discount').innerHTML = "*Discount percentage should contain only numbers.";
    }else if(discount.length>2){
        valid = false;
        document.getElementById('discount').innerHTML = "*Discount percentage should maximum of two numbers.";
    }

    if(expired_at === ""){
        valid = false;
        document.getElementById('expired_at').innerHTML = "*Please enter the expired date.";
    }

    flag = true;

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

function getAllProducts(id)
{
    let xhr = new XMLHttpRequest();
    xhr.open('GET','http://localhost/WoodWorks/public/product/getAllProducts/'+id,true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                document.getElementById('products').innerHTML = xhr.response;
            }
        }
    }

    xhr.send();
}