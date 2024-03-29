<?php
//Manager chat id = 3
//Designer chat id = 4

class Message extends Controller
{

    public function sendMsgToManager()
    {

        $_POST['receiver'] = 3;

        $Message = new Messages();
        $_POST['sender'] = $Message->getChatID(Auth::getCustomerID())[0]->chatID;

        $Message->insert($_POST);
    }

    public function sendMsgToDesigner()
    {

        $_POST['receiver'] = 4;

        $Message = new Messages();
        $_POST['sender'] = $Message->getChatID(Auth::getCustomerID())[0]->chatID;

        $Message->insert($_POST);

        echo $_POST['message'];
    }

    public function sendMsgsToCustomerByManager($id= null)
    {

        $Message = new Messages();
        $_POST['sender'] = 3;
        $_POST['receiver'] = $Message->getChatID($id)[0]->chatID;

        echo $id." ".$_POST['message'];

        $Message->insert($_POST);
    }

    public function sendMsgsToCustomerByDesigner($id= null)
    {

        $Message = new Messages();
        $_POST['sender'] = 4;
        $_POST['receiver'] = $Message->getChatID($id)[0]->chatID;

        echo $id." ".$_POST['message'];

        $Message->insert($_POST);
    }

    public function getCustomerMessages($id = null)
    {

        $Message = new Messages();
        $msgs = $Message->getMessages($id,$Message->getChatID(Auth::getCustomerID())[0]->chatID);

        $str = "";

        if(!empty($msgs))
        {
            foreach ($msgs as $msg)
            {
                if($msg->sender != $id)
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
               $latest = $Message->getLatestMessage($chat->chatID,3);

               $chat->image = $Message->getChatUserImage($chat->customerID)[0]->Image;
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
               $str = $str."<div class='contact' id='chat' cus_id=".$chat->customerID." onclick='load_messages(this.getAttribute(`cus_id`))'>
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

   public function getManagerMessages($id)
   {
         $Message = new Messages();
         $msgs = $Message->getMessages(3,$Message->getChatID($id)[0]->chatID);
         $chatDetails = $Message->getChatUserDetails($id)[0];

         $str = "";

         if(!empty($msgs)) {
             foreach ($msgs as $msg) {
                 if ($msg->sender == 3) {
                     $str = $str . "<div  class='sending'>
                                    <p>" . $msg->message . "</p>
                                    <p>" . date("jS M Y H:i:s", strtotime($msg->date)) . "</p>
                                </div>";
                 } else {
                     $str = $str . "<div  class='incoming'>
                                    <p>" . $msg->message . "</p>
                                    <p>" . date("jS M Y H:i:s", strtotime($msg->date)) . "</p>
                                 </div>";
                 }
             }
         }

         echo $str;
   }



    public function searchManagerChats()
    {

        $Message = new Messages();
        $chats = $Message-> searchChatUserByName($_POST['search']);
        $str = "";

        if(empty($chats))
        {
            $str = $str.'<h3>No Results Found</h3>';
        }else{
            foreach ($chats as $chat)
            {
                $str = $str."<div class='contact' id='chat' cus_id=".$chat->customerID." onclick='load_messages(this.getAttribute(`cus_id`))'>
                           <img src='http://localhost/WoodWorks/public/'>
                           <div class='contact-latest'>
                               <div>
                                   <h3>".$chat->username."</h3>
                                   <h3>12.00</h3>
                               </div>
                               <div>
                                   <p>hi</p>
                                   <span>1</span>
                               </div>
                           </div>
                       </div>";
            }
        }

        echo $str;
    }

    public function getManagerMessagesHeader($id)
    {
        $Message = new Messages();
        $chatDetails = $Message->getChatUserDetails($id)[0];

        $str = " <img src='http://localhost/WoodWorks/public/".$chatDetails->Image."'>
                 <h2>".$chatDetails->username."</h2>";

        echo $str;
    }

    /*Designer*/
    //Designer Chats
    public function getDesignerChats()
    {
        $Message = new Messages();
        $chats = $Message->getDesignerChats();
        $str = "";

        if(!empty($chats))
        {
            foreach ($chats as $chat){
                $latest = $Message->getLatestMessage($chat->chatID,4);

                $chat->image = $Message->getChatUserImage($chat->customerID)[0]->Image;
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
                $str = $str."<div class='contact' id='chat' cus_id=".$chat->customerID." onclick='load_messages(this.getAttribute(`cus_id`))'>
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

    //Designer Messages Header
    public function getDesignerMessagesHeader($id)
    {
        $Message = new Messages();
        $chatDetails = $Message->getChatUserDetails($id)[0];

        $str = " <img src='http://localhost/WoodWorks/public/".$chatDetails->Image."'>
                 <h2>".$chatDetails->username."</h2>";

        echo $str;
    }

    //Designer Search Chats
    public function searchDesignerChats()
    {

        $Message = new Messages();
        $chats = $Message-> searchChatUserByName($_POST['search']);
        $str = "";

        if(empty($chats))
        {
            $str = $str.'<h3>No Results Found</h3>';
        }else{
            foreach ($chats as $chat)
            {
                $str = $str."<div class='contact' id='chat' cus_id=".$chat->customerID." onclick='load_messages(this.getAttribute(`cus_id`))'>
                           <img src='http://localhost/WoodWorks/public/'>
                           <div class='contact-latest'>
                               <div>
                                   <h3>".$chat->username."</h3>
                                   <h3>12.00</h3>
                               </div>
                               <div>
                                   <p>hi</p>
                                   <span>1</span>
                               </div>
                           </div>
                       </div>";
            }
        }

        echo $str;
    }

    //Designer Messages
    public function getDesignerMessages($id)
    {
        $Message = new Messages();
        $msgs = $Message->getMessages(4,$Message->getChatID($id)[0]->chatID);
        $chatDetails = $Message->getChatUserDetails($id)[0];

        $str = "";

        if(!empty($msgs)) {
            foreach ($msgs as $msg) {
                if ($msg->sender == 4) {
                    $str = $str . "<div  class='sending'>
                                    <p>" . $msg->message . "</p>
                                    <p>" . date("jS M Y H:i:s", strtotime($msg->date)) . "</p>
                                </div>";
                } else {
                    $str = $str . "<div  class='incoming'>
                                    <p>" . $msg->message . "</p>
                                    <p>" . date("jS M Y H:i:s", strtotime($msg->date)) . "</p>
                                 </div>";
                }
            }
        }

        echo $str;
    }
}