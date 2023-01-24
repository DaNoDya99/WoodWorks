<?php

class Messages extends Model
{
    public $errors = [];
    protected $table = "messages";

    protected $allowedColumns = [
        'messageID',
        'sender',
        'receiver',
        'message',
        'date',
        'seen'
    ];

    protected $beforeInsert = [
        'make_msg_id'
    ];

    public function make_msg_id($DATA){

        $messageID = $this->random_string(60);
        $result = $this->where('messageID',$messageID);
        while ($result){
            $result = $this->where('messageID',$messageID);
            $messageID = $this->random_string(60);
        }

        $DATA['messageID'] = $messageID;

        return $DATA;
    }

    public function random_string($length){
        $array = array(0,1,2,3,4,5,6,7,8,9,'A','B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
        $text = "";
        for($x=0;$x<$length;$x++)
        {
            $random = rand(0,61);
            $text .= $array[$random];
        }

        return $text;
    }

    public function getMessages($sender,$receiver)
    {
        $query = "SELECT `messageID`, `sender`, `receiver`, `message`, `date`, `seen` FROM `messages` WHERE (sender= :sender AND receiver= :receiver) OR (sender= :receiver AND receiver= :sender) ORDER BY date; ";

        return $this->query($query,['sender' => $sender, 'receiver' => $receiver]);
    }

    public function getManagerChats()
    {
        $query = "SELECT DISTINCT messages.sender, messages.receiver, chats.username,chats.CustomerID FROM `messages` INNER JOIN `chats` ON messages.sender = chats.chatID WHERE messages.receiver = :receiver; ";

        return $this->query($query,['receiver' => 'ch001']);
    }

    public function getChatUserImage($id)
    {
        $query = "SELECT Image from customer where CustomerID = :id;";

        return $this->query($query,['id' => $id]);
    }

    public function getLatestMsg($sender, $receiver)
    {
        $query = "SELECT `message`, `date` FROM `messages` WHERE (sender = :sender AND receiver = :receiver) OR (sender = :receiver AND receiver = :sender) ORDER BY date DESC LIMIT 1; ";

        return $this->query($query,['sender' => $sender, 'receiver' => $receiver]);
    }
}