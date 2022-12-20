<nav>
    <img class="logo" src="<?= ROOT ?>/assets/images/supplier/WOODWORKS.svg" alt="">
    <ul>
        <li>
            <a href="javascript:delay('<?= ROOT ?>/cashier')">

                <div onclick="timedelexit()">
                    New Bill
                </div>
            </a>
        </li>
        <li>
            <a href="javascript:delay('<?= ROOT ?>/cashier/billing')">
                <div onclick="timedelexit()">
                    Order History </div>
            </a>
        </li>
        <li>
        <!-- <li>
            <a href="javascript:delay('<?= ROOT ?>/cashier/inventory')">
                <div onclick="timedelexit()">
                    Inventory </div>
            </a>
        </li> -->
        <li>
            <a href="javascript:delay('<?= ROOT ?>/cashier/profile')">
                <div onclick="timedelexit()">
                    View Profile
                </div>
            </a>
        </li>
    </ul>

</nav>
<script>
    function delay(URL) {
        setTimeout(function() {
            window.location = URL
        }, 100);
    }
</script>