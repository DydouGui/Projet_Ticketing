<?php
	// Ajout la variable pour enlever l'authentification
	// Doit être mis avant importation du header
	$NoAuthentificationPage = true;

	include($_SERVER['DOCUMENT_ROOT']."/MPTickets/includes/header.php");
?>

 <link rel="stylesheet" href="/MPTickets/css/cssRemerciementTicket.css"/>

<div class="RemerciementPlan centerH centerTable">
	<div class="card-header centerH">
		<h1>Votre ticket a été ouvert</h1>
	</div>
	<!-- Creation du formulaire en format Tableau -->
	<table class="TableRemerciement card-body centerH">
			<tr>
				<td class="Td_Remerciement" colspan="2"><p>Cher <?php echo $_GET['Demandeur']; ?>,</br>
				Votre ticket a bien été créé. Voici le numéro de votre ticket: <span class="Gras"> <?php echo $_GET['NumTicket']; ?></span></br>
				Merci de le bien garder Vous pouvez consulter l'état de votre ticket depuis la page "Suivi d'un ticket"</p></td>
			</tr>
			<tr>	
				<td  class="Td_Remerciement"><button class="Bouton centerH" type="button" onClick="history.back()">Go Back</button></td>
				<td  class="Td_Remerciement"><a href="suiviTicketPage.php" target="_blank"> <button class="Bouton centerH" type="button">Suivi d'un Ticket</button> </a></td>
			</tr>
	</table>
</div>




<?php 
include($_SERVER['DOCUMENT_ROOT']."/MPTickets/includes/footer.php");
?>