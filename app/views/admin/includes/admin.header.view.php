    <div class="header">
        <img id="btn2" src="bars-solid.svg" style="width: 20px; margin:10px;" alt="">
        <img src="WOODWORKSmobile.svg" class="logomobile" alt="">
    </div>
    <div class="headerprime">
        <div class="profile" onclick="dropdown()">
            <img class="image" src="<?= ROOT ?>/<?= Auth::getImage() ?>" alt="">
            <div class="name-pos">
                <p class="name"><?= Auth::getFirstname() . " " . Auth::getLastname() ?></p>
                <span class="position"><?= Auth::getRole() ?></span>
            </div>

            <img class="carret" src="<?= ROOT ?>/assets/images/header/caret-down-solid.svg" alt="">
            <div class="" id="myDropdown">
                <li><a href="<?= ROOT ?>/logout">Logout</a></li>
            </div>
        </div>
       
    </div>
    <div class="sidebar">
        <div class="logo-content">
            <div class="logo">
                <img id="on" src="<?= ROOT ?>/assets/images/header/WOODWORKS.svg" alt="WOODWORKS">
                <img id="off" src="<?= ROOT ?>/assets/images/header/W.svg" alt="WOODWORKS">

            </div>
            <div id="btn" style="position: absolute; height: 30px; width: 30px; top: 35px; left: 100%; display: flex; justify-content: center; align-items: center; background-color: rgb(255, 255, 255); box-shadow: 0px 0px 10px #5050504d; border-radius: 100px;">
                <img style="width: 10px;" src="<?= ROOT ?>/assets/images/header/sidebar.svg" alt="">

            </div>

            <span class="title" style="display:block; margin-top: 100px; top: 10%;">Dashboard</span>


        </div>
        <ul>
            <li>
                <a href="<?= ROOT ?>/admin/dashboard">
                    <div class="icons"><img src="<?= ROOT ?>/assets/images/header/house-solid.svg" style="" alt="" srcset=""> </div><span class="link-name">
                        Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>

            <li>
                <a href="<?= ROOT ?>/admin/employees">
                    <div class="icons"><img src="<?= ROOT ?>/assets/images/header/person-solid.svg" style="" alt="" srcset=""> </div><span class="link-name">
                    Employees</span>
                </a>
                <span class="tooltip">Employees</span>
            </li>
            <li>
                <a href="<?= ROOT ?>/admin/furniture">
                    <div class="icons"><img src="<?= ROOT ?>/assets/images/header/chair-solid.svg" style="" alt="" srcset=""> </div><span class="link-name">
                        Furniture</span>
                </a>
                <span class="tooltip">Furniture</span>
            </li>
            <li>
                <a href="<?= ROOT ?>/admin/delivery">
                    <div class="icons"><img src="<?= ROOT ?>/assets/images/header/free_icon_1.svg" style="" alt="" srcset=""> </div><span class="link-name">
                        Deliveries</span>
                </a>
                <span class="tooltip">Deliveries</span>
            </li>

            <li>
                <a href="<?= ROOT ?>/admin/inventory">

                    <div class="icons"><img src="<?= ROOT ?>/assets/images/header/warehouse-solid.svg" style="" alt="" srcset=""> </div><span class="link-name">
                        Inventory</span>
                </a>
                <span class="tooltip">Inventory</span>
            </li>
            <li>
                <a href="<?= ROOT ?>/admin/suppliers">

                    <div class="icons"><img src="<?= ROOT ?>/assets/images/header/boxes-packing-solid.svg" style="" alt="" srcset=""> </div><span class="link-name">
                        Suppliers</span>
                </a>
                <span class="tooltip">Suppliers</span>
            </li>
            <li>
                <a href="<?= ROOT ?>/admin/categories">

                    <div class="icons"><img src="<?= ROOT ?>/assets/images/header/category-variety-random-shuffle-svgrepo-com.svg" style="" alt="" srcset=""> </div><span class="link-name">
                        Product Categories</span>
                </a>
                <span class="tooltip">Categories</span>
            </li>
            <li>
                <a href="<?= ROOT ?>/admin/profile">

                    <div class="icons"><img src="<?= ROOT ?>/assets/images/header/user-solid.svg" style="" alt="" srcset=""> </div><span class="link-name">
                        Edit Profile</span>
                </a>
                <span class="tooltip">Edit Profile</span>
            </li>

        </ul>
    </div>
    <script src="<?= ROOT ?>/assets/javascript/header/header.js"></script>