<?php  

namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

require('database.php');
require('account_function.php');
require('chat_msg_function.php');

class Chat implements MessageComponentInterface{
    protected $clients;
    public $message;

    public function __construct(){
        $this->clients = new \SplObjectStorage;
        $message = 'server started';
        // include('../view/message.php');
 
    }

    public function onOpen(ConnectionInterface $conn){
        // $message = 'server started';
        // include('../view/message.php');
 
        $this->clients->attach($conn);

        echo "New Connection! ({$conn->resourceId})\n";
    }
    // C://xam/htdocs/KOOsHUB/model/bin/chat-server.php
    public function onMessage(ConnectionInterface $from, $msg){
        $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n", $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');
        if(sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n", $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's')){
            $data = json_decode($msg, true);
            $chat_object = new \chat_info;
            $chat_object->set_info_id($data['info_id']);
            $chat_object->set_receiver_id($data['receiver_id']);
            $chat_object->set_msg($data['msg']);
            $chat_object->set_sent_on(date('Y-m-d H:i:s'));
            $chat_object->save_chat();
            // if($chat_object->save_chat()){
            //     $chat_data = $chat_object->selecting_receiver_data();
            //     $user_name = $chat_data['user_firstname'];
            //     $data['date'] = date('d-m-Y h:i:s');
            // }
           
        }


        // $user_object = new \user_info();
        // $user_object->set_info_id($data['receiver_id']);
        // $user_data = $user_object->selecting_info_id();

        foreach($this->clients as $user){
            if($from == $user){
                $data['from'] = 'me';
            }else{
                $data['from'] = $user_name;
            }
            $user->send(json_encode($data));
        }
    }

    public function onClose(ConnectionInterface $conn){
        $this->clients->detach($conn);
        $message = "connection {$conn->resourceId} has disconnected\n";
        // include('../view/message.php');
 
    }

    public function onError(ConnectionInterface $conn, \Exception $e){
        $message = "An error has occured: on line {$e->getLine()} code: {$e->getCode()} in file {$e->getFile()}, the message says: {$e->getMessage()}";
        // include('../view/message.php');
        $conn->close();
    }
}