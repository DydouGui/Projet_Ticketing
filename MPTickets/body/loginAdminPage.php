<?php
	// Ajout la variable pour enlever l'authentification
	// Doit être mis avant importation du header
	$NoAuthentificationPage = true;

	include($_SERVER['DOCUMENT_ROOT']."/MPTickets/includes/header.php");
	
//	echo $_COOKIE['username'];
//	echo $_COOKIE['connectMPTickets'];

	// Si l'utilisateur est déjà authentifié
	if(check_UserAuthentication() === true)
	{
		// Va directement sur la page Dashboard
		header('Location: dashboardTicketsPage.php');
		exit;
	}
	// Sinon vérifie si l'utilisateur à un cookie valable pour la connexion
	elseif(check_CookieAuthentication() === true)
	{
		// Ajouter les variables de session
		$_SESSION['username'] = $_COOKIE['username'];
		$_SESSION['password'] = import_PasswordUser($_COOKIE['username']); // Recupérer le hash du mot de passe

		// Va directement sur la page Dashboard
		header('Location: dashboardTicketsPage.php');
		exit;
	}
?>

<link rel="stylesheet" type="text/css" href="/MPTickets/css/cssLoginAdmin.css"/>

<div class="card centerV centerH">
	<div class="card-header centerH">
		<h3>Administration Login</h3>
	</div>
	<div class="card-body centerH">
		<form action="../BD/login.php" method="post">
			<div class="input-group form-group">
				<div class="input-group-prepend">
					<span class="input-group-text"><i class="fas fa-user"></i></span>
				</div>
				<input required class="InputLogin" type="text" id="username" name="username" placeholder="Username">
			</div>
			<div class="input-group form-group">
				<div class="input-group-prepend">
					<span class="input-group-text"><i class="fas fa-key"></i></span>
				</div>
				<input required class="InputLogin" type="password" id="password" name="password" placeholder="Password">
			</div>
			<div class="row align-items-center remember">
				<input type="checkbox" id="rememberMe" name="rememberMe"><label for="rememberMe">Remember me</label>
			</div>
			<div class="form-group">
				<button class="Bouton float-right" type="submit" name="subButton">Connexion</button>
			</div>
		</form>
	</div>
</div>
<?php 
	include($_SERVER['DOCUMENT_ROOT']."/MPTickets/includes/footer.php");
?>