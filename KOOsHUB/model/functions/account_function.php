<?php

class user_info{
    private $info_id;
    private $user_firstname;
    private $user_lastname;
    private $user_email;
    private $user_password;
    private $user_name;
    private $user_status;
    private $user_profile;
    private $user_created_on;
    private $user_login_status;
    private $user_verification_code;
    public $connection;

    function __construct(){
        require_once('database.php');
        $database_connection = new database_connection();
        $this->connection = $database_connection->connection();
    }

    function set_info_id($info_id){
        $this->info_id = $info_id;
    }
    function get_info_id(){
        return $this->info_id;
    }

    function set_user_firstname($user_firstname){
        $this->user_firstname = $user_firstname;
    }
    function get_user_firstname(){
        return $this->user_firstname;
    }

    function set_user_lastname($user_lastname){
        $this->user_lastname = $user_lastname;
    }
    function get_user_lastname(){
        return $this->user_lastname;
    }

    function set_user_email($user_email){
        $this->user_email = $user_email;
    }
    function get_user_email(){
        return $this->user_email;
    }

    function set_user_password($user_password){
        $this->user_password = $user_password;
    }
    function get_user_password(){
        return $this->user_password;
    }

    function set_user_name($user_name){
        $this->user_name = $user_name;
    }
    function get_user_name(){
        return $this->user_name;
    }

    function set_user_profile($user_profile){
        $this->user_profile = $user_profile;
    }
    function get_user_profile(){
        return $this->user_profile;
    }

    function set_user_status($user_status){
        $this->user_status = $user_status;
    }
    function get_user_status(){
        return $this->user_status;
    }

    function set_user_created_on($user_created_on){
        $this->user_created_on = $user_created_on;
    }
    function get_user_created_on(){
        return $this->user_created_on;
    }

    function set_user_login_status($user_login_status){
        $this->user_login_status = $user_login_status;
    }
    function get_user_login_status(){
        return $this->user_login_status;
    }

    function set_user_verification_code($user_verification_code){
        $this->user_verification_code = $user_verification_code;
    }
    function get_user_verification_code(){
        return $this->user_verification_code;
    }

    function email_check_up(){
        $query = 'SELECT * FROM user_information WHERE user_email = :user_email';
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':user_email', $this->user_email);
        if($statement->execute()){
            $user_data = $statement->fetch(PDO::FETCH_ASSOC);
        }
        return $user_data;
    }

    function selecting_info_id(){
        $query = 'SELECT * FROM user_information WHERE info_id = :info_id';
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':info_id', $this->info_id);
        if($statement->execute()){
            $user_data = $statement->fetch(PDO::FETCH_ASSOC);
        }
        return $user_data;
    }

    function create_profile_avatar($avatar){
        $path = '../images/' . time() . '.png';
        $image = imagecreate(200, 200);
        $red = rand(0, 255);
        $green = rand(0, 255);
        $blue = rand(0, 255);
        imagecolorallocate($image, $red, $green, $blue);
        $textcolor = imagecolorallocate($image, 255, 255, 255);
        $font = '..\font\AlexBrush-Regular.ttf';
        // putenv('GDFONTPATH=' . realpath('.'));
        // $font = 'someFont';
        imagettftext($image, 60, 0, 25, 130, $textcolor, $font, $avatar);
        imagepng($image, $path);
        imagedestroy($image);
        return $path;

    }
    
    function inserting_into_database_info(){
        $query = 'INSERT INTO user_information(user_firstname, user_lastname, user_email, user_profile, user_created_on, user_verification_code, user_login_status, user_status)
                VALUES(:user_firstname, :user_lastname, :user_email, :user_profile, :user_created_on, :user_verification_code, :user_login_status, :user_status)';
        $statement = $this->connection->prepare($query); 
        $statement->bindParam(':user_firstname', $this->user_firstname);       
        $statement->bindParam(':user_lastname', $this->user_lastname);       
        $statement->bindParam(':user_email', $this->user_email); 
        // $statement->bindParam(':user_password', $this->user_password);       
        $statement->bindParam(':user_profile', $this->user_profile);
        $statement->bindParam(':user_created_on', $this->user_created_on);
        $statement->bindParam(':user_verification_code', $this->user_verification_code);
        $statement->bindParam(':user_login_status', $this->user_login_status);
        $statement->bindParam(':user_status', $this->user_status);
        if($statement->execute()){
            return true;
        }else{
            return false;
        }

    }

    function updating_user_verification_code(){
        $query = 'UPDATE user_information SET user_verification_code = :user_verification_code
                WHERE info_id = :info_id';
        $statement = $this->connection->prepare();
        $statement->bindParam(':user_verification_code', $this->user_verification_code);
        $statement->bindParam(':info_id', $this->info_id);
        if($statement->execute()){
            return true;
        }else{
            return false;
        }
    }

    function updating_user_data(){
        $query = 'UPDATE user_information SET user_name = :user_name, user_profile = :user_profile
                WHERE info_id = :info_id';
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':info_id', $this->info_id);
        $statement->bindParam(':user_name', $this->user_name);
        $statement->bindParam(':user_profile', $this->user_profile);
        if($statement->execute()){
            return true;
        }else{
            return false;
        }
    }

    function updating_user_profile(){
        $query = 'UPDATE user_information SET user_profile = :user_profile
                WHERE info_id = :info_id';
        $statement = $this->connection->prepare();
        $statement->bindParam(':user_profile', $this->user_profile);
        $statement->bindParam(':info_id', $this->info_id);
        if($statement->execute()){
            return true;
        }else{
            return false;
        }
    }

    function check_verification_code(){
        $query = 'SELECT * FROM user_information 
                WHERE info_id = :info_id ORDER BY user_verification_code ASC';
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':info_id', $this->info_id);
        if($statement->execute()){
            $user_data = $statement->fetch(PDO::FETCH_ASSOC);
        }
        return $user_data; 
    }

    function updating_password_field(){
        $query = 'UPDATE user_information SET user_password = :user_password
                    WHERE info_id = :info_id';
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':user_password', $this->user_password);
        $statement->bindParam(':info_id', $this->info_id);
        if($statement->execute()){
            return true;
        }else{
            return false;
        }
    }
 
    function verifying_login_details(){
        $query = 'SELECT * FROM user_information WHERE user_email = :user_email OR user_name = :user_email';
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':user_email', $this->user_email);
        if($statement->execute()){
            $user_data = $statement->fetch(PDO::FETCH_ASSOC);
        }
        return $user_data;
    }

    function updating_login_status(){
        $query = 'UPDATE user_information SET user_login_status
                = :user_login_status WHERE info_id = :info_id';
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':user_login_status', $this->user_login_status);
        $statement->bindParam(':info_id', $this->info_id);
        if($statement->execute()){
            return true;
        }else{
            return false;
        }
    }
}