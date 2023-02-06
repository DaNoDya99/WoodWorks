<?php $this->view('includes/header'); ?>

<div>
    <section class="intro-section">
        <div class="intro-title">
            <h1>Welcome to Woodworks Furniture</h1>
        </div>
        <div class="intro-para">
            <p>At Woodworks Furniture, we believe in reliable quality<br> and service that is affordable to the customer</p>
        </div>
        <button>Shop Now</button>
    </section>
    <section class="latest-section">
        <div class="latest-headings">
            <h1>Check out our latest products</h1>
        </div>
        <div class="latest-product-posts">
            <?php foreach ($furnitures as $row) : ?>
                <?php $data['row'] = $row;
                $this->view('includes/product_card', $data); ?>
            <?php endforeach; ?>
        </div>
    </section>
    <section class="customize-designs-section about" id = "aboutus">
        <div class="customizing-desc">
            <h2>About us</h2>
            <p>
                At Woodworks Furniture, we're proud to be a trusted and reliable source for premium furniture. From our selection of modern pieces to our timeless classics, we have something for everyone. Our team of experts are always ready to help you find the perfect piece for your home or office.
            </p>
            <p>
                We know that buying furniture is an investment in your future. That's why we strive to offer innovative products that will last you through any size of changes. We also offer services like custom design options, installation assistance, and more!
            </p>
        </div>
        <div class="customizing-img">
            <img src="<?= ROOT ?>/assets/images/customer/about_us.jpg" alt="About Us">
        </div>
    </section>
    <section class="customize-designs-section">
        <div class="customizing-img">
            <img src="<?= ROOT ?>/assets/images/customer/making_furniture.jpeg" alt="crafting">
        </div>
        <div class="customizing-desc">
            <h2>Design your own furniture</h2>
            <p>Woodworks Furniture Store is the only place you need to go for all your woodworking needs.</p>
            <p>We love to design, and we know how important it is for you to have a space that's just right for you. That's why we work with you one-on-one to make sure your new furniture is exactly what you want, down to the last detail.</p>
            <button>Contact Designer Now!</button>
        </div>
    </section>

    <section class="why-choose">
        <div class="choose-heading">
            <h1>Why choose us?</h1>
        </div>
        <div class="choose-blocks">
            <div class="choose">
                <div class="choose-img">
                    <img src="<?= ROOT ?>/assets/images/customer/medal.png" alt="">
                </div>
                <div class="choose-des">
                    <h2>High Quality</h2>
                    <h3>Crafted from top materials</h3>
                </div>
            </div>
            <div class="choose">
                <div class="choose-img">
                    <img src="<?= ROOT ?>/assets/images/customer/shipped.png" alt="">
                </div>
                <div class="choose-des">
                    <h2>Free Shipping</h2>
                    <h3>Around colombo district</h3>
                </div>
            </div>
            <div class="choose">
                <div class="choose-img">
                    <img src="<?= ROOT ?>/assets/images/customer/warranty.png" alt="">
                </div>
                <div class="choose-des">
                    <h2>Warranty Protection</h2>
                    <h3>Over 2 years</h3>
                </div>
            </div>
            <div class="choose">
                <div class="choose-img">
                    <img src="<?= ROOT ?>/assets/images/customer/support.png" alt="">
                </div>
                <div class="choose-des">
                    <h2>24/7 Support</h2>
                    <h3>Dedicated support</h3>
                </div>
            </div>
        </div>
    </section>

    <?php $this->view('reg_customer/includes/footer'); ?>
</div>
<script type="text/javascript">
    function scrolltoId(){
var access = document.getElementById("aboutus");
access.scrollIntoView({behavior: 'smooth'}, true);
}
</script>