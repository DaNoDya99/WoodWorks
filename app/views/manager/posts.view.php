<?php $this->view('manager/includes/header') ?>

<body class="manager">
    <?php $this->view('manager/includes/manager_header') ?>
    <div class="content manager-body ">
        <div class="dashboard">
           
            <div class="posts">
                <h1 class="post-heading">Furniture Posts</h1>
                <div class="posts-table-container">
                    <table>
                        <tr>
                            <th>SKU</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th></th>
                        </tr>
                        <?php if (!empty($furniture)) : ?>
                            <?php foreach ($furniture as $row) : ?>
                                <tr>
                                    <td><?= $row->ProductID ?></td>
                                    <td><img src="<?= ROOT ?>/<?= $row->Image ?>" alt="Product Image"></td>
                                    <td><?= $row->Name ?></td>
                                    <td><?= $row->Quantity ?></td>
                                    <td>Rs <?= $row->Cost ?>.00</td>
                                    <td>
                                        <a href="<?= ROOT ?>/manager/change_visibility/<?= $row->ProductID ?>/<?= $row->Visibility ?>"><?= ($row->Visibility == 1) ? "Visible" : "Hidden"; ?></a>
                                        <a href="<?= ROOT ?>/manager/reviews/<?= $row->ProductID ?>">Reviews</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <h1>No posts to show.</h1>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="<?= ROOT ?>/assets/javascript/manager-profile.js"></script>

</html>