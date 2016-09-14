<?php

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function getUniqueFolder(){
	if(!isset($_SESSION['id']) || $_SESSION['id'] == ""){
		$_SESSION['id'] = generateRandomString(20) . '/';
	}
	return $_SESSION['id'];	
}

function resize($width, $height, $img, $newname){
	/* Get original image x y*/
	list($w, $h) = getimagesize($img['tmp_name']);
	/* calculate new image size with ratio */
	$ratio = max($width/$w, $height/$h);
//	$h = ceil($height / $ratio);
//	$x = ($w - $width / $ratio) / 2;
//	$w = ceil($width / $ratio);

  	/* read binary data from image file */
  	$imgString = file_get_contents($img['tmp_name']);
  	/* create image from string */
  	$image = imagecreatefromstring($imgString);
  	$tmp = imagecreatetruecolor($width, $height);
  	imagecopyresampled($tmp, $image,
    	0, 0,
//    	$x, 0,
	0, 0,
    	$width, $height,
    	$w, $h);
  	/* Save image */
  	switch ($img['type']) {
    	case 'image/jpeg':
      		imagejpeg($tmp, $newname, 100);
      		break;
    	case 'image/png':
      		imagepng($tmp, $newname, 0);
      		break;
    	case 'image/gif':
      		imagegif($tmp, $newname);
      		break;
	    default:
    	  	exit;
      		break;
	}
	return $newname;
	/* cleanup memory */
	imagedestroy($image);
	imagedestroy($tmp);
}
