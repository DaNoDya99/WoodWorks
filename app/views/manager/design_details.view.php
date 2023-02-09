<?php $this->view('manager/includes/header') ?>

<body class="manager">
<?php $this->view('manager/includes/manager_header') ?>
    <div class="content manager-body ">
        <div class="design-details-container">
            <div class="design-image-slider">
                <img src="<?=ROOT?>/assets/images/customer/chair.jpg" alt="Design Image">
                <h2>1/3</h2>

                <a class="prev" onclick="plusSlides(-1)">&#10094</a>
                <a class="next" onclick="plusSlides(1)">&#10095</a>
            </div>
            <div class="design-details">
                <h1>Wooden Study Table</h1>
                <span>DES00027</span>
                <p>Flaunting the contemporary vibes with sleek designing, the Mcbeth dining table comes with four spacious storage drawers and an extra dose of elegance. To serve for many years, this dining table is crafted from Sheesham wood. The wooden grained patterns are making the table more attractive and beautiful, it is further available in different wooden finishes</p>
            
                <div class="designs-btn-container">
                    <button class="design-accept">Accept</button>
                    <button class="design-reject">Reject</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>