<?php
	// Importer toutes les fonctions PHP
	include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/FonctionPHP-SQL.php");

	session_start();
	session_unset();
	session_destroy();

	// Si cookie de connexion, supprimer
	if(isset($_COOKIE['username'])){ delete_CookieAuthentication(); }

	header('Location: /MPTickets/index.php');
 ?>