<?php
	// Ajout la variable pour enlever l'authentification
	// Doit être mis avant importation du header
	$NoAuthentificationPage = true;

	include($_SERVER['DOCUMENT_ROOT']."/MPTickets/includes/header.php");
	
	$currentNumTicket = $_POST['idTicket'];

	// Vérifie si le ticket n'existe pas
	if(check_Ticket($currentNumTicket) === false)
	{	
		// Redirige vers la page ticket pas trouvé
		header("Location: /MPTickets/body/ticketNotFoundPage.php?idTicket='$currentNumTicket'");
	}
?>

 <link rel="stylesheet" href="/MPTickets/css/cssCreationTicketPage.css"/>

<div class="FirstPlan">
	<div class="Formulaire">
		<h1><center>Consulter le Ticket</center></h1>
		<h3>N° Ticket: <?php echo $currentNumTicket ?> </h3>
	
		<!-- Creation du formulaire en format Tableau -->
		<table id="tableForm">
			<tr>
				<td class="TdCol_1"><label for="statusTicket">Status du Ticket : </label></td>
				<td class="TdCol_2"><input type="text" name="statusTicket" id="statusTicket" value="<?php echo import_TicketStatu($currentNumTicket)[2]; ?>" disabled /></td>
		
				<td class="TdCol_3"><label for="Depanneur">Dépanneur : </label></td>
				<td class="TdCol_4"><input type="text"  name="Depanneur" id="Depanneur" value="<?php import_TicketDepanneur($currentNumTicket); ?>" disabled /></td>
			</tr>
			<tr>
				<td class="TdCol_1"><label for="Demandeur">Demandeur : </label></td>
				<td class="TdCol_2"><input type="text" name="Demandeur" id="Demandeur" value="<?php import_TicketDemandeur($currentNumTicket); ?>" disabled /></td>

				<td class="TdCol_3"><label for="TelDemandeur">Téléphone Demandeur : </label></td>
				<td class="TdCol_4"><input type="text" name="TelDemandeur" id="TelDemandeur" value="<?php import_TicketNumeroTelDemandeur($currentNumTicket); ?>" disabled /></td>
			</tr>
			<tr>
				<td class="TdCol_1 Separation-border-bottom"><label for="Departement">Département : </label></td>
				<td class="TdCol_2 Separation-border-bottom"><input type="text" name="Departement" id="Departement" value="<?php import_TicketDepartement($currentNumTicket); ?>" disabled /></td>
				<td class="TdCol_3 Separation-border-bottom"><label for="Localisation">Localisation : </label></td>
				<td class="TdCol_4 Separation-border-bottom"><input type="text" name="Localisation" id="Localisation" value="<?php import_TicketLocalisation($currentNumTicket); ?>" disabled/></td>
			</tr>
			<tr>
				<td class="TdCol_1 Separation-border-top"><label for="DateOuverture">Date d'ouverture : </label></td>
				<td class="TdCol_2 Separation-border-top"><input type="text" name="DateOuverture" id="DateOuverture" value="<?php import_TicketDateOuverture($currentNumTicket); ?>" disabled /></td>
				<td class="TdCol_3 Separation-border-top"><label for="DateFermeture">Date de fermeture : </label></td>
				<td class="TdCol_4 Separation-border-top"><input type="text" name="DateFermeture" id="DateFermeture" value="<?php import_TicketDateFermeture($currentNumTicket); ?>" disabled /></td>
			</tr>
			<tr>
				<td class="TdCol_1"><label for="NoMateriel">Nom du matériel (Problème) : </label></td>
				<td class="TdCol_2"><input type="text" name="NoMateriel" id="NoMateriel" value="<?php import_TicketNomMachineProbleme($currentNumTicket); ?>" disabled /></td>
				<td class="TdCol_3"><label for="DateProbleme">Date du problème : </label></td>
				<td class="TdCol_4"><input type="text" name="DateProbleme" id="DateProbleme" value="<?php import_TicketDateProbleme($currentNumTicket); ?>" disabled /></td>
			</tr>
			<tr>
				<td class="TdCol_1"><label for="NomPcDemande">Nom du matériel (Demande) : </label></td>
				<td class="TdCol_2"><input disabled type="text" name="NomPcDemande" id="NomPcDemande" value="<?php import_TicketNomMachineCreation($currentNumTicket); ?>"/></td>
				<td class="TdCol_3"><label for="NoMaterielDemande">IP du matériel (Demande) :  </label></td>
				<td class="TdCol_2"><input disabled type="text" name="NoMaterielDemande" id="NoMaterielDemande" value="<?php import_TicketIP($currentNumTicket); ?>"/></td>
			<tr>
				<td class="TdCol_1"><label for="Impact">Impact : </label></td>
				<td class="TdCol_2"><input type="text" name="Impact" id="Impact" value="<?php import_TicketImpact($currentNumTicket); ?>" disabled/></td>
				<td class="TdCol_3"><label for="Priorite">Priorité : </label></td>
				<td class="TdCol_4"><input name="Priorite" id="Priorite" value="<?php import_TicketPriorite($currentNumTicket); ?>" disabled /></td>	
			</tr>
			<tr>
				<td class="TdCol_1"><label for="Categorie">Catégorie : </label></td>
				<td class="TdCol_2" colspan="2"><input type="text" name="Categorie" id="Categorie" value="<?php import_CategoriesInput($currentNumTicket) ?>" disabled /></td>
			</tr>
			<tr>
				<td class="TdCol_1"><label for="Description">Description : </label></td>
				<td class="TdCol_2" colspan="3"><p id="Description"> <?php import_TicketDescription($currentNumTicket); ?> </p></td>
			</tr>
			<tr>
				<td class="TdCol_1"><label for="Commentaire">Commentaire : </label></td>
				<td <td class="TdCol_2" colspan="3">
					<table id="Table_Com">
						<?php import_TicketCommentaire($currentNumTicket); ?>
					</table>
				</td>
			</tr>

			<tr>
				<td class="TdCol_1"><label for="Resolution">Résolution : </label></td>
				<td class="TdCol_2" colspan="3"><p id="Resolution"> <?php import_TicketResolution($currentNumTicket); ?> </p></td>
			</tr>
			<tr>
				<td class="TdCol_1"></td>
				<td class="TdCol_3"><button class="Bouton" type="button" onClick="history.back()">Go Back</button> </td>
			</tr>
		</table>
	</div>
</div>



<?php 
include($_SERVER['DOCUMENT_ROOT']."/MPTickets/includes/footer.php");
?>