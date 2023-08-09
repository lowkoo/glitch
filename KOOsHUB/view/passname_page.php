<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="message_area">
    <?php 
    include('single_style.php');
        if(!empty($message)){
            echo '<h3>'.$message.'</h3>';
        }
    ?>
    </div>
    <div class="overall_passname_form">
        <form action="." method="post">
            <input type="hidden" name="action" value="passname">
            <label>Create Password:</label>
            <div class="password_visiblity">
                <input type="password" name="user_password" required>
                <img src="../svg/eye.svg" alt="" id="open-eye" ><img src="../svg/eye-off.svg" alt="" id="close-eye">
            </div>
            <br>
            <label>Confirm Password</label>
            <div class="password_visiblity">
                <input type="password" name="password_confirm" required>
                <img src="../svg/eye.svg" alt="" id="open-eye"><img src="../svg/eye-off.svg" alt="" id="close-eye">
            </div>            
            <!-- <br> -->
            <input type="submit" name="passname_btn" value="SUBMIT">
        </form>
    </div>
    <script src="../model/javascript/jquery-3.7.0.js"></script>
    <script src="../model/javascript/parsley.js"></script>
    <script src="../model/javascript/single.js" type="text/javascript"></script>
</body>
</html>