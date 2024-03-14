<?php
// Start session
session_start();
//Empty string variable
// Create function to generate random string
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 4; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    $_SESSION['captcha']= $randomString;
// Create a blank image and add some text

$im = imagecreatetruecolor(140, 40);
$background_color = imagecolorallocate($im, 192, 192, 192);  
imagefilledrectangle($im,0,0,200,50,$background_color);
$pixel_color = imagecolorallocate($im, 0,0,255);
for($i=0;$i<10;$i++) {
    imagesetpixel($im,rand()%200,rand()%50,$pixel_color);
}  
$text_color = imagecolorallocate($im, 0, 0, 215);
//$font = imageloadfont('assets/bootstrap/fonts/fontawesome-webfont.ttf');
imagestring($im, 5, 50, 10,  $randomString, $text_color);
$font_size = 20;
$angle = 65;
$x = 10;
$y = 10;
$text_color = '#fff';
$font_family = 'sans-sarif';
//imagettftext($im, $font_size, $angle, $x, $y, $text_color, '$font-family', $randomString);

// Set the content type header - in this case image/jpeg
header('Content-Type: image/jpeg');

// Output the image
imagejpeg($im);

// Free up memory
//imagedestroy($im);
?>
