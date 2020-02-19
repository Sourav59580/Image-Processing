<?php

$width = $_POST['r-width'];
$height = $_POST['r-height'];
$file = $_FILES['file-input'];
$upload_image = $file['tmp_name'];
$type = $file['type'];
if($type=='image/jpeg')
{
$image_pixel = imagecreatefromjpeg($upload_image);
$o_width = imagesx($image_pixel);
$o_height = imagesy($image_pixel);
$canvas = imagecreatetruecolor($width,$height);
imagecopyresampled($canvas,$image_pixel,0,0,0,0,$width,$height,$o_width,$o_height);
$ran = rand(1,111100000);
if(imagejpeg($canvas,"../images/".$ran.".jpg"))
echo $ran.".jpg";
imagedestroy($image_pixel);
}
else if($type=='image/png')
{
$image_pixel = imagecreatefromjpeg($upload_image);
$o_width = imagesx($image_pixel);
$o_height = imagesy($image_pixel);
$canvas = imagecreatetruecolor($width,$height);
imagecopyresampled($canvas,$image_pixel,0,0,0,0,$width,$height,$o_width,$o_height);
$ran = rand(1,111100000);
if(imagepng($canvas,"../images/".$ran.".png"))
echo $ran.".png";
imagedestroy($image_pixel);
}

else if($type=='image/gif')
{
$image_pixel = imagecreatefromjpeg($upload_image);
$o_width = imagesx($image_pixel);
$o_height = imagesy($image_pixel);
$canvas = imagecreatetruecolor($width,$height);
imagecopyresampled($canvas,$image_pixel,0,0,0,0,$width,$height,$o_width,$o_height);
$ran = rand(1,111100000);
if(imagegif($canvas,"../images/".$ran.".gif"))
echo $ran.".gif";
imagedestroy($image_pixel);
}



?>