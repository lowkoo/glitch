<?php

class database_connection{
    function connection(){
        $connection = new PDO('mysql:host=localhost;dbname=koohub', 'root', '');
        return $connection;
    }
}
    // private $username;
    // private $password;
    // private $db;
    // function set_db($db){
    //     $db = 'mysql:host=localhost;dbname=koohub';
    //     $this->db = $db;
    // }
    // function set_username($username){
    //     $username = 'root';
    //     $this->username = $username;
    // }
    // function set_password($password){
    //     $password = '';
    //     $this->password = $password;
    // }
// define('lekan', 12*4);
// echo 'lekan';
// function create_profile_avatar($avatar){
    // header('content-type: image/jpg');
    // $character = 'L';
    // $path = '../images/' . time() . 'png';
    // $imag = imagecreatetruecolor(200, 200);
    // // or die('cannot create');
    // $red = rand(0, 255);
    // $green = rand(0, 255);
    // $blue = rand(0, 255);
    // $images =imagecolorallocate($imag, $red, $green, $blue);
    // $textcolor = imagecolorallocate($imag, 255, 2, 255);
    // // putenv('GDFONTPATH=' . realpath('.'));
    // // $font = 'somefont';
    // $font = __DIR__ . '.\font\Pangolin-Regular.ttf';
    // echo $font;
    // $image = imagestring($imag, 1, 5, 5, 'Hello World', $textcolor);
    // // $var = imagettftext($imag, 120, 0, 50, 200, $textcolor, $font, $character);
    // // $hg = imagepng($imag, $path);
    // $gb = imagedestroy($imag);
// ord();

    
// // }

// echo $image;

// imagettftext(): Invalid font filename in
// transparent image

// $png = imagecreatetruecolor(800, 600);
// imagesavealpha($png, true);
// $trans_color = imagecolorallocatealpha($png,5, 0, 0, 127);
// imagefill($png, 0, 0, $trans_color);
// $red = imagefilledellipse($png, 400, 300, 400, 300, $red);
// header("content-type: image/png");
// imagepng($png);

