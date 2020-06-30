<?php
	// Ajout la variable pour enlever l'authentification
	// Doit être mis avant importation du header
	$NoAuthentificationPage = true;

	include($_SERVER['DOCUMENT_ROOT']."/MPTickets/includes/header.php");
?>

<link rel="stylesheet" type="text/css" href="/MPTickets/css/cssLoginAdmin.css"/>

	<div class="card centerH centerV">
		<div class="card-header centerH">
			<h3>Suivi d'un Ticket</h3>
		</div>
		<div class="card-body centerH">
			<form action="/MPTickets/body/viewTicketPage.php" method="post">
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-ticket-alt"></i></span>
					</div>
					<input required class="InputLogin" type="text" name="idTicket" id="idTicket" placeholder="idTicket">
				</div>
				<div class="form-group">
					<button class="Bouton float-right" type="submit" name="subButton">Chercher</button>
				</div>
			</form>
		</div>
	</div>
<?php 
	include($_SERVER['DOCUMENT_ROOT']."/MPTickets/includes/footer.php");
?>