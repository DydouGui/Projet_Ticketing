<?php
/*
	Va Créer un commentaire commencant par ----- Suspension -----
	Ensuite changer le Status du ticket
*/


	// Si le champs Commentaire est remplis, Ajoute le commentaire et redirige vers le ticket
	// Uniquement sur Commentaire car l'auteur est forcement là car il est en requis
	if (isset($_POST['Commentaire']))
	{
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/FonctionPHP-SQL.php");
		
		try{
			$id_ticket=$_POST['NumTicket'];
			$Auteur=$_POST['Auteur'];
			$Commentaire=$_POST['Commentaire'];
			
			// récupérer status Ticket
			$TicketStatu=import_TicketStatu($id_ticket);
			
			// Si le status du ticket est égale à Ouvert
			if($TicketStatu[2] == "Ouvert")
			{
				// Ajouter le ----- Suspension -----
				$Commentaire='----- Suspension ----- '.$Commentaire;
			}
			// Sinon est égale à suspendu
			else
			{
				// Ajouter le ----- Dépendre -----
				$Commentaire='----- Dépendre ----- '.$Commentaire;
			}
			
			//Création du Ticket
			// Création et envoi de la requête
			$query = 'INSERT INTO T_Commentaires (fk_id_ticket, fk_id_utilisateur, Commentaire)
						VALUES ("'.$id_ticket.'", "'.$Auteur.'", "'.$Commentaire.'")';
			mysqli_query($link,$query);
			
			// Si le status du ticket est égale à Ouvert
			if($TicketStatu[2] == "Ouvert")
			{
				// Changement du status | Ouvert --> Suspendu
				$query = "UPDATE T_Tickets SET fk_id_status = '6'
							WHERE id_ticket = '$id_ticket'";
			}
			// Sinon est égale à suspendu
			else
			{
				// Changement du status | Suspendu --> Ouvert
				$query = "UPDATE T_Tickets SET fk_id_status = '1'
							WHERE id_ticket = '$id_ticket'";
			}
			mysqli_query($link,$query);
			
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