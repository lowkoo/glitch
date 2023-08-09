<?php

class post{
    private $post_id;
    private $info_id;
    private $post_name;
    private $post_description;
    private $post_picture;
    private $created_on;
    public $connection;

    function __construct(){
        require_once('database.php');
        $d_connection = new database_connection;
        $this->connection = $d_connection->connection();
    }

    function set_post_id($post_id){
        $this->post_id = $post_id;
    }
    function get_post_id(){
        return $this->post_id;
    }

    function set_info_id($info_id){
        $this->info_id = $info_id;
    }
    function get_info_id(){
        return $this->info_id;
    }

    function set_post_name($post_name){
        $this->post_name = $post_name;
    }
    function get_post_name(){
        return $this->post_name;
    }

    function set_post_description($post_description){
        $this->post_description = $post_description;
    }
    function get_post_description(){
        return $this->post_description;
    }

    function set_post_picture($post_picture){
        $this->post_picture = $post_picture;
    }
    function get_post_picture(){
        return $this->post_picture;
    }

    function set_created_on($created_on){
        $this->created_on = $created_on;
    }
    function get_created_on(){
        return $this->created_on;
    }

    function inserting_post(){
        $query = 'INSERT INTO post (info_id, post_name, post_description, post_picture, date_created)
                VALUES(:info_id, :post_name, :post_description, :post_picture, :created_on)';
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':info_id', $this->info_id);
        $statement->bindParam(':post_name', $this->post_name);
        $statement->bindParam(':post_description', $this->post_description);
        $statement->bindParam(':post_picture', $this->post_picture);
        $statement->bindParam(':created_on', $this->created_on);
        if($statement->execute()){
            return true;
        }else{
            return false;
        }
    }

    function selecting_all_user_post(){
        $query = 'SELECT * FROM post INNER JOIN
                user_information ON user_information.info_id = post.info_id
                ORDER BY post.post_id DESC';
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function selecting_post_info_id(){
        $query = 'SELECT * FROM post WHERE info_id = :info_id';
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':info_id', $this->info_id);
        if($statement->execute()){
            $post_data = $statement->fetch(PDO::FETCH_ASSOC);
        }
        return $post_data;
    }  

    //   const :: {

    // }

}