<?php $data['row'] = $row; $this->view('reg_customer/includes/header',$data); ?>

<div class="invoice-container">

    <div class="invoice">
        <div class="invoice-header">
            <h1>Payment Successful</h1>
            <h3>Customer : <?=$customer?></h3>
        </div>
        <div class="invoice-details">
            <div>
                <h4>Amount Paid</h4>
                <span>Rs <?=$order->Total_amount + $order->Shipping_cost - $order->Discount_obtained?>.00</span>
            </div>
            <div>
                <h4>Date Paid</h4>
                <span><?=$order->Date?></span>
            </div>
        </div>
        <div class="invoice-summary-container">
            <h3>Summary</h3>

            <div class="invoice-summary">
                <?php foreach($order_items as $item): ?>
                    <div class="invoice-detail item-list">
                        <span><?=$item->Name?> x <?=$item->Quantity?></span>
                        <span>Rs <?=$item->Cost?>.00</span>
                    </div>
                <?php endforeach; ?>

                <div class="invoice-detail">
                    <span>Subtotal</span>
                    <span>Rs <?=$order->Total_amount?>.00</span>
                </div>
                <div class="invoice-detail">
                    <span>Shipping (Normal home delivery)</span>
                    <span>Rs <?=$order->Shipping_cost?></span>
                </div>
                <div class="invoice-detail item-list">
                    <span>Discount Obtained</span>
                    <span>-Rs <?=$order->Discount_obtained?>.00</span>
                </div>
                <div class="invoice-detail">
                    <h4>Amount Charged</h4>
                    <span>Rs <?=$order->Total_amount + $order->Shipping_cost - $order->Discount_obtained?>.00</span>
                </div>
            </div>
        </div>

        <div class="download-btn">
            <button onclick="downloadInvoice('<?=$orderId?>','<?=$customer?>')">Download</button>
        </div>
    </div>

</div>

<script src="<?=ROOT?>/assets/javascript/invoice.js"></script>

<?php $this->view('reg_customer/includes/footer'); ?>