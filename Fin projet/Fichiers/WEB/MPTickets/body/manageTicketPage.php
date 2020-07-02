<?php

	// Cela vient du bouton ajouter commentaire
	if(isset($_POST['addComments'])){
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/body/addCommentsPage.php");
		exit;
	}
	
	// Cela vient du bouton ajouter UpdateTicket
	if(isset($_POST['UpdateTicket'])){
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/updateTicket.php");
		exit;
	}
	
	// Cela vient du bouton ajouter Suspend
	if(isset($_POST['Suspend'])){
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/body/suspendTicketPage.php");
		exit;
	}
	
	// Cela vient du bouton ajouter Resolve
	if(isset($_POST['Resolve'])){
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/body/resolveTicketPage.php");
		exit;
	}
	
	include($_SERVER['DOCUMENT_ROOT']."/MPTickets/includes/header.php");
	
	$currentNumTicket = $_GET['idTicket'];
	
	// Récupérer le status du bouton
	$TicketStatu=import_TicketStatu($currentNumTicket);
	$StatusBouton= create_StatuButton($currentNumTicket);
	
?>

<link rel="stylesheet" href="/MPTickets/css/cssCreationTicketPage.css"/>

<div class="Formulaire">
	
	<!-- Creation du formulaire en format Tableau -->
	<table id="tableForm">
			<form id="form-comments" method="post" action="">
			<tr>
				<td id="TdImgRefresh"><a href="./dashboardTicketsPage.php" ><img src="/MPTickets/Images/backArrow.png" class="ImgBack" title="Retour à la page précédente" height="45" alt="Retour"></a><img src="/MPTickets/Images/RefreshArrow.png" id="ImgRefresh" title="Raffraîchir la page" height="45" alt="Refresh" onClick="document.location.reload(false)"></td>
				<td colspan="2"><h1><center>Manage Ticket</center></td>
				<td rowspan="2" id="TdImgUpdate"><button class="BoutonImg" name="UpdateTicket" type="submit"><img src="/MPTickets/Images/UpdateArrow.png" id="ImgUpdate" title="Mettre à jour le ticket" height="65" alt="" ></button></td>
			</tr>
			<tr>
				<td colspan="3"><label id="NumTicket" for="NumTicket">N° Ticket : </label><input readonly type="text" id="NumTicket" name="NumTicket" value="<?php echo $currentNumTicket; ?>" </td>
			</tr>
			<tr>
				<td class="TdCol_1"><label for="statusTicket">Status du Ticket : </label></td>
				<td class="TdCol_2"><input disabled type="text" name="statusTicket" class="Disable" id="statusTicket" value="<?php echo $TicketStatu[2]; ?>" /></td>
		
				<td class="TdCol_3"><label for="Depanneur">Dépanneur : </label></td>
				<td class="TdCol_4"><select name="Depanneur" id="Depanneur">
								<?php import_ManageTicketDepanneur($currentNumTicket); ?>
							</select>
			</tr>
			<tr>
				<td class="TdCol_1"><label for="Demandeur">Demandeur : </label></td>
				<td class="TdCol_2"><input disabled type="text" name="Demandeur" class="Disable" id="Demandeur" value="<?php import_TicketDemandeur($currentNumTicket); ?>" /></td>

				<td class="TdCol_3"><label for="TelDemandeur">Téléphone Demandeur : </label></td>
				<td class="TdCol_4"><input disabled type="text" name="TelDemandeur" class="Disable" id="TelDemandeur" value="<?php import_TicketNumeroTelDemandeur($currentNumTicket); ?>" /></td>
			</tr>
			<tr>
				<td class="TdCol_1 Separation-border-bottom"><label for="Departement">Département : </label></td>
				<td class="TdCol_2 Separation-border-bottom"><input disabled type="text" name="Departement" class="Disable" id="Departement" value="<?php import_TicketDepartement($currentNumTicket); ?>" /></td>
				<td class="TdCol_3 Separation-border-bottom"><label for="Localisation">Localisation : </label></td>
				<td class="TdCol_4 Separation-border-bottom"><input disabled type="text" name="Localisation" class="Disable" id="Localisation" value="<?php import_TicketLocalisation($currentNumTicket); ?>" /></td>
			</tr>
			<tr>
				<td class="TdCol_1 Separation-border-top"><label for="DateOuverture">Date d'ouverture : </label></td>
				<td class="TdCol_2 Separation-border-top"><input disabled type="text" name="DateOuverture" class="Disable" id="DateOuverture" value="<?php import_TicketDateOuverture($currentNumTicket); ?>" /></td>
				<td class="TdCol_3 Separation-border-top"><label for="DateFermeture">Date de fermeture : </label></td>
				<td class="TdCol_4 Separation-border-top"><input disabled type="text" name="DateFermeture" class="Disable" id="DateFermeture" value="<?php import_TicketDateFermeture($currentNumTicket); ?>" /></td>
			</tr>
			<tr>
				<td class="TdCol_1"><label for="NoMateriel">Nom du matériel (Problème) : </label></td>
				<td class="TdCol_2"><input type="text" name="NoMateriel" id="NoMateriel" value="<?php import_TicketNomMachineProbleme($currentNumTicket); ?>" /></td>
				<td class="TdCol_3"><label for="DateProbleme">Date du problème : </label></td>
				<td class="TdCol_4"><input  disabled type="text"  name="DateProbleme" class="Disable" id="DateProbleme" value="<?php import_TicketDateProbleme($currentNumTicket); ?>" /></td>
			</tr>
			<tr>
				<td class="TdCol_1"><label for="NomPcDemande">Nom du matériel (Demande) : </label></td>
				<td class="TdCol_2"><input disabled type="text" name="NomPcDemande" class="Disable" id="NomPcDemande" value="<?php import_TicketNomMachineCreation($currentNumTicket); ?>"/></td>
				<td class="TdCol_3"><label for="NoMaterielDemande">IP du matériel (Demande) :  </label></td>
				<td class="TdCol_2"><input disabled type="text" name="NoMaterielDemande" class="Disable" id="NoMaterielDemande" value="<?php import_TicketIP($currentNumTicket); ?>"/></td>
			<tr>
				<td class="TdCol_1"><label for="Impact">Impact : </label></td>
				<td class="TdCol_2"><select required name="Impact" id="Impact">
								<?php import_ManageTicketImpact($currentNumTicket);?>
							</select></td>
				<td class="TdCol_3"><label for="Priorite">Priorité : </label></td>
				<td class="TdCol_4"><select required name="Priorite" id="Priorite">
								<?php import_ManageTicketPriorites($currentNumTicket); ?>
							</select></td>
			</tr>
			<tr>
				<td class="TdCol_1"><label for="Categorie">Catégorie : </label><input readonly type="text" id="id_Category" name="id_Category" /></td>
				<td class="TdCol_2" colspan="2"><input required class="readonly" type="text" name="Categorie" id="Categorie" value="<?php import_CategoriesInput($currentNumTicket) ?>" title="Veuillez choisir la catégorie à l'aide du bouton à droite" /> <button type="button" class="btn btn-primary Bouton-Category" data-toggle="modal" data-target="#PopupCategorie"><i class="fas fa-server"></i></button></td>
			</tr>
			<tr>
				<td class="TdCol_1"><label for="Description">Description : </label></td>
				<td class="TdCol_2" colspan="3"><p class="Disable" id="Description"> <?php import_TicketDescription($currentNumTicket); ?> </p></td>
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
				<td class="TdCol_1"></td>
				<td class="TdCol_2" colspan="3">
					<table id="Table_Button">
						<tr class="TrButton">
							<td class="Td_Button"><button class="Bouton Manage-Button" name="addComments" type="submit" title="Ajouter un commentaire au ticket">Add Commentaire</button> </td>
							<td class="Td_Button"><button class="Bouton Manage-Button" name="Suspend" type="submit" title="<?php echo $StatusBouton ?> le ticket"><?php echo $StatusBouton ?></button></td>
							<td class="Td_Button"><button class="Bouton Manage-Button" name="Resolve" type="submit" title="Résoudre le ticket">Résoudre</button></td>
						</tr>
					</table>
				</td>
			</tr>
		</form>
	</table>
</div>

<!-- Le Popup -->
<div class="modal fade" id="PopupCategorie" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Catégories</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<!-- Création du formulaire -->
			<form id="formlulaire" method="post" action="">
				<div class="modal-body">
					<?php echo create_MenuCategories(); ?>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" name="But-Category" data-dismiss="modal">Choisir</button>
				</div>
			</form>
		</div>
	</div>
</div>


<?php 
include($_SERVER['DOCUMENT_ROOT']."/MPTickets/includes/footer.php");
?>