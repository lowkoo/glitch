<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creation Of Post</title>
</head>
<body>
<div class="times"><a href=".?action=home_page">&times;</a></div>
<div class="message_area">
    <?php 
    include('single_style.php');
        if(isset($message)){
            echo '<h4 id="error_message">'. $message .'</h4>';
        }
    ?>
    </div>

    <div class="camera_overall_wrapper">
        <div id="video_wrapper"><video id="video"></video></div>
        <div id="canvas_wrapper"><button id="canvas"></button></div>
    </div>

    <div class="post_overall_wrapper">
        
        <form action="." method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="post">
            <!-- <input type="text" name="info_id" value="<?php //echo $_SESSION['user']; ?>"> -->
            <label>Enter Post Name:</label>
            <input type="text" name="post_name" id="post_name"><br>
            <label>Enter Post Description:</label>
            <input type="text" name="post_description" id="post_description"><br>
            <label for="upload_file">Select A picture</label>
            <input type="file" name="post_picture" id="upload_file"> <br>
            <input type="submit" name="post_btn" value="POST" id="submit_btn">
        </form>
    </div>
    <script src="../model/javascript/jquery-3.7.0.js"></script>
    <script src="../model/javascript/parsley.js"></script>
    <script src="../model/javascript/post.js" type="text/javascript"></script>
</body>
</html>