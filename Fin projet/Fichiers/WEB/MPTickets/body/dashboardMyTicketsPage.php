<?php
	include($_SERVER['DOCUMENT_ROOT']."/MPTickets/includes/header.php");
	include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/sort_TicketDashboard.php");
?>

<link rel="stylesheet" href="/MPTickets/css/cssDashboardTickets.css"/>

<div class="TableDashPlan">
	<h1><center>Mes Tickets</center></h1>
	
	
	<!-- Création du formulaire en format Tableau -->
	<table id="TableDash">
		<?php echo '
			<tr>
				<th class="TdCol_1"><a href="./dashboardMyTicketsPage.php?sort='.$sort_id_ticket.'&amp;col=id_ticket">ID du Ticket '.check_ArrowIdTicket('id_ticket', $sort_col, $sort).'</a></th>
				<th class="TdCol_2"><a href="./dashboardMyTicketsPage.php?sort='.$sort_Categorie.'&amp;col=Categorie">Catégorie '.check_ArrowIdTicket('Categorie', $sort_col, $sort).'</a></th>
				<th class="TdCol_3"><a href="./dashboardMyTicketsPage.php?sort='.$sort_Priorite.'&amp;col=Priorite">Priorité '.check_ArrowIdTicket('priorite', $sort_col, $sort).'</a></th>
				<th class="TdCol_4"><a href="./dashboardMyTicketsPage.php?sort='.$sort_Status.'&amp;col=Status">Status '.check_ArrowIdTicket('Status', $sort_col, $sort).'</a></th>
				<th class="TdCol_5"><a href="./dashboardMyTicketsPage.php?sort='.$sort_Demandeur.'&amp;col=Demandeur">Demandeur '.check_ArrowIdTicket('Utilisateur', $sort_col, $sort).'</a></th>
				<th class="TdCol_6"><a href="./dashboardMyTicketsPage.php?sort='.$sort_Impact.'&amp;col=Impact">Impact '.check_ArrowIdTicket('impact', $sort_col, $sort).'</a></th>
				<th class="TdCol_7"><a href="./dashboardMyTicketsPage.php?sort='.$sort_DatePB.'&amp;col=DatePB">Date du problème '.check_ArrowIdTicket('Date_Probleme', $sort_col, $sort).'</a></th>
			</tr>';
			
			// Appeler la fonction pour afficher les tous les tickets
			import_AllMyTicket($sort_col, $sort, $_SESSION['username']);
		 ?>
	</table>
</div>

<?php 
include($_SERVER['DOCUMENT_ROOT']."/MPTickets/includes/footer.php");
?>