<?php $this->view('manager/includes/header') ?>


<body class="manager">
<div class="manager-body">
    <?php $this->view('manager/includes/manager_sidebar') ?>
    <div class="dashboard">
        <div class="dashboard-nav">
            <div class="nav-item-page-name">
                <h1><?= $title ?></h1>
            </div>
            <div class="nav-item-user">
                <img src="<?=ROOT?>/assets/images/manager/user.png" alt="Profile picture">
                <div class="nav-vr"></div>
                <h1>Hi, <?=Auth::getFirstname()?></h1>
                <div class="nav-vr"></div>
                <a href="<?=ROOT?>/logout">
                    <h1>Logout</h1>
                </a>
            </div>
        </div>
        <div class="chat">
            <div class="chats">
                <div class="chat-owner-details">
                    <img src='<?=ROOT?>/assets/images/manager/viharsha.jpeg'>
                    <div>
                        <h2>Viharsha Jayathilake</h2>
                        <h3>Manager</h3>
                    </div>
                </div>
                <form>
                    <div class="chats-search">
                        <input type="text" name="chat" placeholder="Search">
                        <button type="submit"><img src="<?=ROOT?>/assets/images/admin/search.png" alt="Search"></button>
                    </div>
                </form>
                <div class="contacts" id="contacts">

                </div>
            </div>
            <div class="chat-contact">
                <div class="chat-messages">
                    <div class="chat-msg-header">
                        <img src="<?=ROOT?>/assets/images/manager/danodya.jpg">
                        <h2>Danodya Supun</h2>
                    </div>
                    <div id="msgs" class="chat-msg-container">

                    </div>
                    <div class="send-msg">
                        <form>
                            <div>
                                <input type="text" id="message" placeholder="Write Something">
                                <button type="button" id="btn"><img src="<?=ROOT?>/assets/images/manager/telegram-desktop-svgrepo-com.svg"></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



    </div>

</div>

<script src="<?=ROOT?>/assets/javascript/jQuery.js"></script>
<script src="<?=ROOT?>/assets/javascript/manager_chat.js"></script>