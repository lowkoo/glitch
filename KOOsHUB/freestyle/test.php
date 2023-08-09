<?php
// E:\>php -q E:\xampp\htdocs\
require('./model/account_function.php');
// $file = fopen('nil.php', 'w');
// $message = 'hello fam';
// $message2='hey';
// $g = fwrite($file, $message);
// print_r($message);
// $num1 = rand(1, 9);
// $num2 = rand(0, 9);
// $num3 = rand(2, 9);
// $num4 = rand(0, 9);
// $num5 = rand(0, 9);
// $num6 = rand(1, 9);
// $num = $num1.$num2.$num3.$num4.$num5.$num6;
// try{
//     generate_random_number();
//     // print_r($user_verification_code);
// }
// catch(Exception $e){
//     $message = $e;
// }
// header('content-type: images/jpg');C:\xam\htdocs\KOOsHUB\Pangolin-Regular.ttf
$imag = imagecreatetruecolor(244, 200);
$n = putenv('GDFONTPATH=' . realpath('.'));
$font = 'someFont';
// $font = dirname(__FILE__) . '\Pangolin-Regular.ttf';
$textcolor = imagecolorallocate($imag, 255, 2, 255);
$image = imagestring($imag, 1, 5, 5, 'Hello World', $textcolor);
echo $n;

// 090704
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<script>
    function get_random_number(){
        let num  = Math.floor(Math.random() * 3) + 320;
        return num;
    }
</script>
</body>
</html>