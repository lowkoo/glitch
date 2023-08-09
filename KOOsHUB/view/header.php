<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="../stylesheet/css-stylesheet/style.css">
</head>
<body>
  
    <div class="header_overall_wrapper" id="header_">
        <ul>
            <?php if(isset($_SESSION['user'])): ?>
                <li><a href=".?action=home_page">HOME</a></li>
            <?php endif; ?>

            <?php if(isset($_SESSION['user'])): ?>
                <li class="profile"><a href=".?action=profile">PROFILE</a>
                    <ul class="sub-profile">
                        <li><a href=".?action=view_profile">View Profile</a></li>
                        <li><a href=".?action=edit_profile">Edit Profile</a></li>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if(isset($_SESSION['user'])): ?>
                <li><a href=".?action=logout&info_id=<?php echo $_SESSION['user']; ?>">LOGOUT</a></li>
            <?php endif; ?>            

            <?php if(isset($_SESSION['user'])): ?>
                <li><a href=".?action=post">POST</a></li>
            <?php endif; ?>             

            <?php if(!isset($_SESSION['user'])): ?>
                <li><a href=".?action=login">SIGN IN</a></li>
            <?php endif; ?>

            <?php if(!isset($_SESSION['user'])): ?>
                <li><a href=".?action=signup">SIGN UP</a></li>
            <?php endif; ?>

        </ul>
    </div>
</body>
</html>
