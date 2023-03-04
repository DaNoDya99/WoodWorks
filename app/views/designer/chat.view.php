<?php $this->view('designer/includes/header') ?>

<body class="designer">
<?php $this->view('designer/includes/designer_header') ?>
<div class="content designer-body">
    <div class="dashboard">

        <div class="chat">
            <div class="chats">
                <div class="chat-owner-details">
                    <img src='<?=ROOT?>/assets/images/designer/Nisura.png'>
                    <div>
                        <h2>Nisura Indisa</h2>
                        <h3>Designer</h3>
                    </div>
                </div>
                <form>
                    <div class="chats-search">
                        <input type="text" id="search" name="chat" placeholder="Search">
                        <button type="submit"><img src="<?=ROOT?>/assets/images/designer/search.png" alt="Search"></button>
                    </div>
                </form>
                <div class="contacts" id="contacts-1">

                </div>
                <div class="contacts" id="contacts-2">

                </div>
            </div>
            <div class="chat-contact">
                <div class="chat-messages">
                    <div class="chat-msg-header" id="header">
                        <span id="select-contact">Please select a contact.</span>
                    </div>
                    <div class="chat-msg-container" id="msgs">

                    </div>
                </div>
                <div class="send-msg">
                    <form id='chat-designer-form'>
                        <div>
                            <input type="text" id="message" placeholder="Write Something">
                            <button type="button" id="button"><img src="<?=ROOT?>/assets/images/designer/telegram-desktop-svgrepo-com.svg"></button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<script src="<?=ROOT?>/assets/javascript/designer_chat.js"></script>