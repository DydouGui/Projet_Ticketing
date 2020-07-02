<?php
	include($_SERVER['DOCUMENT_ROOT']."/MPTickets/includes/header.php");
	
	$currentNumTicket = $_POST['NumTicket'];
	$StatusBouton= create_StatuButton($currentNumTicket);
?>

 <link rel="stylesheet" href="/MPTickets/css/cssAddComments.css"/>

<div class="card-comment centerTable centerH">
	<div class="card-header centerH">
		<h1><center><?php echo $StatusBouton;?> un ticket</center></h1>
	</div>

	<!-- Creation du formulaire en format Tableau -->
	<table id="TableAddCom" class="card-body centerH">
		<form id="formlulaire" method="post" action="/MPTickets/BD/suspendTicket.php">
			<tr>
				<td class="TdCol_1"><label for="NumTicket">N° Ticket : </label></td>
				<td class="TdCol_2" colspan="2"><input readonly type="text" id="NumTicket" name="NumTicket" value="<?php echo $currentNumTicket; ?>"</td>
			</tr>
			<tr>
				<td class="TdCol_1"><label for="Auteur">Auteur : </label></td>
				<td class="TdCol_2"><select required name="Auteur" id="Auteur">
							<option value="">Qui est l'Auteur ?</option>
							<?php import_Depanneurs(); ?>
						</select></td>
			</tr>
			<tr>
				<td class="TdCol_1"><label for="Commentaire">Commentaire : </label></td>
				<td class="TdCol_2" colspan="2"><textarea required id="Commentaire" name="Commentaire"></textarea></td>
			</tr>
			<tr>
				<td class="TdCol_1"></td>
				<td class="TdCol_2"><button class="Bouton Manage-Button" type="button" onClick="history.back()">Retour</button></td>
				<td class="TdCol_3"><button class="Bouton Manage-Button" type="submit"> <?php echo $StatusBouton; ?></button></td>
			</tr>

		</form>
	</table>
</div>



<?php 
include($_SERVER['DOCUMENT_ROOT']."/MPTickets/includes/footer.php");
?>