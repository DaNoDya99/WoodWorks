(function (window,document){

    var cur_pos = 0;
    var width = 400;
    var slider_images_container = document.querySelector(".slider_images");
    // var slider_container = document.querySelector(".slider_container");
    // var width = slider_container.getBoundingClientRect().width;

    var images = slider_images_container.querySelectorAll("img");
    var total_images = (images.length-1) * -1;


    var slider_thumbs_container = document.querySelector(".slider_thumbs");
    slider_thumbs_container.innerHTML = slider_images_container.innerHTML;
    // scale_images(slider_images_container,images,width);

    window.move = function (direction)
    {

        if(direction =='left')
            cur_pos +=1;
        if(direction =='right')
            cur_pos -=1;

        if(cur_pos > 0)
            cur_pos = total_images;

        if(cur_pos < total_images)
            cur_pos = 0;

        var translate = cur_pos * width;

        slider_images_container.style.transform = "translateX("+translate+"px)";

    }

    //add Event listeners
    var thumbs= slider_thumbs_container.querySelectorAll("img");

    for(var i = thumbs.length - 1 ;i >= 0; i--)
    {
        thumbs[i].addEventListener('click',thumb_clicked);
    }

    function thumb_clicked(e)
    {
        for (var i = thumbs.length - 1; i >=0; i--)
        {
            if(thumbs[i] === e.currentTarget)
            {
                cur_pos = i * -1;
                window.move();
                break;
            }

        }

    }

    function scale_images(slider_images_container,images,width)
    {
        for (var i = images.length - 1; i >= 0; i--)
        {
            images[i].style.width = width + "px";
        }

    }


})(window,document);




