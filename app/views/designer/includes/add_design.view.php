<?php $this->view('designer/includes/header') ?>

<body class="designer">
<div class="designer-body">
    <?php $this->view('designer/includes/designer_sidebar') ?>
    <div class="dashboard">
        <div class="dashboard-nav">
            <div class="nav-item-page-name">
                <h1><?= $title ?></h1>
            </div>
            <div class="nav-item-user">
                <img src="<?=ROOT?>/<?=$row[0]->Image?>" alt="Profile picture">
                <div class="nav-vr"></div>
                <h1>Hi, <?=ucfirst(substr(Auth::getFirstname(),0,1))?>.<?=Auth::getLastname()?></h1>
                <div class="nav-vr"></div>
                <a href="<?=ROOT?>/logout3">
                    <h1>Logout</h1>
                </a>
            </div>
        </div>

        <a class="go-back" href="<?=ROOT?>/designer/design">
            <img src="<?=ROOT?>/assets/images/designer/back.png" alt="Back Button">
            <h1>Back</h1>
        </a>

        <div class="des-form-body">

            <?php if(!empty($errors)):?>
                <div class="error-txt signup-error">
                    <ul>
                        <?php foreach ($errors as $key => $value):?>
                            <li><?=$errors[$key]?></li>
                        <?php endforeach;?>
                    </ul>
                </div>
            <?php endif;?>

            <form action="/woodworks/public/designer/add_new_design" method="post" enctype="multipart/form-data">

                <h2>Add New Design</h2>

                <label id="designImage" >Design Images</label>

                <div class="designImage">
<!--                    <div class="slider_wrapper">-->
<!--                        <div class="slider_wrapper_inner">-->
<!--                            <div class="slider_left" onclick="move('left')" style="cursor: pointer;">-->
<!--                                <svg style="float: left; margin-top: 100px; " viewBox="0 0 384 512"><path fill="#aaa" d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 278.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/></svg>-->
<!--                            </div>-->
<!---->
<!--                            <div class="slider_container">-->
<!--                                <div class="slider_images">-->
                                    <img class="js-image-preview" src="<?=ROOT?>/assets/images/designer/1.jpg" alt="designs">
<!--                                    <img src="--><?//=ROOT?><!--/assets/images/designer/1.jpg">-->
<!--                                    <img src="--><?//=ROOT?><!--/assets/images/designer/2.jpg">-->
<!--                                    <img src="--><?//=ROOT?><!--/assets/images/designer/3.jpg">-->
<!--                                    <img src="--><?//=ROOT?><!--/assets/images/designer/4.jpg">-->
<!--                                    <img src="--><?//=ROOT?><!--/assets/images/designer/5.jpg">-->
<!--                                    <img src="--><?//=ROOT?><!--/assets/images/designer/6.jpg">-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="slider_right" onclick="move('right')" style="cursor: pointer;">-->
<!--                                <svg  style="float: right; margin-top: 100px; " viewBox="0 0 384 512"><path fill="#aaa" d="M342.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L274.7 256 105.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>-->
<!--                            </div>-->
<!--                        </div>-->
<!---->
<!--                        <div class="slider_thumbs"></div>-->
<!---->
<!--                    </div>-->

                    <div class="js-filename">Selected Files:</div>
                </div>

                <div class="edit-des-Ubtn-section" id="edit-design">
                    <label>
                        Upload Images
                        <input onchange="load_image(this.files)" type="file" style="display: none;" name="images[]" multiple >
                    </label>
                </div>

                <div class="edit-des-Dbtn-section" id="edit-design">
                    <label>
                        Delete Images
                    </label>
                </div>

                <div id="description">
                    <label>Description :</label><textarea name="Description" class="form-control" ></textarea>
                </div>

                <div class="add-des-btn">
                    <button  type="submit" name="AddDesign">Add Design</button>
                </div>

            </form>

        </div>

    </div>
</div>
</body>
</html>

<!--<script type="text/javascript">-->
<!---->
<!--    (function (window,document){-->
<!---->
<!--        var cur_pos = 0;-->
<!--         var width = 400;-->
<!--        var slider_images_container = document.querySelector(".slider_images");-->
<!--        // var slider_container = document.querySelector(".slider_container");-->
<!--        // var width = slider_container.getBoundingClientRect().width;-->
<!---->
<!--        var images = slider_images_container.querySelectorAll("img");-->
<!--        var total_images = (images.length-1) * -1;-->
<!---->
<!--        // console.log(images);-->
<!---->
<!--        var slider_thumbs_container = document.querySelector(".slider_thumbs");-->
<!--        slider_thumbs_container.innerHTML = slider_images_container.innerHTML;-->
<!--        // scale_images(slider_images_container,images,width);-->
<!---->
<!--        window.move = function (direction)-->
<!--        {-->
<!--            if(direction =='left')-->
<!--                cur_pos +=1;-->
<!--            if(direction =='right')-->
<!--                cur_pos -=1;-->
<!---->
<!--            if(cur_pos > 0)-->
<!--                cur_pos = total_images;-->
<!---->
<!--            if(cur_pos < total_images)-->
<!--                cur_pos = 0;-->
<!---->
<!--            var translate = cur_pos * width;-->
<!---->
<!--            slider_images_container.style.transform = "translateX("+translate+"px)";-->
<!---->
<!--        }-->
<!---->
<!--        // add Event listeners-->
<!--        var thumbs= slider_thumbs_container.querySelectorAll("img");-->
<!---->
<!--        for(var i = thumbs.length - 1 ;i >= 0; i--){-->
<!--            thumbs[i].addEventListener('click',thumb_clicked);-->
<!--        }-->
<!---->
<!--        function thumb_clicked(e)-->
<!--        {-->
<!--           for (var i = thumbs.length - 1; i >=0; i--){-->
<!--               if(thumbs[i] === e.currentTarget)-->
<!--               {-->
<!--                   cur_pos = i * -1;-->
<!--                   window.move();-->
<!--                   break;-->
<!--               }-->
<!--           }-->
<!---->
<!--        }-->
<!---->
<!--        function scale_images(slider_images_container,images,width)-->
<!--        {-->
<!--            for (var i = images.length - 1; i >= 0; i--) {-->
<!--                images[i].style.width = width + "px";-->
<!--            }-->
<!--        }-->
<!---->
<!--    })(window,document);-->
<!---->
<!--    function load_image(file)-->
<!--    {-->
<!--        for (var i = 0; i <=file.length - 1; i++)-->
<!--        {-->
<!--            document.querySelector(".js-filename").innerHTML = document.querySelector(".js-filename").innerHTML +" "+file.item(i).name;-->
<!---->
<!--            var mylink = window.URL.createObjectURL(file.item(i));-->
<!---->
<!--            document.querySelector(".js-image-preview").src = mylink;-->
<!--        }-->
<!---->
<!--    }-->
<!---->
<!---->
<!--</script>-->
