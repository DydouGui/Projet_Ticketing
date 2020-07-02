<?php
	// Cela vient du bouton ajouter UpdateUser
	if(isset($_POST['UpdateUser'])){
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/updateUser.php");
		exit;
	}

	// Cela vient du bouton ajouter resetPassword
	if(isset($_POST['resetPassword'])){
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/updateUserPassword.php");
		exit;
	}
	
	include($_SERVER['DOCUMENT_ROOT']."/MPTickets/includes/header.php");
	
	$currentUser = $_GET['Login'];

	// Importer les infos du user
	$DonneesUser = import_UserInfo($currentUser);
?>

<link rel="stylesheet" href="/MPTickets/css/cssCreationTicketPage.css"/>

<div class="Formulaire">
	
	<!-- Creation du formulaire en format Tableau -->
	<table id="tableForm">
		<form id="form-managePassword" method="post" action="">
			<tr>
				<td id="TdImgRefresh"><a href="./dashboardUsersPage.php" ><img src="/MPTickets/Images/backArrow.png" class="ImgBack" title="Retour à la page précédente" height="45" alt="Retour"></a><img src="/MPTickets/Images/RefreshArrow.png" id="ImgRefresh" title="Raffraîchir la page" height="45" alt="Refresh" onClick="document.location.reload(false)"></td>
				<td colspan="2"><h1><center>Mange User</center></h1></td>
				<td rowspan="2" id="TdImgUpdate"><button class="BoutonImg" name="UpdateUser" type="submit"><img src="/MPTickets/Images/UpdateArrow.png" id="ImgUpdate" title="Mettre à jour le ticket" height="65" alt="" ></button></td>
			</tr>
			<tr>
				<td colspan="3"><label id="LoginUtilisateur" for="LoginUtilisateur">Login Utilisateur : </label><input readonly type="text" id="LoginUtilisateur" name="LoginUtilisateur" value="<?php echo $currentUser; ?>" </td>
			</tr>
			<tr>
				<td class="TdCol_1"><label for="Prenom">Prénom : </label></td>
				<td class="TdCol_2"><input disabled class="Disable" type="text" name="Prenom" id="Prenom" value="<?php echo $DonneesUser[1]; ?>" /></td>
		
				<td class="TdCol_3"><label for="Departement">Département : </label></td>
				<td class="TdCol_4"><select name="Departement" id="Departement">
								<?php import_ManageUserDepartements($currentUser); ?>
							</select></td>
			</tr>
			<tr>
				<td class="TdCol_1"><label for="Nom">Nom : </label></td>
				<td class="TdCol_2"><input disabled class="Disable" type="text" name="Nom" id="Nom" value="<?php echo $DonneesUser[2]; ?>" /></td>
				<td class="TdCol_3"><label for="Droit">Droit : </label></td>
				<td class="TdCol_4"><select name="Droit" id="Droit">
								<?php import_ManageUserDroits($currentUser); ?>
							</select></td>
			</tr>
			<tr>
				<td class="TdCol_1"><label for="NoTelephoneFixe">N° de téléphone fixe : </label></td>
				<td class="TdCol_2"><input required type="text" name="NoTelephoneFixe" id="NoTelephoneFixe" value="<?php echo $DonneesUser[3];; ?>" /></td>
				<td class="TdCol_3"><label for="NoTelephonePortable">N° de téléphone portable : </label></td>
				<td class="TdCol_4"><input type="text" name="NoTelephonePortable" id="NoTelephonePortable" value="<?php echo $DonneesUser[4]; ?>" /></td>
			</tr>
			<tr>
				<td class="TdCol_1"><label for="Email">Email : </label></td>
				<td class="TdCol_2"><input required type="text" name="Email" id="Email" value="<?php echo $DonneesUser[5]; ?>" /></td>
			</tr>
			<tr>
				<td class="TdCol_1 Separation-border-bottom"><label for="Login">Login : </label></td>
				<td class="TdCol_2 Separation-border-bottom"><input disabled class="Disable" type="text" name="Login" id="Login" value="<?php echo $DonneesUser[0];; ?>" /></td>
				<td class="TdCol_3 Separation-border-bottom"><label for="Password">Mot de passe :  </label></td>
				<td class="TdCol_4 Separation-border-bottom"><input required type="Password" name="Password" id="Password" /></td>
			</tr>
		</form> <!-- Fermeture du 1er formulaire -->
			<tr>
				<td colspan="4">
					<center>
						<table id="Table-resetPassword">
							<form id="form-resetPassword" method="post" action="">
								<tr>
									<td colspan="3" class=""><h2><center>Réinitialiser le mot de passe<br> de : <input readonly type="text" id="LoginUtilisateur" name="LoginUtilisateur" value="<?php echo $currentUser; ?>"</center></h3></td>
								</tr>
								<tr>
									<td rowspan="2"><center><button class="Bouton Manage-Button" name="resetPassword" type="submit" title="Réinitialiser le mot de passe">Réinitialiser <i class="fas fa-key"></i></button></center></td>
									<td class="Td-resetPassword"><label for="newPassword">Nouveau mot de passe : </label></td>
									<td class="Td-resetPassword"><input required type="Password" name="newPassword" id="newPassword" /></td>
								</tr>
								<tr>
									<td class="Td-resetPassword"><label for="newPassword2">Répéter le mot de passe :  </label></td>
									<td class="Td-resetPassword"><input required type="Password" name="newPassword2" id="newPassword2" /></td>
								</tr>
							</form>
						</table>
					</center>
				</td>
			</tr>
		
	</table>
</div>

<?php 
include($_SERVER['DOCUMENT_ROOT']."/MPTickets/includes/footer.php");
?>