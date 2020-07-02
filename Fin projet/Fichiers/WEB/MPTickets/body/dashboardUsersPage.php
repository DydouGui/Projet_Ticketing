<?php
	include($_SERVER['DOCUMENT_ROOT']."/MPTickets/includes/header.php");
	include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/sort_Users.php");
?>

<link rel="stylesheet" href="/MPTickets/css/cssDashboardUsers.css"/>

<div class="TableDashPlan">
	<center><h1>Dashboard Users</h1></center>
	
	<!-- Création du formulaire en format Tableau -->
	<table id="TableDash">
		<?php echo '
			<tr>
				<th class="TdCol_1"><a href="./dashboardUsersPage.php?sort='.$sort_Prenom.'&amp;col=Prenom">Prénom '.check_ArrowIdTicket('Prenom', $sort_col, $sort).'</a></th>
				<th class="TdCol_2"><a href="./dashboardUsersPage.php?sort='.$sort_Nom.'&amp;col=Nom">Nom '.check_ArrowIdTicket('Nom', $sort_col, $sort).'</a></th>
				<th class="TdCol_3"><a href="./dashboardUsersPage.php?sort='.$sort_Login.'&amp;col=Login">Login '.check_ArrowIdTicket('Login', $sort_col, $sort).'</a></th>
				<th class="TdCol_4"><a href="./dashboardUsersPage.php?sort='.$sort_Email.'&amp;col=Email">Email '.check_ArrowIdTicket('Email', $sort_col, $sort).'</a><a href="./creationUserPage.php" class="BoutonImg"><i class="fas fa-user-plus icon-6x" title="Ajouter un utilisateur"></i></a></th>
				<th class="TdCol_5"><a href="./dashboardUsersPage.php?sort='.$sort_Departement.'&amp;col=Departement">Département '.check_ArrowIdTicket('Departement', $sort_col, $sort).'</a></th>
				<th class="TdCol_6"><a href="./dashboardUsersPage.php?sort='.$sort_Droit.'&amp;col=Droit">Droit '.check_ArrowIdTicket('Niveau_droit', $sort_col, $sort).'</a></th>
			</tr>';
			
			// Appeler la fonction pour afficher les tous les tickets
			import_AllUsers($sort_col, $sort);
		 ?>
	</table>
</div>

<?php 
include($_SERVER['DOCUMENT_ROOT']."/MPTickets/includes/footer.php");
?>