<?php

$NoAuthentificationPage = true;

	$errorMsg=''; // Message d'erreur

	// Cela vient du bouton Submit
	if(isset($_POST['Submit'])){
		
		// vérifier que les deux mots de passe correspondent
		if($_POST['Password'] === $_POST['RepeterMotPasse'])
		{
			// Retourner sur la page création User
			include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/insertUser.php");
			exit;
		}
		else {
			$errorMsg='Les mots de passe ne correspondent pas';
		}
	}
	

	include($_SERVER['DOCUMENT_ROOT']."/MPTickets/includes/header.php");
?>

<link rel="stylesheet" href="/MPTickets/css/cssCreationUser.css"/>

<div class="Formulaire marge-bottom">
	<!-- Création du formulaire en format Tableau -->
	<table id="tableForm">
		<form id="formlulaire" method="post" action="">
			<tr>
				<td><a href="./dashboardUsersPage.php" ><img src="/MPTickets/Images/backArrow.png" class="ImgBack" title="Retour à la page précédente" height="45" alt="Retour"></a></td>
				<td colspan="3"><h1>Création d'un utilisateur</h1></td>
			</tr>
			<tr>
				<td colspan="2"><p><?php echo $errorMsg; ?></p></td>
			</tr>
			<tr>
				<td class="TdCol_1"><label for="Prenom">*Prénom : </label></td>
				<td class="TdCol_2"><input required type="text" name="Prenom" id="Prenom"/></td>
				<td class="TdCol_3"><label for="Departement">*Départements : </label></td>
				<td class="TdCol_4"><select required type="text" name="Departement" id="Departement"> 
					<?php import_Departements(); ?>
					</select></td>
			</tr>
			<tr>
				<td class="TdCol_1 Separation-border-bottom"><label for="Nom">*Nom : </label></td>
				<td class="TdCol_2 Separation-border-bottom"><input required name="Nom" id="Nom"/></td>

				<td class="TdCol_3 Separation-border-bottom"><label for="Droit">*Droits : </label></td>
				<td class="TdCol_4 Separation-border-bottom"><select required type="text" name="Droit" id="Droit"> 
					<?php import_Droits(); ?>
					</select></td>
			</tr>
			<tr>
				<td class="TdCol_1 Separation-border-top"><label for="NoTelephoneFixe">*N° de téléphone fixe : </label></td>
				<td class="TdCol_2 Separation-border-top"><input required type="text" name="NoTelephoneFixe" id="NoTelephoneFixe"/></td>
				<td class="TdCol_3 Separation-border-top"><label for="NoTelephonePortable">*N° de téléphone portable : </label></td>
				<td class="TdCol_4 Separation-border-top"><input required type="text" name="NoTelephonePortable" id="NoTelephonePortable"/></td>
			</tr>
			<tr>
				<td class="TdCol_1"><label for="Email">*Email : </label></td>
				<td class="TdCol_2"><input required type="text" name="Email" id="Email"/></td>
				<td class="TdCol_3"><label for="Login">*Login : </label></td>
				<td class="TdCol_4"><input required type="text" name="Login" id="Login"/></td>
			</tr>
		
			<tr>
				<td class="TdCol_1"></td>
				<td class="TdCol_2"></td>
				<td class="TdCol_3"><label for="Password">*Password : </label></td>
				<td class="TdCol_2"><input required type="Password" name="Password" id="Password"/></td>
			</tr>
			<tr>
				<td class="TdCol_1"></td>
				<td class="TdCol_2"></td>
				<td class="TdCol_3"><label for="RepeterMotPasse">*Répéter le mot de passe : </label></td>
				<td class="TdCol_4"><input required type="password" name="RepeterMotPasse" id="RepeterMotPasse"/></td>
			</tr>
			
			
			<tr>
				<td class="TdCol_1"></td>
				<td class="TdCol_2"><button class="Bouton" type="reset">Annuler</button></td>
				<td class="TdCol_3"></td>
				<td class="TdCol_4"><button class="Bouton" name="Submit" type="submit">Terminer</button></td>
			</tr>
		</form>
	</table>
</div>


<?php 
include($_SERVER['DOCUMENT_ROOT']."/MPTickets/includes/footer.php");
?>