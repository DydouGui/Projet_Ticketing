<?php
	include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");
	include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/FonctionPHP-SQL.php");

	// Vérifier que le formulaire a été remplis
	if (isset($_POST['Prenom']))
	{
		// Importation des données
		$fk_departement=$_POST['Departement'];
		$fk_droit=$_POST['Droit'];
		$Login=$_POST['Login'];
		$salt_user=""; // Création aléatoire
		$Password=$_POST['Password'];
		$RepeterMotPasse=$_POST['RepeterMotPasse'];
		$Nom=$_POST['Nom'];
		$Prenom=$_POST['Prenom'];
		$Numero_Fix=$_POST['NoTelephoneFixe'];
		$Numero_Mob=$_POST['NoTelephonePortable'];
		$Email=$_POST['Email'];

		// Créer le Salt du user et le hasher
		$salt_user = create_SaltUser();

		// Hasher le mot de passe
		$Password = crypt($Password, '$6$rounds=5000$'.$salt_user); // crypt(password, "Type de Hash".$salt); "$6$rounds=5000$" == SHA512 & "$5$rounds=5000$" == SHA256

		// Création et envoi de la requête
		$query = 'INSERT INTO T_Utilisateurs (fk_departement, fk_droit, Login, salt_user, Password, Nom, Prenom, Numero_Fix, Numero_Mob, Email)
		VALUES ("'.$fk_departement.'","'.$fk_droit.'","'.$Login.'","'.$salt_user.'", "'.$Password.'", "'.$Nom.'", "'.$Prenom.'", "'.$Numero_Fix.'","'.$Numero_Mob.'","'.$Email.'")';
		echo $query;
		$result = mysqli_query($link,$query);

		header("Location:../body/remercimentCreationUserPage.php?nomNouveauUser=$Nom");
		
	}
		
		
	include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");


	

?>
