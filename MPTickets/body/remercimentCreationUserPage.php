<?php
	// Ajout la variable pour enlever l'authentification
	// Doit être mis avant importation du header
	$NoAuthentificationPage = true;

	include($_SERVER['DOCUMENT_ROOT']."/MPTickets/includes/header.php");
?>

 <link rel="stylesheet" href="/MPTickets/css/cssRemerciementTicket.css"/>

<div class="RemerciementPlan centerH">
	<div class="card-header centerH">
		<h1>Le nouvel utilisateur a été créé</h1>
	</div>
	<!-- Creation du formulaire en format Tableau -->
	<table class="TableRemerciement card-body centerH">
			<tr>
				<td class="Td_Remerciement" colspan="2"><p>Le nouvel utilisateur Mr.<span class="Gras"> <?php echo $_GET['nomNouveauUser']; ?></span>
				a bien été crée.<br>Vous pouvez consulter les informations de Mr.<span class="Gras"> <?php echo $_GET['nomNouveauUser']; ?></span> depuis la page Dashbpard User sous Administration</p></td>
			</tr>
			<tr>	
				<td  class="Td_Remerciement"><button class="Bouton centerH" type="button" onClick="history.back()">Go Back</button></td>
				<td  class="Td_Remerciement"><a href="dashboardUsersPage.php" target="_blank"> <button class="Bouton centerH" type="button">Dashboard User</button> </a></td>
			</tr>
	</table>
</div>

<?php 
include($_SERVER['DOCUMENT_ROOT']."/MPTickets/includes/footer.php");
?>