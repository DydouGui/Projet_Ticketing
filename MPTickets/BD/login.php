<?php
include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");
// Importer toutes les fonctions PHP
include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/FonctionPHP-SQL.php");

if (isset($_POST['username'])){
	$username = htmlspecialchars($_POST['username']); // R�cuperer le username en �vitant les injections SQL
	$password = htmlspecialchars($_POST['password']); // R�cuperer le password en �vitant les injections SQL
	
	$isPasswordCorrect = false; // Dire que le mot de passe est faux avant le test

	// Check si l'utilisateur existe
	$check_User = check_User($username);
	if($check_User === true)
	{
		// R�cuperer le salt du user
		$query = 'SELECT salt_user FROM T_Utilisateurs WHERE Login = "'.$username.'"';
		$result = mysqli_query($link,$query);
		$salt = implode(mysqli_fetch_row($result)); // Retourer la viariable en string

		// R�cuperer le password du user
		$password_User = import_PasswordUser($username);

		// R�cuperer le hash du password avec le salt
		$hash_password = crypt($password, '$6$rounds=5000$'.$salt); // crypt(password, "Type de Hash".$salt); "$6$rounds=5000$" == SHA512 & "$5$rounds=5000$" == SHA256
	
		//V�rifier la correspondance des mots de passe
		// Test si le mot de passe est correcte
		if ($password_User === $hash_password) {
			$isPasswordCorrect = true;
		}
	}

    if ($isPasswordCorrect === true) {
		  session_start();
		  $_SESSION['username'] = $username;
		  $_SESSION['password'] = $hash_password;

		  // V�rifier si la case REMEMBER ME a �t� coch�e
		  if(isset($_POST['rememberMe']))
		  {
		  	  // Cr�er le cookie du remember ME
			  create_ConnectCookies();
		  }

		  // Redirection vers le Dashboard
		  header('Location: \MPTickets\body\dashboardTicketsPage.php');
    } 
	else // Le mot de passe n'est pas correcte
	{
		// Redirection vers le Login
		header('Location: \MPTickets\body\loginAdminPage.php');
		$errorMsg =  "Les identifiants ne sont pas correctes !!!";
		
		if(isset($_COOKIE['username'])){ delete_CookieAuthentication(); }
		
		session_start();
		session_unset();
		session_destroy();
    }
}

include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
?>