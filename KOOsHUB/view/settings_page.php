<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include('single_style.php'); if(isset($_SESSION['user'])){?>

    <div class="overall_settings_page">
        <div class="profile_page">
            <div class="profile_picture"><a href=""><img src="<?php echo '../images/' . $user_data['user_profile']; ?>" alt="" width="50px"></a></div>
            <div><h4><?php echo $user_data['user_name']; ?> </h4></div>
        </div>
    </div>
    <?php } ?>
</body>
</html>