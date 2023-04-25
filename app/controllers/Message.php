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
                    $str = $str."<div  class='cus-sending'>
                                    <p>".$msg->message."</p>
                                    <p>".date("jS M Y H:i:s",strtotime($msg->date))."</p>
                                </div>";
                }else{
                    $str = $str."<div  class='cus-incoming'>
                                    <p>".$msg->message."</p>
                                    <p>".date("jS M Y H:i:s",strtotime($msg->date))."</p>
                                 </div>";
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
                $latest = $Message->getLatestMsg("ch002","ch001");

                $chat->image = $Message->getChatUserImage($chat->CustomerID)[0]->Image;
                $chat->latest = $latest[0]->message;

                $time = explode(' ',$latest[0]->date)[1];
                $time = explode(':',$time);

                if($time[0] > 12){
                    $chat->time = ($time[0] - 12).":".$time[1]." P.M";
                }elseif ($time[0] == 12){
                    $chat->time = "12:".$time[1]." P.M";
                }else{
                    $chat->time = $time[0].":".$time[1]." P.M";
                }
            }

            foreach ($chats as $chat)
            {
                $str = $str."<div class='contact' id='chat' onclick='load_messages()'>
                            <img src='http://localhost/WoodWorks/public/".$chat->image."'>
                            <div class='contact-latest'>
                                <div>
                                    <h3>".$chat->username."</h3>
                                    <h3>$chat->time</h3>
                                </div>
                                <div>
                                    <p>$chat->latest</p>
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
                    $str = $str."<div  class='sending'>
                                    <p>".$msg->message."</p>
                                    <p>".date("jS M Y H:i:s",strtotime($msg->date))."</p>
                                </div>";
                }else{
                    $str = $str."<div  class='incoming'>
                                    <p>".$msg->message."</p>
                                    <p>".date("jS M Y H:i:s",strtotime($msg->date))."</p>
                                 </div>";
                }
            }
        }


        echo $str;
    }
}