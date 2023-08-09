<?php

    class chat_info{
        private $chat_id;
        private $info_id;
        private $receiver_id;
        private $msg;
        private $sent_on;
        public $connection;

        function __construct(){
            require_once('database.php');
            $data_connection = new database_connection();
            $this->connection = $data_connection->connection();
        }

        function set_chat_id($chat_id){
            $this->chat_id = $chat_id;
        }
        function get_chat_id(){
            return $this->chat_id;
        }

        function set_info_id($info_id){
            $this->info_id = $info_id;
        }
        function get_info_id(){
            return $this->info_id;
        }

        function set_receiver_id($receiver_id){
            $this->receiver_id = $receiver_id;
        }
        function get_receiver_id(){
            return $this->receiver_id;
        }

        function set_msg($msg){
            $this->msg = $msg;
        }
        function get_msg(){
            return $this->msg;
        }

        function set_sent_on($sent_on){
            $this->sent_on = $sent_on;        
        }
        function get_sent_on(){
            return $this->sent_on;
        }

        function save_chat(){
            $query = 'INSERT INTO chat_data(info_id, receiver_id, sent_on, msg)
                    VALUES(:info_id, :receiver_id, :sent_on, :msg)';
            $statement = $this->connection->prepare($query);
            $statement->bindParam(':info_id', $this->info_id);
            $statement->bindParam(':receiver_id', $this->receiver_id);
            $statement->bindParam(':sent_on', $this->sent_on);
            $statement->bindParam(':msg', $this->msg);
            if($statement->execute()){
                return true;
            }else{
                return false;
            }
        }

        function selecting_personal_chat(){
            $query = 'SELECT * FROM chat_data WHERE (receiver_id = :receiver_id AND info_id = :info_id)
                    OR (info_id = :receiver_id AND receiver_id = :info_id) ORDER BY chat_id DESC';
            $statement = $this->connection->prepare($query);
            $statement->bindParam(':info_id', $this->info_id);
            $statement->bindParam(':receiver_id', $this->receiver_id);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        function selecting_receiver_data(){
            $query = 'SELECT * FROM chat_data INNER JOIN user_information ON user_information.info_id 
                        = chat_data.info_id WHERE receiver_id = :receiver_id';
            $statement = $this->connection->prepare($query);
            $statement->bindParam(':receiver_id', $this->receiver_id);
            if($statement->execute()){
                $receiver_data = $statement->fetch(PDO::FETCH_ASSOC);
            }
            return $receiver_data;
        }

        // function selecting_chats(){
        //     $query = 'SELECT * FROM chat_data WHERE (receiver_id = :receiver_id AND info_id = :info_id)
        //             OR (info_id = :receiver_id AND receiver_id = :info_id)';
        //     $statement = $this->connection->prepare($query);
        //     $statement->bindParam(':receiver_id', $this->receiver_id);
        //     $statement->bindParam(':info_id', $this->info_id);
        //     if($statement->execute()){
        //         $receiver_data = $statement->fetch(PDO::FETCH_ASSOC);
        //     }
        //     return $receiver_data;
        // }
        
    } 


    