<?php
	// Ajout la variable pour enlever l'authentification
	// Doit être mis avant importation du header
	$NoAuthentificationPage = true;

	include($_SERVER['DOCUMENT_ROOT']."/MPTickets/includes/header.php");
?>

 <link rel="stylesheet" href="/MPTickets/css/cssRemerciementTicket.css"/>

<div class="card centerH centerV">
	<div class="card-header centerH">
		<h3>Ticket inexistant</h3>
	</div>
	<div class="card-body centerH">
		<div class="form-group">
			<p>Nos excuses, votre ticket <span class="Gras"> <?php echo $_GET['idTicket']; ?>,</span> n'a pas été trouvé.<br>
				Merci de bien vérifier l'ID du ticket.</p>
		</div>
		<div class="form-group">
			<a href="suiviTicketPage.php"> <button class="Bouton float-right" type="button">Suivi d'un Ticket</button> </a>
		</div>
	</div>
</div>




<?php 
include($_SERVER['DOCUMENT_ROOT']."/MPTickets/includes/footer.php");
?>