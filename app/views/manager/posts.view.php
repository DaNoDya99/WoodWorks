<?php $this->view('manager/includes/header') ?>

<body class="manager">
    <?php $this->view('manager/includes/manager_header') ?>
    <div class="content manager-body ">
        <div class="dashboard">
           
            <div class="posts">
                <div class="posts-heading">
                    <h1 style="width: 20%" >Furniture Posts</h1>
                    <select name="" id="search-by-category">
                        <option value="All" selected>All</option>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category->CategoryID ?>"><?= $category->Category_name ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="text" placeholder="Search Furniture By ID" id="search-field">
                </div>

                <div class="posts-table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>SKU</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="t-body">
                            <?php if (!empty($furniture)) : ?>
                                <?php foreach ($furniture as $row) : ?>

                                    <tr>
                                        <td><?= $row->ProductID ?></td>
                                        <td><img src="<?= ROOT ?>/<?= $row->Image ?>" alt="Product Image"></td>
                                        <td><?= $row->Name ?></td>
                                        <td><?= $row->Quantity ?></td>
                                        <td>Rs <?= $row->Cost ?>.00</td>
                                        <td>
                                            <a style="text-decoration: none" href="<?= ROOT ?>/manager/change_visibility/<?= $row->ProductID ?>/<?= $row->Visibility ?>"><?= ($row->Visibility == 1) ? "Visible" : "Hidden"; ?></a>
                                            <a style="text-decoration: none" href="<?= ROOT ?>/manager/reviews/<?= $row->ProductID ?>">Reviews</a>
                                            <a>More</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <h1>No posts to show.</h1>
                            <?php endif; ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="<?= ROOT ?>/assets/javascript/manager_posts.js"></script>
<script src="<?= ROOT ?>/assets/javascript/manager-profile.js"></script>

</html>