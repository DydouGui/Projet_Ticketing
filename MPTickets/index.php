<?php
	// Ajout la variable pour enlever l'authentification
	// Doit être mis avant importation du header
	$NoAuthentificationPage = true;

	include($_SERVER['DOCUMENT_ROOT']."/MPTickets/includes/header.php");
	
	// Récuperer les 5 derniers tickets
	$tickets = import_LastTickets();
?>
	

<!--Custom styles-->
<link rel="stylesheet" type="text/css" href="/MPTickets/css/cssIndex.css">

<div class="row d-flex align-items-center">
	<div class="col centerTable">
		<div class="card-index">
			<div class="card-header centerH">
				<h1>MPTickets</h1>
			</div>
			<div class="card-body">
				<h5>La solution ticketing la plus simple et la plus efficasse !</h3>
				<p>MPTickets a été developpé et a été adapté pour Montreux Palace.<br>
					La solution vous permet de créer des tickets au près du support informatique. MPTickets vous permet aussi de gérer les tickets créent par les utilisateurs.
					Le flux RSS qui permet de suivire les derniers tickets résolus, vous pouvez sans hésiter cliquer sur le boutons ci-dessous.</p>
				<p><strong>Note:</strong> Le flux RSS marche sans problème sous Internet Explorer sinon il faudera ajouter l'extension RSS Feed Reader sous Chrome.</p><br>
				<a href="/MPTickets/rssIndex.php" target="_blank"><img height='42px' src="/MPTickets/Images/rss.png"></a>
			</div>
		</div>
	</div>
	<div class="col">
		<div class="card-index">
			<div class="card-header centerH">
				<h1>Derniers tickets résolus</h1>
			</div>
			<div class="card-body">
				<table id="TableLastTickets">
					<tr>
						<th class="TdCol_1">Description</th>
						<th class="TdCol_2">Résolution</th>
					</tr>
					<?php
						while($rows = mysqli_fetch_row($tickets)) 
						{
							echo '
							<tr class="TrRow">
								<td class="TdCol_1 RowTicket Arrondi-Gauche"><strong>'.$rows[2].'</strong><br>'.$rows[3].'</td>
								<td class="TdCol_2 RowTicket Arrondi-Droite">'.$rows[4].'</td>
							</tr>';
						}
					?>
				</table>
			</div>
		</div>
	</div>
</div>

<?php 
	include($_SERVER['DOCUMENT_ROOT']."/MPTickets/includes/footer.php");
?>