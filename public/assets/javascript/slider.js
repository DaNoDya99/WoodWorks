let response = document.getElementById('response');
var slideIndex = 1;

showSlides(slideIndex);

function plusSlides(n){
    showSlides(slideIndex += n)
}

function currentSlide(n){
    showSlides(slideIndex = n)
}

function showSlides(n)
{
    var i;
    var slides = document.getElementsByClassName("my-slides");
    var dots = document.getElementsByClassName("dot");

    if(n>slides.length) {slideIndex = 1}
    if(n<1) {slideIndex = slides.length}

    for(i=0;i<slides.length;i++)
    {
        slides[i].style.display = "none";
    }

    for(i=0;i<dots.length;i++)
    {
       dots[i].className = dots[i].className.replace("active","");
    }

    slides[slideIndex - 1].style.display = "block";
    // dots[slideIndex - 1].className += "active";
}

function addToCart(id,cost)
{
    let xhr = new XMLHttpRequest();
    xhr.open("POST","http://localhost/WoodWorks/public/customer_home/add_to_cart/"+id+"/"+cost,true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                response.innerHTML = xhr.response;
                setTimeout(() => {
                    response.innerHTML = "";
                }, 3000);
            }
        }
    }
    xhr.send();
}



