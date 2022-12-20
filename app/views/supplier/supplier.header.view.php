<div class="dashboard-nav">
        <div class="nav-item-page-name">
            <!-- <h1><?= $title ?></h1> -->
        </div>
        <div class="nav-item-user">

            <img src="<?= ROOT ?>/<?= Auth::getImage() ?>" alt="Profile picture">
            <div class="nav-vr"></div>
            <h1>Hi, <?= Auth::getFirstname() ?></h1>
            <div class="nav-vr"></div>
            <a href="<?= ROOT ?>/logout7">
                <h1>Logout</h1>
            </a>
        </div>
    </div>