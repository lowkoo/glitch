<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// require('C:/xam/htdocs/KOOsHUB/vendor/autoload.php');
require('../vendor/phpmailer/phpmailer/src/Exception.php');
require('../vendor/phpmailer/phpmailer/src/PHPMailer.php');
require('../vendor/phpmailer/phpmailer/src/SMTP.php');

// ini_set("display_errors", "1");
// error_reporting(E_ALL);


require_once('../model/functions/database.php');
require_once('../model/functions/account_function.php');
require_once('../model/functions/post_function.php');
require_once('../model/functions/chat_msg_function.php');
session_start();


// $action = '';
// $message = '';
$logo = 'KOOsHUB';
$action = filter_input(INPUT_GET, 'action');
if($action == null){
    $action = filter_input(INPUT_POST, 'action');
    if($action == null){
    $action = 'home_page';
    }
}

switch($action){

    case 'signup':
        $user_firstname = filter_input(INPUT_POST, 'user_firstname');
        $user_lastname = filter_input(INPUT_POST, 'user_lastname');
        $user_email = filter_input(INPUT_POST, 'user_email', FILTER_VALIDATE_EMAIL);
        $submit = filter_input(INPUT_POST,'submit_btn');
            if($user_firstname == null || $user_lastname == null || $user_email == null){
                $message = 'Empty fields';
                include('signup_form.php');
                exit;
                }
                else{
                    $user_object = new user_info();
                    $user_object->set_user_email($user_email);
                    $user_data = $user_object->email_check_up();
                    if(is_array($user_data) && count($user_data) > 0){
                        $message = 'E-mail already exist';
                        include('signup_form.php');
                        exit;
                    }else{
                        $user_object->set_user_firstname($user_firstname);
                        $user_object->set_user_lastname($user_lastname);
                        $user_object->set_user_profile($user_object->create_profile_avatar(strtoupper($user_firstname[0].$user_lastname[0])));
                        $user_object->set_user_created_on(date('Y-m-d H:i:s'));
                        $user_object->set_user_login_status('not activated'); 
                        $user_object->set_user_status('not activated');                      
                        $num1 = rand(1, 9);
                        $num2 = rand(0, 9);
                        $num3 = rand(2, 9);
                        $num4 = rand(0, 9);
                        $num5 = rand(0, 9);
                        $num6 = rand(1, 9);
                        $num = $num1.$num2.$num3.$num4.$num5.$num6;
                        $user_object->set_user_verification_code($num);
                        if($user_object->inserting_into_database_info()){
                            $user_data = $user_object->email_check_up();
                            $_SESSION['info_id'] = $user_data['info_id'];
                            // header("location: .?action=passname");
                            $mail = new PHPMailer(true);
                            $mail->SMTPDebug = 1;
                            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                            $mail->isSMTP();
                            // $mail->Host = 'smtpout.secureserver.net';
                            $mail->Host = 'smtp.gmail.com';
                            $mail->SMTPAuth = true;
                            $mail->Username = 'odejinmilowkoo20@gmail.com';
                            $mail->Password = 'yjxliijyyhndpozl'; //swneqyjbgmgfvvmd yjxliijyyhndpozl
                            $mail->SMTPSecure = 'ssl';
                            // $mail->SMTPSecure = 'tls';
                            // $mail->mailer();
                            // $mail->SMTPSecure = 'PHPMailer::ENCRYPTION_STARTTLS';
                            $mail->Port = 465;
                            // $mail->Port = 587;
                            $mail->SMTPOption = array(
                                'ssl' => array(
                                    'verify_peer' => false,
                                    'verify_peer_name' => false,
                                    'allow_self_signed' => true
                                )
                                );                                
                            $mail->setFrom('koohub@gmail.com', 'KOOsHUB');
                            $mail->addAddress($user_object->get_user_email());
                            $mail->isHTML(true);
                            $mail->Subject = 'Verification Of Email For KOOsHUB';
                            $mail->Body = '<p> Hi <h4>'.$user_object->get_user_firstname().'</h4> Thank You For Registering for KOOsHUB</p>
                                            <p>This is a Verfication code for registration <h3 style=width:80px;padding:10px;background-color:blue;text-align:center;border-radius:5px;>'.$user_object->get_user_verification_code().'</h3> please enter this code on the next page of your signup process.';
                            $mail->AltBody = 'Verification code is'.$user_object->get_user_verification_code();
                            if($mail->send()){
                                $message = 'Verification Email sent to'.$user_object->get_user_email().'verify email before login';
                                header("location: .?action=email_verification");
                            }
                            else{
                                $message = 'invalid email address';
                                include('signup_form.php');
                                exit;
                                    }
                        }                             
                    }
                }

    break;

    case 'email_verification':
        $user_object = new user_info();
        $user_object->set_info_id($_SESSION['info_id']);
        $user_data = $user_object->check_verification_code();
        $code = filter_input(INPUT_POST, 'ver', FILTER_VALIDATE_INT);
        $message = 'Enter the code sent to email address';
            if($code != $user_data['user_verification_code']){
                $message = 'verification cannot proceed, Enter the code sent to email address';
                include('email_verification.php');
                exit;
            }else{
                header("location: .?action=passname");                
            }

    break;
    case 'passname':
        $user_password = filter_input(INPUT_POST, 'user_password');
        $user_confirm_password = filter_input(INPUT_POST, 'password_confirm');
        $passname_btn = filter_input(INPUT_POST, 'passname_btn');
            if($user_password == null || $user_confirm_password == null){
                $message = 'Empty fields';
                include('passname_page.php');
                exit;
            }else if($user_password != $user_confirm_password){
                $message = 'password does not match';
                include('passname_page.php');
                exit;
            }else{
                // if(isset($passname_btn)){
                    $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);
                    $user_object = new user_info;
                    $user_object->set_info_id($_SESSION['info_id']);
                    $user_data = $user_object->selecting_info_id();
                    $user_object->set_user_password($hashed_password);
                    // include('passname_page.php');
                    // exit;
                    // }
                    if($user_object->updating_password_field()){
                        $_SESSION['user'][$user_data['info_id']] = [
                            'id' => $user_data['info_id'],
                            'user_email' => $user_data['user_email'],
                            'user_profile' => $user_data['user_profile']
                        ];
                        header("location: .?action=home_page");
                        exit;
                    }else{
                        $message = 'cannot proceed';
                        include('passname_page.php');
                        exit;
                        // $file = fopen('message_file.php', 'a');
                        // $m = fwrite($file, $message);
                        // print_r($m);
                    }
            }

    break;

    case 'home_page':
        if(isset($_SESSION['info_id'])){
            $user_object = new user_info();
            $user_object->set_info_id($_SESSION['info_id']);
            $user_data = $user_object->selecting_info_id();
            $post_object = new post();
            $post_data = $post_object->selecting_all_user_post();            
            $_SESSION['user'] = $user_data['info_id']; 
            include("home_page.php");
            exit;
        }else{
            $post_object = new post();
            $post_data = $post_object->selecting_all_user_post();
            include('home_page.php');
            exit;
        }
    break;

    case 'profile':
        $info_id = $_SESSION['user'];
        $user_object = new user_info();
        $user_object->set_info_id($info_id);
        $user_data = $user_object->selecting_info_id();
        // $user_data['info_id'] = [
        //     'user_firstname' => $user_data['user_firstname'],
        //     'profile' => $user_data['user_profile'],
        //     'user_name' => $user_data['user_name'],
        //     'user_lastname' => $user_data['user_lastname']
        // ];
        $post_object = new post();
        $post_object->set_info_id($info_id);
        $post_data = $post_object->selecting_post_info_id();
        // $post_data['info_id'] = [
        //     'picture' => $post_data['post_picture'],
        //     'name' => $post_data['post_name'],
        //     'description' => $post_data['post_description'],
        //     'posted' => $post_data['date_created']
        // ];
        include("profile_page.php");
    break;

    case 'view_profile':

    break;

    case 'edit_profile':
        $info_id = $_SESSION['user'];
        $update_btn = filter_input(INPUT_POST, 'update');
        $username = filter_input(INPUT_POST, 'user_name');
        $user_object = new user_info();
        $user_object->set_info_id($info_id);
        $user_data = $user_object->selecting_info_id();  
        // include('update_profile.php');
        // exit;
        if($info_id == null || $username == null){
            $message = 'empty fields';
            include('update_profile.php');
            exit;
        }
        // header("location: update_profile.php");
        // if(isset($update_btn)){
            $file = $_FILES['p_pics'];
            $file_name = $file['name'];
            $temp_name = $file['tmp_name'];
            $p = explode('.', $file_name);
            $pi = end($p);
            $pic = strtoupper($pi);
            $pict = array('PNG', 'JPEG', 'JPG');
            $picture = in_array($pic, $pict); 
            if(isset($picture)){
                $desination = '../images/' . $file_name;
                $success = move_uploaded_file($temp_name, $desination);
                $user_object->set_info_id($info_id);
                $user_object->set_user_name($username);
                $user_object->set_user_profile($file_name);
                if($user_object->updating_user_data()){
                    header("location: .?action=home_page");
                }
            }else{
                $message = 'unsupported fíle format';
                include('update_profile.php');
                exit;
            }
            // include('update_profile.php');
        // }

        // header("location: update_profile.php");




    break;

    case 'post':
        $info_id = $_SESSION['user'];
        // $info_id = filter_input(INPUT_POST, 'info_id', FILTER_VALIDATE_INT);
        $post_btn = filter_input(INPUT_POST, 'post_btn');
        if(isset($post_btn)){
            $post_name = filter_input(INPUT_POST, 'post_name');
            $post_description = filter_input(INPUT_POST, 'post_description');
            $post = $_FILES['post_picture'];
            $pic_name = $post['name'];
            $pic_temp = $post['tmp_name'];
            $p = explode('.', $pic_name);
            $pi = end($p);
            $pic = strtoupper($pi);
            $pics = array('JPG', 'PNG', 'MOV');
            $pictu = in_array($pic, $pics);  
            if(!isset($pictu)){
                $message = '<h3>not supported file</h3>';
                include('post.php');
                exit;
            }
            else{
                $post_object = new post();
                $desination = '../post_images/' . $pic_name;
                $success = move_uploaded_file($pic_temp, $desination);
                $post_object->set_info_id($info_id);
                $post_object->set_post_name($post_name);
                $post_object->set_post_description($post_description);
                $post_object->set_post_picture($pic_name);
                $post_object->set_created_on(date('Y-m-d H:i:s'));
                $post_object->inserting_post();
                // $_SESSION['user'] = $_SESSION['info_id'];
                header("location: .?action=home_page");
                // include('home_page.php');
            }

        }else{
            $message = '<h3>empty fields</h3>';
            include('post.php');
            exit;
        }
        // }
    break;

    case 'login':
        $user_email = filter_input(INPUT_POST, 'user_email');
        $user_password = filter_input(INPUT_POST, 'user_password');
        if($user_email == null || $user_password == null){
            $message = 'empty field';
            include('login_page.php');
            exit;
        }else{
        $user_object = new user_info();
        $user_object->set_user_email($user_email);
        $user_data = $user_object->verifying_login_details();
        if(is_array($user_data) && count($user_data) > 0){
            $password_verify = password_verify($user_password, $user_data['user_password']);
            if($user_password == $password_verify){
                $user_object->set_info_id($user_data['info_id']);
                $user_object->set_user_login_status('logged in');
                if($user_object-> updating_login_status()){
                    $user_object->set_info_id($user_data['info_id']);
                    $user_data = $user_object->selecting_info_id();
                    $_SESSION['user'] = $user_data['info_id'];
                    
                    if(isset($_SESSION['user'])){
                        header("location: .?action=home_page");
                    }else{
                        include('login_page.php');
                    }
                }
            }else{
                $message = '<h4>Password does not match</h4>';
                include('login_page.php');
                exit;
            }
        }else{
            $message = '<h4>could not find account that matches with the username</h4>';
            include('login_page.php');
            exit;
        }
    }
        
    break;

    case 'message':
        $receiver_id = $_GET['info_id'];
        $_SESSION['info_id'] = $_GET['session'];
        $chat_object = new chat_info;
        $chat_object->set_info_id($_SESSION['info_id']);
        $chat_object->set_receiver_id($receiver_id);
        // $receiver_data = $chat_object->selecting_receiver_data();
        $chat_data = $chat_object->selecting_personal_chat();
        $user_object = new user_info;
        $user_object->set_info_id($receiver_id);
        $receiver_data = $user_object->selecting_info_id();
        // $info_id = $chat_data['info_id'];
        if($_SESSION['info_id'] == $_SESSION['user']){
            $from = 'me';
            $class = 'my-box-area';
            include('message.php');
            exit;
        }
        else{
            $from = $receiver_data['user_name'];
            $class = 'receiver_area';
            $message = 'you haven\'t chat with this user';
            include('message.php');
            exit;
        }
    break;

    case 'settings':
        $info_id = $_SESSION['user'];
        $user_object = new user_info;
        $user_object->set_info_id($_SESSION['user']);
        $user_data = $user_object->selecting_info_id();
        include('settings_page.php');

    break;

    case 'logout':
        $info_id = $_GET['info_id'];
        $user_object = new user_info();
        $user_object->set_info_id($info_id);
        $user_object->set_user_login_status('logged out');
        if($user_object->updating_login_status()){
            unset($_SESSION);
            session_destroy();
            $post_object = new post();
            $post_data = $post_object->selecting_all_user_post();
            include("home_page.php");
            exit;
        }
    break;
}