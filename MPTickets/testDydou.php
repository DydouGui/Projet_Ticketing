<?php
// Ajout la variable pour enlever l'authentification
	// Doit �tre mis avant importation du header
	$NoAuthentificationPage = true;

//	include($_SERVER['DOCUMENT_ROOT']."/MPTickets/includes/header.php");
?>

<style>

html, body{
	background-image: none;
}
</style>

<?php
	$a = 'a';
	$b = 'a';

	if(!empty($a) and !empty($b))
	{
		echo "PAS VIDE";
	}
 
?>

