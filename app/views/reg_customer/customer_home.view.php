<?php $data['row'] = $row; $this->view('reg_customer/includes/header',$data); ?>

<div>
    <section class="intro-section">
        <div class="intro-body">
            <div class="intro-headings">
                <h1>Create a home that defines who are you.</h1>
                <h2>Beauty, Smooth & Elegant</h2>
                <h3>Every home needs a cozy and warm atmosphere. Interior Design studio carefully considers every detail
                    and creates a functional and comfortable design of your dream house
                    where you want to come back after a long working day. Turn your room with panto into a lot
                    more minimalist and modern with ease and speed.</h3>
                <a href="<?=ROOT?>/category">
                    <button>Shop now</button>
                </a>
            </div>

        </div>
    </section>
    <section class="latest-section">
        <div class="latest-headings">
            <h1>Check out our latest products</h1>
        </div>
        <div class="latest-product-posts">
            <?php foreach($furnitures as $row): ?>
                <?php $data['row'] = $row; $this->view('reg_customer/includes/product_card',$data); ?>
            <?php endforeach; ?>
        </div>
    </section>
    <section class="customize-designs-section">
        <div class="customizing-img">
            <img src="<?=ROOT?>/assets/images/customer/making_furniture.jpeg" alt="crafting">
        </div>
        <div class="customizing-desc">
            <h2>Design your own furniture</h2>
            <p>Woodworks Furniture Store is the only place you need to go for all your woodworking needs.</p>
            <p>We love to design, and we know how important it is for you to have a space that's just right for you. That's why we work with you one-on-one to make sure your new furniture is exactly what you want, down to the last detail.</p>
            <button>Contact Designer Now!</button>
        </div>
    </section>
    <section class="customize-designs-section about">
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
            <img src="<?=ROOT?>/assets/images/customer/about_us.jpg" alt="About Us">
        </div>
    </section>
    <section class="why-choose">
        <div class="choose-heading">
            <h1>Why choose us?</h1>
        </div>
        <div class="choose-blocks">
            <div class="choose">
                <div class="choose-img">
                    <img src="<?=ROOT?>/assets/images/customer/medal.png" alt="">
                </div>
                <div class="choose-des">
                    <h2>High Quality</h2>
                    <h3>Crafted from top materials</h3>
                </div>
            </div>
            <div class="choose">
                <div class="choose-img">
                    <img src="<?=ROOT?>/assets/images/customer/shipped.png" alt="">
                </div>
                <div class="choose-des">
                    <h2>Free Shipping</h2>
                    <h3>Around colombo district</h3>
                </div>
            </div>
            <div class="choose">
                <div class="choose-img">
                    <img src="<?=ROOT?>/assets/images/customer/warranty.png" alt="">
                </div>
                <div class="choose-des">
                    <h2>Warranty Protection</h2>
                    <h3>Over 2 years</h3>
                </div>
            </div>
            <div class="choose">
                <div class="choose-img">
                    <img src="<?=ROOT?>/assets/images/customer/support.png" alt="">
                </div>
                <div class="choose-des">
                    <h2>24/7 Support</h2>
                    <h3>Dedicated support</h3>
                </div>
            </div>
        </div>
    </section>

    <div class="cus-chat" id = "cus-chat">
        <div class="chat-header">
            <span>Manager</span>
            <img src="<?=ROOT?>/assets/images/customer/minimize-svgrepo-com.svg" alt=" minimize" onclick="closeChat()">
        </div>
        <div class="cus-chat-section" id="chat-manager">

        </div>
        <div class="cus-send-msg-sec">
            <form id="chat-form-1">
                <input type="text" id="field" name="message" placeholder="Write Something">
                <button type="submit" id="button-manager"><img src="<?=ROOT?>/assets/images/manager/telegram-desktop-svgrepo-com.svg"></button>
            </form>

        </div>
    </div>

    <div class="cus-chat" id = "dis-chat">
        <div class="chat-header">
            <span>Designer</span>
            <img src="<?=ROOT?>/assets/images/customer/minimize-svgrepo-com.svg" alt=" minimize" onclick="closeChat()">
        </div>
        <div class="cus-chat-section" id="chat-designer">

        </div>
        <div class="cus-send-msg-sec">
            <form id="chat-form-2">
                <input type="text" id="message" name="message" placeholder="Write Something">
                <button type="button" id="button-designer"><img src="<?=ROOT?>/assets/images/manager/telegram-desktop-svgrepo-com.svg"></button>
            </form>
        </div>
    </div>


    <img class="chat-btn" id="chat-btn" src="<?=ROOT?>/assets/images/customer/chat-circle-svgrepo-com.svg" alt="" onclick="openChat()">

    <div class="manager-chat-selector" id="manager-chat-selector" onclick="openManagerChat()">
        <h3>Contact Woodworks</h3>
    </div>

    <div class="designer-chat-selector" id="designer-chat-selector" onclick="openDesignerChat()">
        <h3>Contact Designer</h3>
    </div>

    <script src="<?=ROOT?>/assets/javascript/customer_chat.js"></script>
</div>

<?php $this->view('reg_customer/includes/footer'); ?>

