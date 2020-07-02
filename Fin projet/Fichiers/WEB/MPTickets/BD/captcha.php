<?php
	session_start(); // D�marrer la session
	$num_captcha = mt_rand(100000,999999); // Cr�er le text du captcha
	$_SESSION['captcha'] = hash("sha256", $num_captcha); // Chiffrer le captcha en sha-256
	
	header ("Content-type: image/png"); // Type de fichier 
	$image = imagecreate(85,35); // Taille de l'image du captcha
	
	imagecolorallocate($image, 255, 255, 255); // Background Blanc
	$colorText = imagecolorallocate($image, 0, 0, 0); // couleur du text de l'image - NOIR

	imagestring($image, 5, 15, 10, $num_captcha, $colorText); // Cr�ation de l'image
	imagepng($image); // Finition de l'image
	imagedestroy($image); // Supprimer de la m�moire la cr�ation de l'image

?>