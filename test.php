<?php 

$o_img = imagecreatefromjpeg('demo.jpg');
//$o_width = imagesx($o_img);
//$o_height = imagesy($o_img);

//$canvas = imagecreatetruecolor(300,300);
 //imagejpeg($canvas,"test.jpg");
 //imagecopyresampled($canvas,$o_img,0,0,0,0,300,300,$o_width,$o_height);
 imagejpeg($o_img,"final2.jpg",50);







?>