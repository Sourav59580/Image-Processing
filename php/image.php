<?php
    $width = $_POST['width'];
    $height = $_POST['height'];
    $red = $_POST['red'];
    $green = $_POST['green'];
    $blue = $_POST['blue'];
    $format = $_POST['format'];

    $raw_img = imagecreate($width,$height);
    imagecolorallocate($raw_img,$red,$green,$blue);
    $ran = rand(1,500000);
    if($format=="png")
    {
      if(imagepng($raw_img,"../images/".$ran.".png"))
      echo $ran.".png";
      imagedestroy($raw_img);
    }
    else if($format=="jpeg")
    {
      if(imagejpeg($raw_img,"../images/".$ran.".jpg"))
      echo $ran.".jpg";
      imagedestroy($raw_img);
    }
    else if($format=="gif")
    {
      if(imagegif($raw_img,"../images/".$ran.".gif"))
      echo $ran.".gif";
      imagedestroy($raw_img);
    }

    
   
   ?>