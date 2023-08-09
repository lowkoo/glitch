<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        input[type="number"]::-webkit-inner-spin-button{
            display: none;

        }
        input[type=number]{
            -moz-appearance:textfield;
        }
    </style>
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
    <div class="overall_email_verification">
        <form action="." method="post">
            <label for="">Enter verification code</label>
            <input type="hidden" name="action" value="email_verification">
            <input type="number" name="ver" inputmode="numeric" data-parsley-maxlength="6">
            <input type="submit" value="NEXT">   
        </form>
    </div>
    <script src="../model/javascript/jquery-3.7.0.js"></script>
    <script src="../model/javascript/parsley.js"></script>    
</body>
</html>