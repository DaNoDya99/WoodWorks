<?php

if(Auth::logged_in()){
    $data['row'] = $row;
    $this->view('reg_customer/includes/header', $data);
}else{
    $this->view('includes/header');
}

?>

<div class="home-container">
    <div class="contact">
        <h1>Contact Us</h1>
        <div class="contact-form">
            <form method="post">
                <div>
                    <label>Name</label>
                    <input type="text" name="Name" placeholder="Name">
                </div>
                <div>
                    <label>Email</label>
                    <input type="email" name="Email" placeholder="Email">
                </div>
                <div>
                    <label>Message</label>
                    <textarea name="Message" cols="30" rows="10" placeholder="Message"></textarea>
                </div>
                <button type="submit">Send Message</button>
            </form>

            <div class="location">
                <img src="<?=ROOT?>/assets/images/customer/location.png" alt="Location Image">

                <div>
                    <h1>Phone No: +94 77 123 1234</h1>
                </div>
                <div>
                    <h1>info@woodworks.lk</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->view('reg_customer/includes/footer'); ?>