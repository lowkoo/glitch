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
        if(isset($message)){
            echo '<h4>'. $message .'</h4>';
        }
    ?>
    </div>

    <div class="overall_login_form">
        <form action="." method="post">
            <input type="hidden" name="action" value="login">
            <label>Enter Email Address</label>
            <input type="email" name="user_email" required><br>
            <label>Enter Password</label>
            <input type="password" name="user_password" required><br>
            <input type="submit" name="login_btn" value="Login" id="submit_btn">
            <p class="paragraph">New to <?php echo $logo; ?>? why don't you just <a href=".?action=signup">Sign up</a>. 🤷🏽‍♂️</p>
        </form>
    </div>
    <script src="../model/javascript/jquery-3.7.0.js"></script>
    <script src="../model/javascript/parsley.js"></script>
    <script src="../model/javascript/single.js" type="text/javascript"></script>
</body>
</body>
</html>