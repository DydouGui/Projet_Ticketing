<?php
	include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");
	include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/FonctionPHP-SQL.php");

	try{
		//ligne 8, mettre sessions ID_ticket
		$id_ticket=$_POST['NumTicket'];
		$fk_id_utilisateur_depanneur=$_POST['Depanneur']; // Dépanneur
		$fk_id_impact=$_POST['Impact'];
		$fk_id_priorite=$_POST['Priorite'];
		$fk_id_categorie=$_POST['id_Category'];
		$Nom_machine_probleme=$_POST['NoMateriel'];
		// Résolution

		// Si un dépanneur est séléctionner
		if($fk_id_utilisateur_depanneur != "")
		{
			// Création et envoi de la requête
			$query = 'UPDATE T_Tickets SET fk_id_impact = "'.$fk_id_impact.'", fk_id_utilisateur_depanneur = "'.$fk_id_utilisateur_depanneur.'", fk_id_priorite = "'.$fk_id_priorite.'", fk_id_categorie = "'. $fk_id_categorie .'", Nom_machine_probleme = "'.$Nom_machine_probleme.'"
						WHERE id_ticket = "'.$id_ticket.'"';
		}
		//Si aucun dépanneur est séléctioné
		else{
			// Création et envoi de la requête
			$query = 'UPDATE T_Tickets SET fk_id_impact = "'.$fk_id_impact.'", fk_id_priorite = "'.$fk_id_priorite.'", fk_id_categorie = "'. $fk_id_categorie .'", Nom_machine_probleme = "'.$Nom_machine_probleme.'"
						WHERE id_ticket = "'.$id_ticket.'"';
		}
		echo $query;
		mysqli_query($link,$query);
			
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");

		header("Location:../body/manageTicketPage.php?idTicket=$id_ticket");
	}
	catch(Exception $e) {
			echo "Erreur lors de la création du ticket<br>";
			echo $e->getMessage();
			echo "<br>";
			echo '<button type="button" onClick="history.back()">Retour</button>';
	}
?>