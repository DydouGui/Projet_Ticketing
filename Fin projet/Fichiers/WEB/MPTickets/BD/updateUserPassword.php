<?php
	include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");
	include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/FonctionPHP-SQL.php");

	try{
		$Login=$_POST['LoginUtilisateur'];
		$Password=$_POST['newPassword'];
		$RepeterMotPasse=$_POST['newPassword2'];

		// V�rifier que les deux mots de passe soit identiques 
		if($Password === $RepeterMotPasse)
		{
			// Cr�ation du nouveau salt_user
			$salt_user = create_SaltUser();

			// Hasher le mot de passe
			$Password = crypt($Password, '$6$rounds=5000$'.$salt_user); // crypt(password, "Type de Hash".$salt); "$6$rounds=5000$" == SHA512 & "$5$rounds=5000$" == SHA256

			// Cr�ation et envoi de la requete
			$query = 'UPDATE T_Utilisateurs SET Password = "'.$Password.'", salt_user = "'.$salt_user.'"
						WHERE Login = "'.$Login.'"';
			mysqli_query($link,$query);

			// Modifier le mot de passe de la session
			$_SESSION['password'] = $Password;
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