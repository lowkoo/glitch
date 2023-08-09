<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- <?php  
        include('header.php');
    ?> -->

    <?php if($_SESSION['user']){ ?>
        <img src="<?php echo '../images/' . $user_data['user_profile']; ?>" alt="profile_picture" width="100px">
        <div class="user_profile">
            <a href=".?action=edit_profile">Edit Profile</a>
            <h2><?php echo $user_data['user_name'] ?></h2>

        </div>

        <div class="user_posts">

            <h3><?php echo $post_data['post_name']; ?></h3>

        </div>


    <?php }else{ ?>


    <?php } ?>
    
</body>
</html>