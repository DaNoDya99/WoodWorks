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
                        <input id="search" type="text" name="chat" placeholder="Search">
                        <button type="submit"><img src="<?=ROOT?>/assets/images/admin/search.png" alt="Search"></button>
                    </div>
                </form>

                <div class="contacts" id="contacts-1">

                </div>

                <div class="contacts" id="contacts-2">

                </div>

            </div>
            <div class="chat-contact">
                <div class="chat-messages">
                    <div class='chat-msg-header' id="header">
                        <span id="select-contact">Please select a contact.</span>
                    </div>
                    <div class='chat-msg-container' id="msgs">

                    </div>
                </div>
                <div class='send-msg'>
                    <form id='chat-manager-form'>
                        <div>
                            <input type='text' name="message" id="field" placeholder='Write Something'>
                            <button type='submit' id='button'><img src='http://localhost/WoodWorks/public/assets/images/manager/telegram-desktop-svgrepo-com.svg'></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



    </div>

</div>

<script src="<?=ROOT?>/assets/javascript/manager_chat.js"></script>