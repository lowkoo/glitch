<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- <div class="menu"><button><img src="../svg/menu.svg" alt=""></button></div> -->
    <div class="header_wrapper" id="header">
        <?php 
            include('header.php'); 
        ?>
    </div>
    <div class="homepage_overall_wrapper" id="homepage_overall_wrapper">
        <div class="settings_overall_wrapper">
            <?php
                include('settings_page.php');
                
            ?>
        </div>
        <!-- <div class="container">
            <div class="ring"></div>
            <div class="ring"></div>
            <div class="ring"></div>

        </div> -->
        <div class="homepage_profile_wrapper">
            <?php foreach($post_data as $key => $value): if(isset($_SESSION['user'])){ ?>
                
                <div class="homepage_inner_wrapper">
                    <div class="homepage_profile profile_picture"><picture><a href=".?action=profile&info_id=<?php echo $value['info_id']; ?>"><img src="<?php echo '../images/' . $value['user_profile']; ?>" id="profile_picture" alt="profile_picture"><h3 class="profile_name"><?php echo $value['user_firstname'] ?></h3></a></picture></div>
                    <!-- <div class="profile"><h4 class="profile_name"><?php echo $value['user_firstname']; ?></h4></div> -->
                    <div class="homepage_profile"><a href=".?action=message&info_id=<?php echo $value['info_id']; ?>&session=<?php echo $_SESSION['user']; ?>" class="message_link">Message</a></li></div>
                    <div class="homepage_profile homepage_post_picture_wrapper"><img src="<?php echo '../post_images/'.$value['post_picture']; ?>" alt="<?php echo $value['post_name'] ?>" onclick="fullscreen(this.src)"></div>
                    <div class="homepage_profile"><h4 class="paragraph"><b class="title"><?php echo $value['post_name'] ?></b><br><?php echo $value['post_description']; ?></h4></div>
                    <div class="homepage_profile" ><small><?php echo $value['date_created']; ?></small></div>
                </div>
                <div id="full_image">
                    <span id="close_btn" onclick="close_fullscreen()">&times;</span>
                    <img id="fullimage">
                </div>
            <?php }else{ ?>
                <div class="homepage_inner_wrapper_2">
                    <div class="homepage_profile_2 homepage_post_picture_wrapper"><img src="<?php echo '../post_images/'.$value['post_picture']; ?>" alt="<?php echo $value['post_name'] ?>"></div>
                    <div class="homepage_profile_2" ><h4 class="paragraph"><b class="title"><?php echo $value['post_name']; ?></b><br><?php echo $value['post_description']; ?></h4></div><br>
                    <div class="homepage_profile_2" ><small><?php echo $value['date_created']; ?></small></div>
                </div>
                
            <?php } endforeach;?>
        </div>
        <div class="chatted_user">
            <?php if(isset($_SESSION['user'])){include('chatted_users.php');} ?>
        </div>
    </div>
    <script src="../model/javascript/jquery-3.7.0.js"></script>
    <script src="../model/javascript/parsley.js"></script>
    <script src="../model/javascript/homepage.js" ></script>
</body>
</html>