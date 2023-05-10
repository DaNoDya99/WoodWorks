<?php $this->view('manager/includes/header') ?>

<body class="manager">
    <?php $this->view('manager/includes/manager_header') ?>
    <div class="content manager-body ">
        <div class="dashboard">
            
            <div>
                <div class="review-container">
                    <div class="review-header">
                        <h1><?= $name[0]->Name ?></h1>
                        <img src="<?= ROOT ?>/<?= $image[0]->Image ?>" alt="Product Image">
                    </div>
                    <div class="reviews">
                        <?php if (!empty($furniture)) : ?>
                            <?php foreach ($furniture as $row) : ?>
                                <div class="review">
                                    <div>
                                        <div class="rate">
                                            <span style="font-size: 2rem"><?= $row->Rating ?></span>
                                            <div>
                                                <div class="stars-outer product-card-stars-outer">
                                                    <div class="stars-inner" style="width: <?= (($row->Rating/5)*100).'%' ?>"></div>
                                                </div>
                                                <span class="number-rating"></span>
                                            </div>
                                        </div>
                                        <h2><?= $row->Date ?></h2>
                                    </div>
                                    <p><?= $row->Reviews ?></p>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div class="review-err">
                                <h1>No Reviews Yet!</h1>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://kit.fontawesome.com/acc5a4f516.js" crossorigin="anonymous"></script>
</html>