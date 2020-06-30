<?php
	// Ajout la variable pour enlever l'authentification
	// Doit être mis avant importation du header
	$NoAuthentificationPage = true;

    include($_SERVER['DOCUMENT_ROOT']."/MPTickets/includes/header.php");

	// Message d'erreur
	// Si $errorMsg n'existe pas
	if(!empty($_GET['error']))
	{
		switch($_GET['error'])
		{
			case 1 : 
				$errorMsg = "Le formulaire n'a pas été entièrement rempli !!!";
				break;

			case 2 :
				$errorMsg = "Erreur avec le Captcha !!!";
				break;
		}
		// Récupérer les variables
		$Demandeur = $_SESSION['Demandeur'];
		$TelDemandeur = $_SESSION['TelDemandeur'];
		$NoMateriel = $_SESSION['NoMateriel'];
		$id_Category = $_SESSION['id_Category'];
		$Categorie = $_SESSION['Categorie'];
		$DateProbleme = $_SESSION['DateProbleme'];
		$Localisation = $_SESSION['Localisation'];
		$Description = $_SESSION['Description'];
	}
	else{
	// Initialiser les variables à zéro
	$errorMsg =	$Demandeur = $TelDemandeur = $NoMateriel = $id_Category = $Categorie = $DateProbleme = $Localisation = $Description = '';	
	}
?>

 <link rel="stylesheet" type="text/css" href="/MPTickets/css/cssCreationTicketPage.css"/>

<div class="Formulaire marge-bottom">
	<h1><center>Création d'un ticket<center></h1>
	<h3>N° Ticket: <?php echo create_NumDailyTickets(); ?> </h3>
	<?php echo $errorMsg; ?>
	
	<!-- Création du formulaire en format Tableau -->
	<table id="tableForm">
		<form id="formlulaire" method="post" action="../BD/insertTicket.php">  
			<tr>
				<td class="TdCol_1"><label for="Demandeur">*Demandeur : </label></td>
				<td class="TdCol_2"><input  type="text" name="Demandeur" id="Demandeur" placeholder="Ex : Dylan Guiducci" value="<?php echo $Demandeur; ?>"/></td>
				<td class="TdCol_3"><label for="TelDemandeur">*Téléphone Demandeur : </label></td>
				<td class="TdCol_4"><input required type="text" name="TelDemandeur" id="TelDemandeur" placeholder="+41 21 544 38 48" value="<?php echo $TelDemandeur; ?>" title="+41XX XXX XX XX" pattern="\+?\d{2,4} \d{3} \d{2} \d{2}"/></td>
			</tr>
			<tr>
				<td class="TdCol_1 Separation-border-bottom"><label for="Departement">*Département : </label></td>
				<td class="TdCol_2 Separation-border-bottom"><select required name="Departement" id="Departement">
					<?php import_Departements(); ?>
					</select>
				</td>
				<td class="TdCol_3 Separation-border-bottom"><label for="Localisation">*Localisation : </label></td>
				<td class="TdCol_4 Separation-border-bottom"><input required type="text" name="Localisation" id="Localisation" value="<?php echo $Localisation; ?>" placeholder="Ex : Funky Claude's Bar"/></td>
			</tr>
			<tr>
				<td class="TdCol_1 Separation-border-top"><label for="NoMateriel">*N° du matériel : </label></td>
				<td class="TdCol_2 Separation-border-top"><input required type="text" name="NoMateriel" id="NoMateriel" value="<?php echo $NoMateriel; ?>" placeholder="Ex : PC160065"/></td>
				<td class="TdCol_3 Separation-border-top"><label for="DateProbleme">*Date du problème : </label></td>
				<td class="TdCol_4 Separation-border-top"><input required type="datetime-local" name="DateProbleme" id="DateProblemeInsert" value="<?php echo $DateProbleme; ?>"/></td>
			</tr>
			<?php
				// Récupérer l'adresse IP du matériel qui a fait la requête
				$ip = $_SERVER["REMOTE_ADDR"];
				$host = gethostbyaddr($ip);
			?>
			<tr>
				<td class="TdCol_1"><label for="NomPcDemande">Nom du matériel (Demande) : </label></td>
				<td class="TdCol_2"><input disabled type="text" name="NomPcDemande" id="NomPcDemande" value="<?php echo $host ?>"/></td>
				<td class="TdCol_3"><label for="IpMaterielDemande">IP du matériel (Demande) : </label></td>
				<td class="TdCol_2"><input disabled type="text" name="IpMaterielDemande" id="IpMaterielDemande" value="<?php echo $ip ?>"/></td>
			</tr>
			<tr>
				<td class="TdCol_1"><label for="Impact">*Impact : </label></td>
				<td class="TdCol_2"><select required name="Impact" id="Impact">
						<?php import_Impacts();?>
					</select></td>
			</tr>
			<tr>
				<td class="TdCol_1"><label for="Priorite">*Priorité : </label></td>
				<td class="TdCol_2"><select required name="Priorite" id="Priorite">
						<?php import_Priorites(); ?>
					</select></td>
			</tr>
			<tr>
				<td class="TdCol_1"><label for="Categorie">*Catégorie : </label><input readonly type="text" id="id_Category" name="id_Category" value="<?php echo $id_Category; ?>" /></td>
				<td class="TdCol_2" colspan="2"><input required class="readonly" type="text" name="Categorie" id="Categorie"  value="<?php echo $Categorie; ?>" title="Veuillez choisir la catégorie à l'aide du bouton à droite" /> <button type="button" class="btn btn-primary Bouton-Category" data-toggle="modal" data-target="#PopupCategorie"><i class="fas fa-server"></i></button></td>
			</tr>
			<tr>
				<td class="TdCol_1"><label for="Description">*Description : </label></td>
				<td class="TdCol_2" colspan="3"><textarea required id="Description" name="Description" value="<?php echo $Description; ?>" rows="10" cols="80"></textarea></td>
			</tr>
			<tr>
				<td class="TdCol_1"></td>
				<td class="TdCol_2"><button class="Bouton" type="reset">Annuler</button></td>
				<td class="TdCol_3"></td>
				<td class="TdCol_4"><button class="Bouton" type="button" data-toggle="modal" data-target="#PopupCaptcha">Suivant</button></td>
			</tr>

			<!-- Le Popup Captcha -->
			<div class="modal fade" id="PopupCaptcha" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">Captcha</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<!-- Création du formulaire -->
						<div class="modal-body">
							<!-- Importer le code Captcha -->
							<img src="../BD/captcha.php" /> <input required type="text" name="Captcha" id="Captcha">
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary" name="But-Category">Terminer</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</table>
</div>

<!-- Le Popup Categorie -->
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