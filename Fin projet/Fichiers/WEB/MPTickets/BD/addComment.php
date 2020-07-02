<?php
	// Si le champs Commentaire est remplis, Ajoute le commentaire et redirige vers le ticket
	// Uniquement sur Commentaire car l'auteur est forcement là car il est en requis
	if (isset($_POST['Commentaire']))
	{
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");
		
		try{
			$NumTicket=$_POST['NumTicket'];
			$Auteur=$_POST['Auteur'];
			$Commentaire=$_POST['Commentaire'];
			
			// Création et envoi de la requête
			$query = 'INSERT INTO T_Commentaires (fk_id_ticket, fk_id_utilisateur, Commentaire)
						VALUES ("'.$NumTicket.'", "'.$Auteur.'", "'.$Commentaire.'")';

			$result = mysqli_query($link,$query);
			
			include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
			
			// Va sur la page du ticket
			header("Location: /MPTickets/body/manageTicketPage.php?idTicket=$NumTicket");
			exit;
			//echo '<meta http-equiv="refresh" content="1;url=/MPTickets/body/manageTicketPage.php?idTicket='.$NumTicket.'/>';
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