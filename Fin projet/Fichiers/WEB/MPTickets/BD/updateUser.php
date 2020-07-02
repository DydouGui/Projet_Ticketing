<?php
	session_start();
	include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");
	include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/FonctionPHP-SQL.php");

	try{
		$Login=$_POST['LoginUtilisateur'];
		$fk_departement=$_POST['Departement'];
		$fk_droit=$_POST['Droit'];
		$password=$_POST['Password'];
		$Numero_Fix=$_POST['NoTelephoneFixe'];
		$Numero_Mob=$_POST['NoTelephonePortable'];
		$Email=$_POST['Email'];

		// Récuperer le salt du User
		$query = 'SELECT salt_user FROM T_Utilisateurs WHERE Login = "'.$Login.'"';
		$result = mysqli_query($link,$query);
		$salt = implode(mysqli_fetch_row($result)); // Retourer la viariable en string

		// Récuperer le hash du password avec le salt
		$hash_password = crypt($password, '$6$rounds=5000$'.$salt); // crypt(password, "Type de Hash".$salt); "$6$rounds=5000$" == SHA512 & "$5$rounds=5000$" == SHA256

		// Vérifie le mot de passe du User est correct
		if ($_SESSION['password'] === $hash_password) {

			// Création et envoi de la requête
			$query = 'UPDATE T_Utilisateurs SET fk_departement = "'.$fk_departement.'", fk_droit = "'.$fk_droit.'", Numero_Fix = "'.$Numero_Fix.'", Numero_Mob = "'.$Numero_Mob.'", Email = "'.$Email.'"
						WHERE Login = "'.$Login.'"';
			echo $query;
			mysqli_query($link,$query);

		}
			
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");

		header("Location:../body/manageUserPage.php?Login=$Login");
	}
	catch(Exception $e) {
			echo "Erreur lors de la modification de l'utilisateur<br>";
			echo $e->getMessage();
			echo "<br>";
			echo '<button type="button" onClick="history.back()">Retour</button>';
	}
?>