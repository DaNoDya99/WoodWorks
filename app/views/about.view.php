<?php

if(Auth::logged_in()){
    $data['row'] = $row;
    $this->view('reg_customer/includes/header', $data);
}else{
    $this->view('includes/header');
}

?>

<div class="home-container">
    <h1>About</h1>
    <div class="about-page">
        <div class="about-left">
            <p>Welcome to our furniture store! We provide high-quality furniture for homes and offices for over 5 years. Our team of expert suppliers and designers are dedicated to creating pieces that are not only beautiful, but also built to last.

            We believe that everyone should have access to stylish, well-made furniture that fits their needs and budget. That's why we offer a wide selection of pieces in a variety of styles and price ranges. Whether you're looking for a classic leather sofa, a rustic dining table, or a modern office desk, we have something for everyone.

            In addition to our in-store selection, we also offer online shopping and delivery services. We make it easy for you to find and purchase the perfect pieces for your home or office. Plus, with our customer-friendly return policy, you can shop with confidence knowing that you can return any item that doesn't meet your expectations.

            Thank you for considering us for your furniture needs. We look forward to helping you create the home or office of your dreams!</p>
        </div>
        <div class="about-right">
            <img src="<?=ROOT?>/assets/images/customer/abt-img-1.jpg" alt="">
            <img src="<?=ROOT?>/assets/images/customer/abt-img-3.jpg" alt="">
            <img src="<?=ROOT?>/assets/images/customer/abt-img-2.jpg" alt="">





        </div>
    </div>
</div>

<?php $this->view('reg_customer/includes/footer'); ?>