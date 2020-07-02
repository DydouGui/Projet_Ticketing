<?php
/*
	Va ajouter la résolution au ticket
	Ensuite changer le Status du ticket
*/


	// Si le champs Résolution est remplis, Ajoute le commentaire et redirige vers le ticket
	// Uniquement sur Résolution car l'auteur est forcement là car il est en requis
	if (isset($_POST['Resolution']))
	{
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/FonctionPHP-SQL.php");
		
		try{
			$id_ticket=$_POST['NumTicket'];
			$fk_id_utilisateur_depanneur=$_POST['Auteur'];
			$fk_id_status=5; // Résolu
			// Date de fermeture ajouté lors de l'UPDATE
			$Resolution=$_POST['Resolution'];
			
			//Mise à jour et fermeture du Ticket
			// Création et envoi de la requête
			$query = 'UPDATE T_Tickets SET fk_id_utilisateur_depanneur = "'.$fk_id_utilisateur_depanneur.'", fk_id_status = "'.$fk_id_status.'", Date_fermeture = NOW(), Resolution = "'.$Resolution.'"
						WHERE id_ticket = "'.$id_ticket.'"';
						echo $query;
			mysqli_query($link,$query);
			
			// fermer les connexion à la base de données
			include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
			
			// Va sur la page du ticket
			header("Location: /MPTickets/body/manageTicketPage.php?idTicket=$id_ticket");
			exit;
		}
		// En cas d'erreur affiche l'erreur et un bouton retour arrière
		catch(Exception $e) {
			echo "Erreur lors de la création du ticket<br>";
			echo $e->getMessage();
			echo "<br>";
			echo '<button type="button" onClick="history.back()">Retour</button>';
		}
	}
?>