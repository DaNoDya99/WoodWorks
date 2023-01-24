<?php

class Message extends Controller
{
    public function sendMsg()
    {
        $receiver = 'ch001';

        if(isset($_POST['message']))
        {
            $_POST['sender'] = 'ch002';
            $_POST['receiver'] = $receiver;

            $Message = new Messages();
            $Message->insert($_POST);
        }
    }

    public function sendMsg2()
    {
        $receiver = 'ch002';

        if(isset($_POST['message']))
        {
            $_POST['sender'] = 'ch001';
            $_POST['receiver'] = $receiver;

            $Message = new Messages();
            $Message->insert($_POST);
        }
    }



    public function getMessages()
    {
        $Message = new Messages();
        $msgs = $Message->getMessages('ch001','ch002');

        $str = "";

        if(!empty($msgs)){
            foreach ($msgs as $msg)
            {
                if($msg->sender == 'ch002')
                {
                    $str = $str."<div  class='cus-sending'><p>".$msg->message."</p></div>";
                }else{
                    $str = $str."<div  class='cus-incoming'><p>".$msg->message."</p></div>";
                }
            }
        }

        echo $str;
    }

    public function getManagerChats()
    {
        $Message = new Messages();
        $chats = $Message->getManagerChats();
        $str = "";

        if(!empty($chats))
        {
            foreach ($chats as $chat){
                $chat->image = $Message->getChatUserImage($chat->CustomerID)[0]->Image;
            }

            foreach ($chats as $chat)
            {
                $str = $str."<div class='contact' id='chat' onclick='load_messages()'>
                            <img src='http://localhost/WoodWorks/public/".$chat->image."'>
                            <div class='contact-latest'>
                                <div>
                                    <h3>".$chat->username."</h3>
                                    <h3>10.00 A.M</h3>
                                </div>
                                <div>
                                    <p>Hello, how are you.</p>
                                    <span>1</span>
                                </div>
                            </div>
                        </div>";
            }
        }

        echo $str;
    }

    public function getMessages2()
    {
        $Message = new Messages();
        $msgs = $Message->getMessages('ch001','ch002');

        $str = "";

        if(!empty($msgs))
        {
            foreach ($msgs as $msg)
            {
                if($msg->sender == 'ch001')
                {
                    $str = $str."<div  class='sending'><p>".$msg->message."</p></div>";
                }else{
                    $str = $str."<div  class='incoming'><p>".$msg->message."</p></div>";
                }
            }
        }


        echo $str;
    }
}