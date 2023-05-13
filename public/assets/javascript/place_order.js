let popup = document.getElementById('popup');
let promo = document.querySelector('.promo-field');
let paymentItems = document.querySelector('.payment-items');
let paymentDet = document.querySelector('.payment-details');
let form = document.getElementById('shipping-details');
let response = document.getElementById('response');

form.onsubmit = (e) => {
    e.preventDefault();
}

function openPopup(){
    popup.classList.add("open-popup");
    paymentItems.style.visibility = "hidden";
    paymentDet.style.visibility = "hidden";
}

function closePopup(){
    promo.classList.remove("open-promo-field");
    popup.classList.remove("open-popup");
    paymentItems.style.visibility = "visible";
    paymentDet.style.visibility = "visible";
}

function openPromoField()
{
    // promo.classList.remove('promo-field');
    promo.classList.add("open-promo-field");
}

function checkout(orderID){
    let formData = new FormData(form);

    if(validate(formData)){
        let xhr = new XMLHttpRequest();
        xhr.open('POST',"http://localhost/WoodWorks/public/customer_home/checkout/"+orderID,true);
        xhr.onload = () => {
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    console.log(xhr.response);
                    window.location.href = JSON.parse(xhr.response);
                }

            }
        }
        xhr.send(formData);
    }

}

function validate(data){
    let valid = true;
    let Firstname = data.get('Firstname');
    let Lastname = data.get('Lastname');
    let Email = data.get('Email');
    let Contact = data.get('Contactno');
    let Address = data.get('Address');

    const regex1 = /^[a-zA-Z]+$/;
    const regex2 = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const regex3 = /^[0-9]+$/;

    if(Firstname === ""){
        valid = false;
        document.getElementById('Firstname').innerHTML = "&nbsp* Please enter your firstname";
    }else if(Firstname.length < 3){
        valid = false;
        document.getElementById('Firstname').innerHTML = "&nbsp* Firstname should be atleast 3 characters";
    }else if(regex1.test(Firstname) === false){
        valid = false;
        document.getElementById('Firstname').innerHTML = "&nbsp* Firstname should contain only letters";
    }

    if (Lastname === "") {
        valid = false;
        document.getElementById('Lastname').innerHTML = "&nbsp* Please enter your lastname";
    }else if(Lastname.length < 3){
        valid = false;
        document.getElementById('Lastname').innerHTML = "&nbsp* Lastname should be atleast 3 characters";
    }else if(regex1.test(Lastname) === false){
        valid = false;
        document.getElementById('Lastname').innerHTML = "&nbsp* Lastname should contain only letters";
    }

    if (Email === "") {
        valid = false;
        document.getElementById('Email').innerHTML = "&nbsp* Please enter your email";
    }else if(regex2.test(Email) === false){
        valid = false;
        document.getElementById('Email').innerHTML = "&nbsp* Please enter a valid email";
    }

    if (Contact === "") {
        valid = false;
        document.getElementById('Contactno').innerHTML = "&nbsp* Please enter your contact number";
    }else if(regex3.test(Contact) === false){
        valid = false;
        document.getElementById('Contactno').innerHTML = "&nbsp* Please enter a valid contact number";
    }

    if (Address === "") {
        valid = false;
        document.getElementById('Address').innerHTML = "&nbsp* Please enter your address";
    }

    return valid;
}
