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
                echo '<h4>'. $message .'</h4>';
            }
        ?>
    </div>
    <div class="signup_overall_wrapper">
    <form action="." method="post">
        <input type="hidden" name="action" value="signup">
        <label>Enter Your First Name</label>
        <input type="text" name="user_firstname" id="user_firstname"><br>
        <label>Enter Your Last Name</label>
        <input type="text" name="user_lastname" id="user_lastname"><br>
        <label>Enter E-Mail Address</label>
        <input type="email" name="user_email" id="user_email"><br>
        <input type="submit" name="passname_btn" value="SignUp" id="submit_btn">
        <p class="paragraph">Already have an account?<a href=".?action=login">Login</a></p>
    </form>
    </div>
</body>
</html>