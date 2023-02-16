<?php $this->view('manager/includes/header') ?>


<body class="manager">
<?php $this->view('manager/includes/manager_header') ?>
    <div class="content manager-body">
    <div class="dashboard">
        
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
                                <button type="button" id="button"><img src="<?=ROOT?>/assets/images/manager/telegram-desktop-svgrepo-com.svg"></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



    </div>

</div>

<script src="<?=ROOT?>/assets/javascript/manager_chat.js"></script>