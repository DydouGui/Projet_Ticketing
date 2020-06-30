<?php
	session_start();
	$_SESSION['captcha'] = mt_rand(100000,999999); // Créer le text du captcha
	
	header ("Content-type: image/png"); // Type de fichier 
	$image = imagecreate(85,35); // Taille de l'image du captcha
	
	imagecolorallocate($image, 255, 255, 255); // Background Blanc
	$colorText = imagecolorallocate($image, 0, 0, 0); // couleur du text de l'image - NOIR

	imagestring($image, 5, 15, 10, $_SESSION['captcha'], $colorText); // Création de l'image
	imagepng($image); // Finition de l'image
	imagedestroy($image); // Supprimer de la mémoire la création de l'image

/*
	header('Content-Type: image/jpeg'); // Type de fichier 
	$img = imagecreate(200,50); // Taille de l'image du captcha
	$font = 'destroyfont.ttf'; // Police d'écriture du captcha
 
	$bg = imagecolorallocate($img,255,255,255); // couleur du fond de l'image 
	$textcolor = imagecolorallocate($img, 0, 0, 0); // couleur du text de l'image 
 
	imagettftext($img, 23, 0, 3, 30, $textcolor, $font, 'test'); // Création de l'image

	imagejpeg($img); // Finition de l'image
	imagedestroy($img); // Supprimer de la mémoire la création de l'image
	
	header("Content-type: image/png");
$string = 'test';
$image = imagecreate(200,50);
$orange = imagecolorallocate($image, 220, 210, 60);
imagestring($image, 3, 35, 9, "test", $orange);
imagepng($image);
imagedestroy($image);
*/
?>