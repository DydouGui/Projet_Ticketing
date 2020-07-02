<?php 
session_start();

// Importer toutes les fonctions PHP
include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/FonctionPHP-SQL.php");

// Les pages ont besoin d'une authentification sauf si la page contient la variable $NoAuthentificationPage
// Si la variable n'existe pas ---> Authentification
// Si la variable existe ---> No Authentification
if(empty($NoAuthentificationPage))
{
	// Verifie l'autentification
	check_UserRedirection();
}

?>

<!DOCTYPE html>
<html lang="fr">
	<head id="Header">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>MP.Tickets</title>

		<!-- Ajout de Bootstrap -->
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

		<!--Bootsrap 4 CDN-->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

		<!--Fontawesome CDN-->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

		<!-- Popper JS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
		
		<!-- Lien CSS -->
		<link rel="stylesheet" type="text/css" href="/MPTickets/css/cssMain.css"/>
		<link rel="stylesheet" type="text/css" href="/MPTickets/css/cssHeader.css"/>
		<link rel="stylesheet" type="text/css" href="/MPTickets/css/cssFooter.css"/>

		<!-- Lien JS -->
		<script type="text/javascript" src="/MPTickets/JavaScriptMain.js"></script>

	</head>
	<body>	
		

		<!-- Navigation -->
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
			<div class="container">
				<!-- Image MPTickets + Lien idex -->
				<a class="navbar-brand" href="/MPTickets/index.php"><img src="/MPTickets/Images/Newlogo.png" height="49" alt="Logo MPTickiets"></a>

				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarResponsive">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item">
							<a class="nav-link" href="/MPTickets/body/creationTicketPage.php">Création d'un ticket</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="/MPTickets/body/suiviTicketPage.php">Suivi d'un ticket</a>
						</li>
						<?php create_header()?> <!-- Fonction création du Header d'après si l'utilisateur est connecté -->
					</ul>
				</div>
			</div>
		</nav>