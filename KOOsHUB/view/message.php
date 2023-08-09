<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="times"><a href=".?action=home_page">&times;</a></div>
    <div class="overall_message_page">
        <div class="message_header">
            <div class="profile_picture"><a href=".?action=profile"><img src="<?php echo '../images/' . $receiver_data['user_profile'] ?>" alt="profile-picture"></a>
            <h3 class="profile_name"><?php if(isset($receiver_data['user_name'])){echo $receiver_data['user_name'];}else{echo $receiver_data['user_firstname'];} ?></h3></div>
        </div>
        <?php  
        include('single_style.php');
            if(!empty($message)){
                echo $message;
            }
        ?>
        <div id="message_area">
            <?php foreach($chat_data as $chat_data): ?>
                <div class="<?php echo $class ?>">
                    <b><?php echo $from ?></b><?php echo $chat_data['msg'] ?><br><small><i><?php echo $chat_data['sent_on'] ?></i></small>
                    
                </div>
            <?php endforeach; ?>
            
        </div>
        <div class="chat_area">
            <form action="." method="post" id="chat_form" enctype="multipart/form-data"  data-parsley-errors-container="error_validation">
                <input type="hidden" name="receiver_id" id="receiver_id" value="<?php echo $receiver_id ?>">
                <input type="hidden" name="info_id" id="info_id" value="<?php echo $_SESSION['info_id'] ?>">
                <textarea name="chat_box" id="chat_box" cols="50" rows="2" placeholder="Enter Message"></textarea>
                <input type="file" name="file">
                <button type="submit" name="chat_btn" id="chat_btn"><img src="../svg/send.svg" alt=""></button>
            </form>
            <div id="error_validation"></div>
        </div>
    </div>
    <script src="../model/javascript/jquery-3.7.0.js"></script>
    <script src="../model/javascript/parsley.js"></script>
    <script src="../model/javascript/chat.js" type="text/javascript"></script>
</body>
</html>