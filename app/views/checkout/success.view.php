<?php $data['row'] = $row; $this->view('reg_customer/includes/header',$data); ?>

<div class="invoice-container">

    <div class="invoice">
        <div class="invoice-header">
            <h1>Payment Successful</h1>
            <h3>Customer : Akila Santhush</h3>
        </div>
        <div class="invoice-details">
            <div>
                <h4>Amount Paid</h4>
                <span>Rs 49,407.00</span>
            </div>
            <div>
                <h4>Date Paid</h4>
                <span>2021-05-01</span>
            </div>
        </div>
        <div class="invoice-summary-container">
            <h3>Summary</h3>

            <div class="invoice-summary">
                <div class="invoice-detail item-list">
                    <span>Chorud Bed x 1</span>
                    <span>Rs 54,880.00</span>
                </div>
                <div class="invoice-detail">
                    <span>Subtotal</span>
                    <span>Rs 54,880.00</span>
                </div>
                <div class="invoice-detail">
                    <span>Shipping (Normal home delivery)</span>
                    <span>Rs 2,400.00</span>
                </div>
                <div class="invoice-detail item-list">
                    <span>Discount (10% off)</span>
                    <span>-Rs 5,488.00</span>
                </div>
                <div class="invoice-detail">
                    <h4>Amount Charged</h4>
                    <span>Rs 49,407.00</span>
                </div>
            </div>
        </div>

        <div class="download-btn">
            <button>Download</button>
        </div>
    </div>

</div>

<?php $this->view('reg_customer/includes/footer'); ?>