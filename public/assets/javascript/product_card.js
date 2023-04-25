let discount = document.querySelectorAll(".product-card-discount p");

for(let i = 0; i < discount.length; i++)
{
    discount[i].click();
    console.log(discount[i].innerHTML);
}

function calDiscount()
{
    document.querySelector(".product-card-details h3").innerHTML = "Rs. 150.00";
}