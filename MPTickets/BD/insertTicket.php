<?php
	session_start();
	include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/FonctionPHP-SQL.php");

	// Vérifie si la variable est vide
	if (!empty($_POST['Demandeur']) and !empty($_POST['TelDemandeur']) and !empty($_POST['Impact']) and !empty($_POST['Priorite']) and !empty($_POST['id_Category']) and !empty($_POST['Departement']) and !empty($_POST['DateProbleme']) and !empty($_POST['Localisation']) and !empty($_POST['Description']))
	{
		if($_POST['Captcha'] == $_SESSION['captcha'])
		{
			echo 'GOOD';
			include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

			//ligne 8, mettre sessions ID_ticket
			$id_ticket=create_NumDailyTickets();
			$Utilisateur_demandeur=$_POST['Demandeur'];
			$Numero_tel_demandeur=$_POST['TelDemandeur'];
			// Dépanneur
			$fk_id_status=1;
			$fk_id_impact=$_POST['Impact'];
			$fk_id_priorite=$_POST['Priorite'];
			$fk_id_categorie=$_POST['id_Category'];
			$fk_id_departement=$_POST['Departement'];
			// Date ouverture Automatique lors de l'INSERT
			$Date_Probleme=$_POST['DateProbleme'];
			// Date de Fermeture vide à la création du ticket
			$IP=$_SERVER["REMOTE_ADDR"];
			$Nom_machine_creation=$_POST["IpMaterielDemande"];
			$Nom_machine_probleme=$_POST['NoMateriel'];
			$Localisation=$_POST['Localisation'];
			$Description_ticket=$_POST['Description'];
			// Résolution

			// modifier le format de date pour qu'il corressponde à mysql
			$Date_Probleme = date("Y-m-d H:i:s",strtotime($Date_Probleme));
	
			// Création et envoi de la requête
			$query = 'INSERT INTO T_Tickets (id_ticket, Utilisateur_demandeur, Numero_tel_demandeur, fk_id_status, fk_id_impact, fk_id_priorite, fk_id_departement, fk_id_categorie, Date_Probleme, IP, Nom_machine_creation, Nom_machine_probleme, Localisation, Description_ticket)
			VALUES ("'.$id_ticket.'", "'.$Utilisateur_demandeur.'", "'.$Numero_tel_demandeur.'", "'.$fk_id_status.'", "'.$fk_id_impact.'", "'.$fk_id_priorite.'", "'.$fk_id_departement.'", "'.$fk_id_categorie.'", "'.$Date_Probleme.'", "'.$IP.'", "'.$Nom_machine_creation.'", "'.$Nom_machine_probleme.'", "'.$Localisation.'", "'.$Description_ticket.'")';
		
			$result = mysqli_query($link,$query);
		
			include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");

			// Réinitialiser les variables de sessions
			$_SESSION['Demandeur'] = '';
			$_SESSION['TelDemandeur'] = '';
			$_SESSION['Localisation'] = '';
			$_SESSION['NoMateriel'] = '';
			$_SESSION['DateProbleme'] = '';
			$_SESSION['id_Category'] = '';
			$_SESSION['Categorie'] = '';
			$_SESSION['Description'] = '';

			header("Location:../body/remercimentCreationTicketPage.php?NumTicket=$id_ticket&Demandeur=$Utilisateur_demandeur");
			exit;
		}
		else 
		{
			// Le Captcha ne correspond pas au texte
			$_SESSION['Demandeur'] = $_POST['Demandeur'];
			$_SESSION['TelDemandeur'] = $_POST['TelDemandeur'];
			$_SESSION['Localisation'] = $_POST['Localisation'];
			$_SESSION['NoMateriel'] = $_POST['NoMateriel'];
			$_SESSION['DateProbleme'] = $_POST['DateProbleme'];
			$_SESSION['id_Category'] = $_POST['id_Category'];
			$_SESSION['Categorie'] = $_POST['Categorie'];
			$_SESSION['Description'] = $_POST['Description'];

			header("Location:../body/creationTicketPage.php?error=2");
			exit;
		}

	}
	else 
	{
		$_SESSION['Demandeur'] = $_POST['Demandeur'];
		$_SESSION['TelDemandeur'] = $_POST['TelDemandeur'];
		$_SESSION['Localisation'] = $_POST['Localisation'];
		$_SESSION['NoMateriel'] = $_POST['NoMateriel'];
		$_SESSION['DateProbleme'] = $_POST['DateProbleme'];
		$_SESSION['id_Category'] = $_POST['id_Category'];
		$_SESSION['Categorie'] = $_POST['Categorie'];
		$_SESSION['Description'] = $_POST['Description'];

		header("Location:../body/creationTicketPage.php?error=1");
		exit;
	}
	

?>
