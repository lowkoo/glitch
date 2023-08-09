<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="profile_edit_overall_wrapper">
    <div class="message_area">
        <?php 
        include('single_style.php');
            if(isset($message)){
                echo '<h4>'. $message .'</h4>';
            }
        ?>
    </div>
        <form action="." method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="edit_profile">
            <a href=""><img src="<?php echo '../images' . $user_data['user_profile']; ?>" alt=""></a>
            <label>Update Profile Picture</label><input type="file" name="p_pics"><br>

            <label>Update Username: </label><input type="text" name="user_name" value="<?php echo $user_data['user_name'] ?>"><br>

            <input type="submit" name="update" value="UPDATE">
        </form>
    </div>
</body>
</html>