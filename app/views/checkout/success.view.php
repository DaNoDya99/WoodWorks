<?php $data['row'] = $row; $this->view('reg_customer/includes/header',$data); ?>

<div>
    <h1>Success</h1>
    <h2><?= $customer ?></h2>
</div>

<?php $this->view('reg_customer/includes/footer'); ?>