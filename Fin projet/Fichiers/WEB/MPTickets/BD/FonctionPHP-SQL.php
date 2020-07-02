<?php
// **************************************************************************************************************
// **************************************** Variable ************************************************************
// **************************************************************************************************************
	
	$dbname='MPTicket'; // Nom de la base de Données
	$dbuser='MPTicket'; // Nom de l'utilisateur
	$dbpass='R0ge1r0-M0dule151'; // Mot de passe
	$dbhost='localhost'; // Emplacement de la base de données
	
// **************************************************************************************************************
// **************************************** CONNECTION / CLOSE DATABASE *****************************************
// **************************************************************************************************************
	
	// Fonction : Connexion au serveur
	function connect_SVR()
	{
		// Definir les variables en-tant que global
		global $dbhost, $dbuser, $dbpass;
		
		// Connexion au serveur
		$fun_link = mysqli_connect($dbhost, $dbuser, $dbpass) or die("Erreur de connexion au serveur base de données "." | ".$dbhost." | ".$dbuser." | ".$dbpass);
		
		return $fun_link;
	}
	
	// Fonction : Connexion à la base de données
	function connect_DB()
	{
		global $link;
		// Appeler la fonction connect_SVR pour se connecter au serveur
		$link = connect_SVR();

		// Se connecter à la base de données
		mysqli_select_db($link, $dbname) or die("Base de données pas trouvée");
	}
	
	// Function : Fermer les liaisons avec la DB
	function close_DB()
	{
		global $link;
		mysqli_close($link);
	}
	
// **************************************************************************************************************
// **************************************** IMPORT **************************************************************
// **************************************************************************************************************


	// Fonction importer les Dépanneurs
	function import_Depanneurs()
	{
		// On se connecter à la base de données
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

		// On récupère tout le contenu de la table Dépanneur
		$query = "SELECT id_utilisateur, Prenom, Nom FROM T_Utilisateurs";
		$result = mysqli_query($link,$query);
		 
		// On affiche chaque entrée une à une
		while ($donnees = mysqli_fetch_row($result)){
			echo '<option value="'.$donnees[0].'">'.$donnees[1].", ".$donnees[2].'</option>'; //ou bien $donnees['monchamp']
		}
		
		// Termine le traitement de la requête
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
	}
	
	// Fonction importer le Dépanneur du ticket
	function import_TicketDepanneur($fun_numTicket)
	{
		// On se connecte à MySQL
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

		// On récupère le numéro de ticket avec son statu
		$query = 'SELECT T.id_ticket, U.Prenom, U.Nom
				FROM T_Tickets AS T
				INNER JOIN T_Utilisateurs AS U
				ON T.fk_id_utilisateur_depanneur = U.id_utilisateur
                WHERE T.id_ticket = "'.$fun_numTicket.'"';
		$result = mysqli_query($link,$query);
		
		// Ajouter le resultat dans une variable
		$donnees = mysqli_fetch_row($result);
		
		// Afficher le resultat
		echo $donnees[1]." ".$donnees[2];
		
		// Termine le traitement de la requête
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
	}
	
	// Fonction importer tous les Dépanneur et présectionner celui du ticket
	function import_ManageTicketDepanneur($fun_numTicket)
	{
		// On se connecte à MySQL
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

		// On récupère le numéro de ticket avec son dépanneur
		$query = 'SELECT T.id_ticket, U.id_utilisateur, U.Prenom, U.Nom
				FROM T_Tickets AS T
				INNER JOIN T_Utilisateurs AS U
				ON T.fk_id_utilisateur_depanneur = U.id_utilisateur
                WHERE T.id_ticket = "'.$fun_numTicket.'"';
		$result = mysqli_query($link,$query);
		
		// Ajouter le resultat dans une variable
		$donnees = mysqli_fetch_row($result);
		
		// stocker l'ID de celui qui est déjà écrit
		$IdPrecedent = $donnees[1];
		
		// Si le ticket n'a pas de dépanneur afficher VIDE
		if(empty($donnees)){
			echo '<option selected value=""></option>';
		}
		// Sinon afficher son dépanneur
		else{
			// Afficher le resultat
			echo '<option selected value="'.$donnees[1].'">'.$donnees[2].', '.$donnees[3].'</option>';
		}
		
		// On récupère tout le contenu de la table Utilisateur
		$query = "SELECT id_utilisateur, Prenom, Nom FROM T_Utilisateurs";
		$result = mysqli_query($link,$query);
		 
		// On affiche chaque entrée une à une sauf celui qui est déjà écrit
		while ($donnees = mysqli_fetch_row($result)){
			// Si n'est pas égal à celui qui est enregistrer
			if($IdPrecedent != $donnees[0]){				
				echo '<option value="'.$donnees[0].'">'.$donnees[1].', '.$donnees[2].'</option>'; //ou bien $donnees['monchamp']
			}
		}
		
		// Termine le traitement de la requête
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
	}

	// Fonction importer les Impacts de la BD
	function import_Impacts()
	{
		// On se connecte à MySQL
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

		// On récupère tout le contenu de la table Impact
		$query = "SELECT * FROM T_Impacts";
		$result = mysqli_query($link,$query);
		 
		// On affiche chaque entrée une à une
		while ($donnees = mysqli_fetch_row($result)){
			echo '<option value="'.$donnees[0].'">'.$donnees[1]." - ".$donnees[2].'</option>'; //ou bien $donnees['monchamp']
		}
		
		// Termine le traitement de la requête
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
	}

	// Fonction importer l'impact du ticket
	function import_TicketImpact($fun_numTicket)
	{
		// On se connecte à MySQL
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

		// On récupère le numéro de ticket avec son impact
		$query = 'SELECT T.id_ticket, I.Impact, I.Description_impact
				FROM T_Tickets AS T
				INNER JOIN T_Impacts AS I
				ON T.fk_id_impact = I.id_impact
                WHERE T.id_ticket = "'.$fun_numTicket.'"';
		$result = mysqli_query($link,$query);
		
		// Ajouter le resultat dans une variable
		$donnees = mysqli_fetch_row($result);
		
		// Afficher le resultat
		echo $donnees[1];
		
		// Termine le traitement de la requête
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
	}
	
	// Fonction importer tous les Impacts et présectionner celui du ticket
	function import_ManageTicketImpact($fun_numTicket)
	{
		// On se connecte à MySQL
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

		// On récupère le numéro de ticket avec son impact
		$query = 'SELECT T.id_ticket, I.id_impact, I.Impact, I.Description_impact
				FROM T_Tickets AS T
				INNER JOIN T_Impacts AS I
				ON T.fk_id_impact = I.id_impact
                WHERE T.id_ticket = "'.$fun_numTicket.'"';
		$result = mysqli_query($link,$query);
		
		// Ajouter le resultat dans une variable
		$donnees = mysqli_fetch_row($result);
		
		// stocker l'ID de celui qui est déjà écrit
		$IdPrecedent = $donnees[1];
		
		// Afficher le resultat
		echo '<option selected value="'.$donnees[1].'">'.$donnees[2].'</option>';
		
		// On récupère tout le contenu de la table Impact sans le précédent
		$query = "SELECT * FROM T_Impacts";
		$result = mysqli_query($link,$query);
		 
		// On affiche chaque entrée une à une
		while ($donnees = mysqli_fetch_row($result)){
			// Si n'est pas égal à celui qui est enregistrer
			if($IdPrecedent != $donnees[0]){				
				echo '<option value="'.$donnees[0].'">'.$donnees[1].'</option>'; //ou bien $donnees['monchamp']
			}
		}
		
		// Termine le traitement de la requête
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
	}
	
	// Fonction importer les Impacts de la BD
	function import_Status()
	{
		// On se connecte à MySQL
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

		// On récupère tout le contenu de la table Impact
		$query = "SELECT * FROM T_Status";
		$result = mysqli_query($link,$query);
		 
		// On affiche chaque entrée une à une
		while ($donnees = mysqli_fetch_row($result)){
			echo '<option value="'.$donnees[0].'">'.$donnees[1].'</option>'; //ou bien $donnees['monchamp']
		}
		
		// Termine le traitement de la requête
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
	}
	
	function import_TicketStatu($fun_numTicket)
	{
		// On se connecte à MySQL
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

		// On récupère le numéro de ticket avec son statu
		$query = 'SELECT T.id_ticket, S.id_Status, S.Status
				FROM T_Tickets AS T
				INNER JOIN T_Status AS S
				ON T.fk_id_status = S.id_status
				WHERE T.id_ticket = "'.$fun_numTicket.'"';
		$result = mysqli_query($link,$query);
		
		// Ajouter le resultat dans une variable
		$donnees = mysqli_fetch_row($result);
		
		// Renvoie le tableau
		return $donnees;
		
		// Termine le traitement de la requête
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
	}

// Fonction importer les Droits
function import_Droits()
{
	// On se connecte à MySQL
	include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

	// On récupère tout le contenu de la table Impact
	$query = "SELECT * FROM T_Droits";
	$result = mysqli_query($link,$query);
 
	// On affiche chaque entrée une à une
	while ($donnees = mysqli_fetch_row($result)){
		echo '<option value="'.$donnees[0].'">'.$donnees[1].'</option>'; //ou bien $donnees['monchamp']
	}

	// Termine le traitement de la requête
	include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
}

function import_UtilisateurDroits($fun_numTicket)
{
	// On se connecte à MySQL
	include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

	// On récupère le numéro de ticket avec son Departement
	$query = 'SELECT T.id_utilisateur, D.Niveau_droit
			FROM T_Utilisateurs AS T
			INNER JOIN T_Droits AS D
			ON T.fk_droit = D.id_droit;
		';
	$result = mysqli_query($link,$query);
	
	// Ajouter le resultat dans une variable
	$donnees = mysqli_fetch_row($result);
	
	// Afficher le resultat
	echo $donnees[1];
	
	// Termine le traitement de la requête
	include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
}
	
	// Fonction Importer les Priorités
	function import_Priorites()
	{
		// On se connecte à MySQL
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

		// On récupère tout le contenu de la table Impact
		$query = "SELECT * FROM T_Priorites";
		$result = mysqli_query($link,$query);
		 
		// On affiche chaque entrée une à une
		while ($donnees = mysqli_fetch_row($result)){
			echo '<option value="'.$donnees[0].'">'.$donnees[1]." - ".$donnees[2].'</option>'; //ou bien $donnees['monchamp']
		}
		
		// Termine le traitement de la requête
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
	}
	
	// Fonction importer la priorité du ticket
	function import_TicketPriorite($fun_numTicket)
	{
		// On se connecte à MySQL
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

		// On récupère le numéro de ticket avec son statu
		$query = 'SELECT T.id_ticket, P.Priorite, P.Description_priorite
				FROM T_Tickets AS T
				INNER JOIN T_Priorites AS P
				ON T.fk_id_priorite = P.id_priorite
                WHERE T.id_ticket = "'.$fun_numTicket.'"';
		$result = mysqli_query($link,$query);
		
		// Ajouter le resultat dans une variable
		$donnees = mysqli_fetch_row($result);
		
		// Afficher le resultat
		echo $donnees[1];
		
		// Termine le traitement de la requête
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
	}
	
	// Fonction importer tous les Priorités et présectionner celui du ticket
	function import_ManageTicketPriorites($fun_numTicket)
	{
		// On se connecte à MySQL
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

		// On récupère le numéro de ticket avec son statu
		$query = 'SELECT T.id_ticket, P.id_priorite, P.Priorite, P.Description_priorite
				FROM T_Tickets AS T
				INNER JOIN T_Priorites AS P
				ON T.fk_id_priorite = P.id_priorite
                WHERE T.id_ticket = "'.$fun_numTicket.'"';
		$result = mysqli_query($link,$query);
		
		// Ajouter le resultat dans une variable
		$donnees = mysqli_fetch_row($result);
		
		// stocker l'ID de celui qui est déjà écrit
		$IdPrecedent = $donnees[1];
		
		// Afficher le resultat
		echo '<option selected value="'.$donnees[1].'">'.$donnees[2].'</option>';
		
		// On récupère tout le contenu de la table Impact sans le précédent
		$query = "SELECT * FROM T_Priorites";
		$result = mysqli_query($link,$query);
		 
		// On affiche chaque entrée une à une
		while ($donnees = mysqli_fetch_row($result)){
			// Si n'est pas égal à celui qui est enregistrer
			if($IdPrecedent != $donnees[0]){				
				echo '<option value="'.$donnees[0].'">'.$donnees[1].'</option>'; //ou bien $donnees['monchamp']
			}
		}
		
		// Termine le traitement de la requête
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
	}
	
	// Fonction importer les Départements
	function import_Departements()
	{
		// On se connecte à MySQL
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

		// On récupère tout le contenu de la table Impact
		$query = "SELECT * FROM T_Departements";
		$result = mysqli_query($link,$query);
	 
		// On affiche chaque entrée une à une
		while ($donnees = mysqli_fetch_row($result)){
			echo '<option value="'.$donnees[0].'">'.$donnees[1].'</option>'; //ou bien $donnees['monchamp']
		}
	
		// Termine le traitement de la requête
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
	}
	
	function import_TicketDepartement($fun_numTicket)
	{
		// On se connecte à MySQL
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

		// On récupère le numéro de ticket avec son Departement
		$query = 'SELECT T.id_ticket, D.Departement
				FROM T_Tickets AS T
				INNER JOIN T_Departements AS D
				ON T.fk_id_departement = D.id_departement
				WHERE T.id_ticket = "'.$fun_numTicket.'"';
		$result = mysqli_query($link,$query);
		
		// Ajouter le resultat dans une variable
		$donnees = mysqli_fetch_row($result);
		
		// Afficher le resultat
		echo $donnees[1];
		
		// Termine le traitement de la requête
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
	}
	
	// Fonction importer le Demandeur du ticket
	function import_TicketDemandeur($fun_numTicket)
	{
		// On se connecte à MySQL
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

		// On récupère tout le contenu de la table Impact
		$query = 'SELECT T.Utilisateur_demandeur
					FROM T_Tickets AS T
					WHERE T.id_ticket = "'.$fun_numTicket.'"';
		$result = mysqli_query($link,$query);
		
		$donnees = mysqli_fetch_row($result);
		
		// Afficher le resultat
		echo $donnees[0];
	
		// Termine le traitement de la requête
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
	}
	
	// Fonction importer le téléphone du Demandeur du ticket
	function import_TicketNumeroTelDemandeur($fun_numTicket)
	{
		// On se connecte à MySQL
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

		// On récupère tout le contenu de la table Impact
		$query = 'SELECT T.Numero_tel_demandeur
					FROM T_Tickets AS T
					WHERE T.id_ticket = "'.$fun_numTicket.'"';
		$result = mysqli_query($link,$query);
		
		$donnees = mysqli_fetch_row($result);
		
		// Afficher le resultat
		echo $donnees[0];
	
		// Termine le traitement de la requête
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
	}
	
	// Fonction importer le Localisation du Demandeur du ticket
	function import_TicketLocalisation($fun_numTicket)
	{
		// On se connecte à MySQL
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

		// On récupère tout le contenu de la table Impact
		$query = 'SELECT T.Localisation
					FROM T_Tickets AS T
					WHERE T.id_ticket = "'.$fun_numTicket.'"';
		$result = mysqli_query($link,$query);
		
		$donnees = mysqli_fetch_row($result);
		
		// Afficher le resultat
		echo $donnees[0];
	
		// Termine le traitement de la requête
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
	}

	// Fonction importer le description du ticket
	function import_TicketDescription($fun_numTicket)
	{
		// On se connecte à MySQL
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

		// On récupère tout le contenu de la table Impact
		$query = 'SELECT T.Description_ticket
					FROM T_Tickets AS T
					WHERE T.id_ticket = "'.$fun_numTicket.'"';
		$result = mysqli_query($link,$query);
		
		$donnees = mysqli_fetch_row($result);
		
		// Afficher le resultat
		echo $donnees[0];
	
		// Termine le traitement de la requête
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
	}
	
	// Fonction importer la date d'ouverture du ticket
	function import_TicketDateOuverture($fun_numTicket){
			
		// On se connecte à MySQL
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

		// On récupère tout le contenu de la table Impact
		$query = 'SELECT T.Date_ouverture
					FROM T_Tickets AS T
					WHERE T.id_ticket = "'.$fun_numTicket.'"';
		$result = mysqli_query($link,$query);
		
		$donnees = mysqli_fetch_row($result);
		
		// Afficher le resultat
		echo $donnees[0];
	
		// Termine le traitement de la requête
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
	}
	
	// Fonction importer la date du problème du ticket
	function import_TicketDateProbleme($fun_numTicket){
			
		// On se connecte à MySQL
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

		// On récupère tout le contenu de la table Impact
		$query = 'SELECT T.Date_Probleme
					FROM T_Tickets AS T
					WHERE T.id_ticket = "'.$fun_numTicket.'"';
		$result = mysqli_query($link,$query);
		
		$donnees = mysqli_fetch_row($result);
		
		// Afficher le resultat
		echo $donnees[0];
	
		// Termine le traitement de la requête
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
	}
	
	// Fonction importer la date de fermeture du ticket
	function import_TicketDateFermeture($fun_numTicket){
			
		// On se connecte à MySQL
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

		// On récupère tout le contenu de la table Impact
		$query = 'SELECT T.Date_fermeture
					FROM T_Tickets AS T
					WHERE T.id_ticket = "'.$fun_numTicket.'"';
		$result = mysqli_query($link,$query);
		
		$donnees = mysqli_fetch_row($result);
		
		// Afficher le resultat
		echo $donnees[0];
	
		// Termine le traitement de la requête
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
	}
	
	// Fonction importer l'IP de la création du ticket
	function import_TicketIP($fun_numTicket){
			
		// On se connecte à MySQL
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

		// On récupère tout le contenu de la table Impact
		$query = 'SELECT T.IP
					FROM T_Tickets AS T
					WHERE T.id_ticket = "'.$fun_numTicket.'"';
		$result = mysqli_query($link,$query);
		
		$donnees = mysqli_fetch_row($result);
		
		// Afficher le resultat
		echo $donnees[0];
	
		// Termine le traitement de la requête
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
	}
	
	// Fonction importer le nom de machine qui à créer le ticket
	function import_TicketNomMachineCreation($fun_numTicket){
			
		// On se connecte à MySQL
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

		// On récupère tout le contenu de la table Impact
		$query = 'SELECT T.Nom_machine_creation
					FROM T_Tickets AS T
					WHERE T.id_ticket = "'.$fun_numTicket.'"';
		$result = mysqli_query($link,$query);
		
		$donnees = mysqli_fetch_row($result);
		
		// Afficher le resultat
		echo $donnees[0];
	
		// Termine le traitement de la requête
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
	}
	
	// Fonction importer le nom de la machine qui pose problème du ticket
	function import_TicketNomMachineProbleme($fun_numTicket){
			
		// On se connecte à MySQL
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

		// On récupère tout le contenu de la table Impact
		$query = 'SELECT T.Nom_machine_probleme
					FROM T_Tickets AS T
					WHERE T.id_ticket = "'.$fun_numTicket.'"';
		$result = mysqli_query($link,$query);
		
		$donnees = mysqli_fetch_row($result);
		
		// Afficher le resultat
		echo $donnees[0];
	
		// Termine le traitement de la requête
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
	}
	
	// Fonction importer la solution du ticket
	function import_TicketResolution($fun_numTicket){
			
		// On se connecte à MySQL
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

		// On récupère tout le contenu de la table Impact
		$query = 'SELECT T.Resolution
					FROM T_Tickets AS T
					WHERE T.id_ticket = "'.$fun_numTicket.'"';
		$result = mysqli_query($link,$query);
		
		$donnees = mysqli_fetch_row($result);
		
		// Afficher le resultat
		echo $donnees[0];
	
		// Termine le traitement de la requête
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
	}
	
	// Fonction qui importe les commentaire du ticket
	function import_TicketCommentaire($fun_numTicket){
		
		// On se connecte à MySQL
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

		// On récupère tous les commentaires du ticket en faisant les liens entre les tables
		$query = 'SELECT C.Date_commentaire, T.id_Ticket, U.Nom, U.Prenom, C.Commentaire
					FROM T_Commentaires AS C
					INNER JOIN T_Tickets AS T
					ON C.fk_id_ticket = T.id_ticket
					INNER JOIN T_Utilisateurs AS U
					ON C.fk_id_utilisateur = U.id_utilisateur
					WHERE T.id_ticket="'.$fun_numTicket.'"
					ORDER BY C.Date_commentaire DESC';
		$result = mysqli_query($link,$query);
		
		
		
		// Si le resultat n'est pas vide
		if(mysqli_num_rows($result))
		{
			echo '<tr class="Tr_Com">
								<th class="Th_Com Com_Date">DATE</th>
								<th class="Th_Com Com_Nom">NOM</th>
								<th class="Th_Com Com_Com">COMMENTAIRE</th>
							</tr>';

			// On affiche chaque entrée une à une
			while ($donnees = mysqli_fetch_row($result)){
				echo '<tr class="Tr_Com">
						<td class="Td_Com"><p class="P_Com Com_Date">'.$donnees[0].'</p></td>
						<td class="Td_Com"><p class="P_Com Com_Nom">'.$donnees[2].' '.$donnees[3].'</p></td>
						<td class="Td_Com"><p class="P_Com Com_Com">'.$donnees[4].'</p></td>
					</tr>';
			}
		}
		// Affiche qu'il n'y a pas de comentaire
		else{ echo '<tr><td><a>Aucun commentaire pour ce ticket</a></td></tr>'; }
	
		// Termine le traitement de la requête
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
	}

	// Fonction qui importe le nom du User
	function import_UserInfo($fun_LoginUser)
	{
		// On se connecte à MySQL
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

		// On récupère l'utilisateur 
		$query = 'SELECT Login, Prenom, Nom, Numero_fix, Numero_Mob, Email
				FROM T_Utilisateurs
                WHERE Login = "'.$fun_LoginUser.'"';
		$result = mysqli_query($link,$query);
		// Ajouter le resultat dans une variable
		$donnees = mysqli_fetch_row($result);

		// Retourner les info du user
		return $donnees;
	}

	// Fonction importer tous les Départements et présectionner celui du ticket
	function import_ManageUserDepartements($fun_LoginUser)
	{
		// On se connecte à MySQL
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

		// On récupère l'utilisateur avec son département
		$query = 'SELECT U.Login, D.id_departement, D.Departement
				FROM T_Utilisateurs AS U
				INNER JOIN T_Departements AS D
				ON U.fk_departement = D.id_departement
                WHERE U.Login = "'.$fun_LoginUser.'"';
		$result = mysqli_query($link,$query);
		
		// Ajouter le resultat dans une variable
		$donnees = mysqli_fetch_row($result);
		
		// stocker l'ID de celui qui est déjà écrit
		$IdPrecedent = $donnees[1];
		echo $IdPrecedent;
		// Afficher le resultat
		echo '<option selected value="'.$donnees[1].'">'.$donnees[2].'</option>';
		
		// On récupère tout le contenu de la table Departements sans le précédent
		$query = "SELECT * FROM T_Departements";
		$result = mysqli_query($link,$query);
		 
		// On affiche chaque entrée une à une
		while ($donnees = mysqli_fetch_row($result)){
			// Si n'est pas égal à celui qui est enregistrer
			if($IdPrecedent != $donnees[0]){				
				echo '<option value="'.$donnees[0].'">'.$donnees[1].'</option>'; //ou bien $donnees['monchamp']
			}
		}
		
		// Termine le traitement de la requête
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
	}
	
	// Fonction importer tous les Droits et présectionner celui du ticket
	function import_ManageUserDroits($fun_LoginUser)
	{
		// On se connecte à MySQL
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

		// On récupère l'utilisateur avec son département
		$query = 'SELECT U.Login, D.id_droit, D.Niveau_droit, D.Description_droit
				FROM T_Utilisateurs AS U
				INNER JOIN T_Droits AS D
				ON U.fk_droit = D.id_droit
                WHERE U.Login = "'.$fun_LoginUser.'"';
		$result = mysqli_query($link,$query);
		
		// Ajouter le resultat dans une variable
		$donnees = mysqli_fetch_row($result);
		
		// stocker l'ID de celui qui est déjà écrit
		$IdPrecedent = $donnees[1];
		
		// Afficher le resultat
		echo '<option selected value="'.$donnees[1].'">'.$donnees[2].'</option>';
		
		// On récupère tout le contenu de la table Departements sans le précédent
		$query = "SELECT * FROM T_Droits";
		$result = mysqli_query($link,$query);
		 
		// On affiche chaque entrée une à une
		while ($donnees = mysqli_fetch_row($result)){
			// Si n'est pas égal à celui qui est enregistrer
			if($IdPrecedent != $donnees[0]){				
				echo '<option value="'.$donnees[0].'">'.$donnees[1].'</option>'; //ou bien $donnees['monchamp']
			}
		}
		
		// Termine le traitement de la requête
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
	}

	// Fonction importer tous les tickets dans la page Dashboard
	function import_AllTicket($fun_colSort, $fun_sort)
	{
		// On se connecte à MySQL
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

		// Récupérer les infos des tickets et les trier dans inverse de la création
		$query = 'SELECT T.id_ticket, C.Categorie, P.Priorite, S.Status, T.Utilisateur_demandeur, I.Impact,	T.Date_Probleme
				FROM T_Tickets AS T
				LEFT JOIN T_Priorites AS P ON P.id_priorite = T.fk_id_priorite
				LEFT JOIN T_Categories AS C ON C.id_categorie = T.fk_id_categorie
				LEFT JOIN T_Status AS S ON S.id_status = T.fk_id_status
				LEFT JOIN T_Impacts AS I ON I.id_impact = T.fk_id_impact
                WHERE S.Status IN ("Ouvert", "Suspendu")
				AND T.fk_id_utilisateur_depanneur IS NULL
				ORDER BY '.$fun_colSort.' '.$fun_sort;
		$result = mysqli_query($link, $query);

		// Afficjer le resultat dans le tableau
		while($rows = mysqli_fetch_row($result))
		{
			echo('
				<tr class="TrRow" onclick="document.location.href=\'/MPTickets/body/manageTicketPage.php?idTicket='.$rows[0].'\'">
					<td class="TdCol_1 RowTicket Arrondi-Gauche">'.$rows[0].'</td>
					<td class="TdCol_2 RowTicket">'.$rows[1].'</td>
					<td class="TdCol_3 RowTicket">'.$rows[2].'</td>
					<td class="TdCol_4 RowTicket">'.$rows[3].'</td>
					<td class="TdCol_5 RowTicket">'.$rows[4].'</td>
					<td class="TdCol_6 RowTicket">'.$rows[5].'</td>
					<td class="TdCol_7 RowTicket Arrondi-Droite">'.$rows[6].'</td>
				</tr>');
		}

		// Termine le traitement de la requête
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
	}

	// Fonction importer tous les ticket concerant le dépaneur
	function import_AllMyTicket($fun_colSort, $fun_sort, $fun_username)
	{
		// On se connecte à MySQL
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

		// Récupérer les infos des tickets et les trier dans inverse de la création
		$query = 'SELECT T.id_ticket, C.Categorie, P.Priorite, S.Status, T.Utilisateur_demandeur, I.Impact,	T.Date_Probleme
				FROM T_Tickets AS T
				LEFT JOIN T_Priorites AS P ON P.id_priorite = T.fk_id_priorite
				LEFT JOIN T_Categories AS C ON C.id_categorie = T.fk_id_categorie
				LEFT JOIN T_Status AS S ON S.id_status = T.fk_id_status
				LEFT JOIN T_Impacts AS I ON I.id_impact = T.fk_id_impact
				LEFT JOIN T_Utilisateurs AS U ON U.id_utilisateur = T.fk_id_utilisateur_depanneur
                WHERE S.Status IN ("Ouvert", "Suspendu")
				AND U.Login = "'.$fun_username.'"
				ORDER BY '.$fun_colSort.' '.$fun_sort;
		$result = mysqli_query($link, $query);

		// Afficher le resultat dans le tableau
		while($rows = mysqli_fetch_row($result))
		{
			echo('
				<tr class="TrRow" onclick="document.location.href=\'/MPTickets/body/manageTicketPage.php?idTicket='.$rows[0].'\'">
					<td class="TdCol_1 RowTicket Arrondi-Gauche">'.$rows[0].'</td>
					<td class="TdCol_2 RowTicket">'.$rows[1].'</td>
					<td class="TdCol_3 RowTicket">'.$rows[2].'</td>
					<td class="TdCol_4 RowTicket">'.$rows[3].'</td>
					<td class="TdCol_5 RowTicket">'.$rows[4].'</td>
					<td class="TdCol_6 RowTicket">'.$rows[5].'</td>
					<td class="TdCol_7 RowTicket Arrondi-Droite">'.$rows[6].'</td>
				</tr>');
		}

		// Termine le traitement de la requête
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
	}
	// Fonction importer tous les utilisateurs dans la page showAllUsers
	function import_AllUsers($fun_colSort, $fun_sort)
	{
		// On se connecte à MySQL
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

		// Récupérer les infos des tickets et les trier dans inverse de la création
		$query = 'SELECT U.Prenom, U.Nom, U.Login, U.Email, D.Departement, DR.Niveau_droit
				FROM T_Utilisateurs AS U
				LEFT JOIN T_Departements AS D ON D.id_departement = U.fk_departement
				LEFT JOIN T_Droits AS DR ON DR.id_droit = U.fk_droit
				ORDER BY '.$fun_colSort.' '.$fun_sort;
		$result = mysqli_query($link, $query);

		// Afficjer le resultat dans le tableau
		while($rows = mysqli_fetch_row($result))
		{
			echo('
			<tr class="TrRow" onclick="document.location.href=\'/MPTickets/body/manageUserPage.php?Login='.$rows[2].'\'">
					<td class="TdCol_1 RowTicket Arrondi-Gauche">'.$rows[0].'</td>
					<td class="TdCol_2 RowTicket">'.$rows[1].'</td>
					<td class="TdCol_3 RowTicket">'.$rows[2].'</td>
					<td class="TdCol_4 RowTicket">'.$rows[3].'</td>
					<td class="TdCol_5 RowTicket">'.$rows[4].'</td>
					<td class="TdCol_6 RowTicket Arrondi-Droite">'.$rows[5].'</td>
				</tr>');
		}

		// Termine le traitement de la requête
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
	}

	// Fonction importer les 5 derniers tickets dans l'index comme le FLUX RSS
	function import_LastTickets(){

		// On se connecte à MySQL
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

		// Récupérer les infos des derniers tickets avec une limite de 5
		$query = 'SELECT T.id_ticket, T.date_fermeture, C.Categorie, T.Description_ticket, T.Resolution 
					FROM T_Tickets AS T
					INNER JOIN T_Categories AS C
					ON C.id_categorie = fk_id_categorie
					WHERE fk_id_status = 5
					ORDER BY date_fermeture DESC
					LIMIT 0,5';
		$tickets = mysqli_query($link,$query);

		// Retourner les tickets
		return $tickets;

		// Termine le traitement de la requête
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
	}
	
	// Importer dans un tableau les catégories et sous-catégories
	function import_Categories()
	{
		// On se connecte à MySQL
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");
		
		// Créer le tableau
		$array_categories = array();

		// Récupérer les Categories par ordre alphabétique
		$query = "SELECT id_categorie, fk_categorie, Categorie, Description_categorie FROM T_Categories ORDER BY Categorie ASC";
		$result = mysqli_query($link, $query);		

		while($row = mysqli_fetch_array($result)) 
		{
			$array_categories[] = array(
			'parent_id' => $row['fk_categorie'],
			'categorie_id' => $row['id_categorie'],
			'nom_categorie' => $row['Categorie'],
			'description_categorie' => $row['Description_categorie'],
			);
		}

		return $array_categories;

		// Termine le traitement de la requête
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
	}

	// Fonction importer la Categorie du Ticket
	function import_CreateTicketCategory($fun_id_ticket){

		// On se connecte à MySQL
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

		// Récuperer la catégorie initiale
		$query = 'SELECT categorie, fk_id_categorie
				FROM T_Tickets AS T
				INNER JOIN T_Categories AS Cat
				ON T.fk_id_categorie = Cat.id_categorie
				WHERE id_ticket = "'.$fun_id_ticket.'"';
		$result = mysqli_query($link, $query);
		$result = mysqli_fetch_row($result);

		// Termine le traitement de la requête
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");

		// Le resultat est égale l'id de la catégorie du Ticket
		$fun_initialIdCategory = $result[1];

		// créer tableau Catégorie et Stocker le nom de la catégorie
		$array_categories = array($result[0]);

		// Chercher la catégorie parent
		function search_parentCategory($array_categories, $fun_idCategory)
		{
			// On se connecte à MySQL
			include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

			// Récupérer la categorie parent
			$query = 'SELECT Cat_parent.id_categorie, Cat_parent.fk_categorie, Cat_parent.categorie
					FROM T_Categories AS Cat
					INNER JOIN T_Categories AS Cat_parent
					ON Cat_parent.id_categorie = Cat.fk_categorie
					WHERE Cat.id_categorie = "'.$fun_idCategory.'"';
			$result = mysqli_query($link, $query);
			$parentCategory = mysqli_fetch_row($result);
			
			// Termine le traitement de la requête
			include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");

			// enregistrer le résultat
			array_push($array_categories, $parentCategory[2]);

			// Si la catégorie choisie est à la racine car la catégorie n'a pas de parents
			if(!empty($parentCategory[1]))
			{	
				// Rappeler la fonction
				return search_parentCategory($array_categories, $parentCategory[0]);
			}
			else 
			{
				// Retourner le tableau des catégories
				return $array_categories;
			}			
		}
		// Appeler la fonction qui permet de chercher les catégories supérieures
		// Inverser le tableau
		$Link = array_reverse(search_parentCategory($array_categories, $fun_initialIdCategory));

		// Retourner le résultat
		return $Link;
		
	}

	// Fonction pour afficher les catégories dans l'input
	function import_CategoriesInput($fun_id_ticket)
	{
		// Récuperer le tableau avec la catégorie du ticket
		$fun_arrayCategorie = import_CreateTicketCategory($fun_id_ticket);

		// Parcourir chaque entrée du tableau
		foreach($fun_arrayCategorie as $element)
		{
			
			echo '/'.$element; // affichera /xxx/yyy
		}
	}

	// Fonction pour importer le mot de passe
	function import_PasswordUser($fun_username)
	{
		// On se connecte à MySQL
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

		// Récuperer le password du user
		$query = 'SELECT password FROM T_Utilisateurs WHERE Login = "'.$fun_username.'"';
		$result = mysqli_query($link,$query);
		$hash_password = implode(mysqli_fetch_row($result)); // Retourer la viariable en string

		// Termine le traitement de la requête
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");

		return $hash_password;
	}
	
// **************************************************************************************************************
// **************************************** CREATE **************************************************************
// **************************************************************************************************************
	
	// Fontion de création du numéro de Ticket
	function create_NumDailyTickets()
	{
		// On se connecte à MySQL
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

		// Récupérer la date du jour
		$date = date('Ymd');
		
		// Chercher tous les tickets du jour
		$query = 'SELECT * FROM T_Tickets WHERE id_Ticket LIKE "'.$date.'%"'; 	
		$result = mysqli_query($link,$query);
		
		//Compter le nombre de requête pour pouvoir incrémenter
		$nbRequest = mysqli_num_rows($result);
		
		// Créer le nouvel id du ticket du jour
		$nbRequest++;
		$nbRequest = substr("000".$nbRequest,-3); // Passer en affichage 000 au lui de 0
		$idTicket = $date."_".$nbRequest;
		
		return $idTicket;
		
		// Termine le traitement de la requête
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
	}
	
	// Fonction qui change le bouton d'après le status
	function create_StatuButton($fun_numTicket)
	{
		// Importer le status du ticket
		$donnees = import_TicketStatu($fun_numTicket);
		
		// Si le Statu est égal à 1(Ouvert)
		if($donnees[1] == 1)
		{
			/// Retourner le resultat
			return "Suspendre";
		}
		// Sinon c'est égal à suspendre
		else
		{
			// Retourner le resultat
			return "Dépendre";
		}
	}

	// Fonction qui affiche le bouton Connexion ou Déconnexion
	function create_ConnectButton()
	{
		// Voir si l'utilistateur est authentifié
		$UserAuthentification = check_UserAuthentication();

		// Vérifie si l'utilisateur n'est pas connecté
		if ($UserAuthentification === false) 
		{
			return 'Connexion';
		}
		else // Si l'utilisateur est connecté
		{
			return 'Deconnexion';
		}
	}

	// Fonction qui affiche le bouton Connexion ou Déconnexion
	function create_ConnectLink()
	{
		// Voir si l'utilistateur est authentifié
		$UserAuthentification = check_UserAuthentication();

		// Vérifie si l'utilisateur n'est pas connecté
		if ($UserAuthentification === false) 
		{
			return 'body/loginAdminPage.php';
		}
		else // Si l'utilisateur est connecté
		{
			return 'BD/DisconnectUser.php';
		}
	}

	// Fonction qui crée le header des Utilisateurs connectés
	function create_header()
	{
		// Voir si l'utilistateur est authentifié
		$UserAuthentification = check_UserAuthentication();

		// Vérifie si l'utilisateur n'est pas connecté
		if ($UserAuthentification === false) 
		{
			echo'
				<li class="nav-item">
					<a class="nav-link" href="/MPTickets/body/loginAdminPage.php">Administration</a>
				</li>
			';
		}
		else // Si l'utilisateur est connecté
		{
			echo'
				<!-- Menu Administration -->
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle"
							id="navbarDropdownMenuLink"
							data-toggle="dropdown"
							aria-haspopup="true"
							aria-expanded="false">
							Administration</a>
						<ul class="dropdown-menu bg-dark">
							<!-- links -->
							<li class="dropdown-item">
								<a class="nav-link" href="/MPTickets/body/dashboardTicketsPage.php">Dashboard Tickets</a>
							</li>
							<li class="dropdown-item">
								<a class="nav-link" href="/MPTickets/body/dashboardUsersPage.php">Dashboard Users</a>
							</li>
						</ul>
					</li>
				<!-- Menu Profil USER-->
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle"
							id="navbarDropdownMenuLink"
							data-toggle="dropdown"
							aria-haspopup="true"
							aria-expanded="false"
							href="/MPTickets/body/LoginAdminPage.php">
							Mon Profil ('.$_SESSION['username'].')</a>
						<ul class="dropdown-menu bg-dark">
							<!-- links -->
							<li class="dropdown-item">
								<a class="nav-link" href="/MPTickets/body/dashboardMyTicketsPage.php">Mes Tickets</a>
							</li>
							<li class="dropdown-item">
								<a class="nav-link" href="/MPTickets/body/manageUserPage.php?Login='.$_SESSION['username'].'">Mes Infos</a>
							</li>
							<li class="dropdown-item">
								<a class="nav-link" href="/MPTickets/BD/DisconnectUser.php">Déconnexion</a>
							</li>
						</ul>
					</li>
			';
		}
	}

	// Fonction qui va géner un salt
	function create_SaltUser()
	{
		// Choix des caractères
		$listeCar = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ<\/$£_-.:,;!èéà?%&*@#=+>';
		// Longeur de la chaine
		$longueur = 8;
		$chaine = '';
		// Compter le nombre de caractères
		$max = mb_strlen($listeCar, '8bit') - 1;

		// Faire une boucle qui génere la chaine
		for ($i = 0; $i < $longueur; ++$i) 
		{
			$chaine .= $listeCar[random_int(0, $max)];
		}

		// Hasher le tout en SHA-256
		$chaine = hash("sha256", $chaine);
		
		// Retourner le salt
		return $chaine;
	}

	// Fonction qui va créer le menu des catégories
	function create_MenuCategories()
	{
		// Importer les catégories
		$array_categories = import_Categories();

		global $menuItems;
		global $parentMenuIds;
		
		//create an array of parent_menu_ids to search through and find out if the current items have an children
		foreach($array_categories as $parentId)
		{
			$parentMenuIds[] = $parentId['parent_id'];
		}
		//assign the menu items to the global array to use in the function
		$menuItems = $array_categories;
		
		// Commencer la liste
		echo '<ul>';
		//recursive function that prints categories as a nested html unorderd list
		function generate_menu($parent)
		{
			$has_childs = false;
			//this prevents printing 'ul' if we don't have subcategories for this category

			global $menuItems;
			global $parentMenuIds;
			//use global array variable instead of a local variable to lower stack memory requierment
			
			foreach($menuItems as $key => $value)
			{
				if ($value['parent_id'] == $parent) 
				{    
					//if this is the first child print '<ul>'
					if ($has_childs === false)
					{
						//don't print '<ul>' multiple times  
						$has_childs = true;
						if($parent != 0)
						{
							echo '<ul class="dropdown-menu">';
						}
					}

					if($value['parent_id'] == 0 && in_array($value['categorie_id'], $parentMenuIds))
					{
						echo '<li class="dropdown"><b class="caret"><a class="dropdown-toggle" data-toggle="dropdown" href="#">' . $value['nom_categorie'] .'</a>';
					}
					else if($value['parent_id'] != 0 && in_array($value['categorie_id'], $parentMenuIds))
					{
					//	echo '<li class="dropdown dropdown-submenu"><a href="#">' . $value['nom_categorie'] . '</a>';
						echo '<li class="dropdown"><b class="caret"></b><a class="dropdown-toggle" data-toggle="dropdown" href="#">'. $value['nom_categorie'].'</a>';						
					}
					else
					{
						//echo '<li><a href="#">' . $value['nom_categorie'] . '</a>';
						echo '<li class=""><input type="checkbox" class="radio" id="'.$value['categorie_id'].'" name="'.$value['categorie_id'].'" value="'.$value['categorie_id'].'" onclick="get_idCategory('.$value['categorie_id'].',\''.$value['nom_categorie'].'\')"><label class="Category-Label" for="'.$value['categorie_id'].'">'.$value['nom_categorie'].'</label>';
					}
					generate_menu($value['categorie_id']);

					//call function again to generate nested list for subcategories belonging to this category
					echo '</li>';
				}
			}
			if ($has_childs === true) echo '</ul>';
		}
		generate_menu(0); 
	}

	// Fonction qui va créer les cookies
	function create_ConnectCookies()
	{
		$name_cookie = "username";
		$value_cookie = $_SESSION['username'];
		$expire_cookie = time() + (86400 * 30); // 86400 = 1 jour
		$path_cookie = "/"; // Répertoir où le cookie peut être utilisé
		$domain_cookie = null; // Sous domaine où le cookie peut être disponible
		$secure_cookie = false; // Connexion doit être faite en HTTPS
		$httponly_cookie = true; // Uniquement possible de le récupérer avec une requête HTTP

		// Créer cookie username
		setcookie($name_cookie, $value_cookie, $expire_cookie, $path_cookie, $domain_cookie, $secure_cookie, $httponly_cookie);
		
		// Hasher le username + l'adresse IP + hash password
		$value_cookie = hash("sha256", $_SESSION['username'] . $_SERVER["REMOTE_ADDR"] . $_SESSION['password']);
		$name_cookie = "connectMPTickets";

		// Stocker la valeur dans la base de Données
		update_ConnectCookies($value_cookie);

		// Créer le cookie connectMPTickets
		setcookie($name_cookie, $value_cookie, $expire_cookie, $path_cookie, $domain_cookie, $secure_cookie, $httponly_cookie);
	}

// **************************************************************************************************************
// **************************************** UPDATE **************************************************************
// **************************************************************************************************************

	// Fonction qui met à jour la categorie du ticket
	function update_TicketCategory($fun_id_ticket, $fun_Category)
	{
		// On se connecte à MySQL
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

		// Mettre à jour le ticket 

		// Termine le traitement de la requête
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
	}

	// Fonction qui fait l'UPDATE du token du cookie connectMPTickets
	function update_ConnectCookies($fun_token)
	{
		// On se connecte à MySQL
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

		// Mettre à jour le token
		$query = 'UPDATE `T_Utilisateurs` SET `token_cookie` = "'.$fun_token.'"
		WHERE `T_Utilisateurs`.`Login` = "'.$_SESSION['username'].'"';
		
		$result = mysqli_query($link,$query);

		// Termine le traitement de la requête
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
	}

// **************************************************************************************************************
// **************************************** CHECK ***************************************************************
// **************************************************************************************************************

	// Fonction qui check s'il elle doit afficher la flèche
	function check_ArrowIdTicket($fun_col, $fun_colSort, $fun_sort)
	{
		// Vérifie si la colonne de tri contient le nom de la colonne
		// strpos($tachaine, $cherche)
		if(strpos($fun_colSort, $fun_col))
		{
			// Affiche la bonne flèche 
			return '<img src="/MPTickets/Images/'.$fun_sort.'Arrow.png" height="20">';
		}
	}

	// Fonction vérifie si l'utilisateur existe dans la base de Données
	function check_Ticket($fun_id_ticket)
	{
		// On se connecte à MySQL
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

		$query = 'SELECT * FROM T_Tickets WHERE id_ticket = "'.$fun_id_ticket.'"';
		$result = mysqli_query($link,$query);

		// Test si le retour n'est pas vide
		if(mysqli_num_rows($result))
		{
			return true;
		}
		else{ return false; } // Si l'utilisateur existe
		
		// Termine le traitement de la requête
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
	}

	// Fonction vérifie si l'utilisateur existe dans la base de Données
	function check_User($fun_username)
	{
		// On se connecte à MySQL
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

		$query = 'SELECT * FROM T_Utilisateurs WHERE Login = "'.$fun_username.'"';
		$result = mysqli_query($link,$query);

		// Test si le retour n'est pas vide
		if(mysqli_num_rows($result))
		{
			return true;
		}
		else{ return false; } // Si l'utilisateur existe
		
		// Termine le traitement de la requête
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
	}

	// Fonction qui vérifie si l'utilisateur est authentifié
	function check_UserAuthentication()
	{
		// Vérifie si les valeurs de session existe
		if (isset($_SESSION['username']) && isset($_SESSION['password'])) 
		{
			// Si l'Utilisateur est authentifié, il retourne VRAI
			return true;
		} 
		else {
			return false;
		}
	}

	// Fonction qui redirige le User sur la page de Login s'il n'est pas connecté
	function check_UserRedirection()
	{
		$UserAuthentification = check_UserAuthentication();

		// Vérifie si l'utilisateur n'est pas connecté
		if ($UserAuthentification === false) 
		{
			// Si l'Utilisateur n'est pas authentifié, il est redirigé vers la page de Login
			header('Location: /MPTickets/body/loginAdminPage.php');
		}
	}

	// Fonction qui vérifie si l'Utilisateur a un cookie Variable
	function check_CookieAuthentication()
	{
		if(isset($_COOKIE['username']) && isset($_COOKIE['connectMPTickets']))
		{
			
			// On se connecte à MySQL
			include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");
			
			// Récuper le token du cookie connectMPTickets
			$query = 'SELECT token_cookie FROM T_Utilisateurs WHERE Login = "'. $_COOKIE['username'] .'"';
			$result = mysqli_query($link,$query);
			$donnees = mysqli_fetch_row($result);
			$BD_token = $donnees[0];

			// Termine le traitement de la requête
			include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");

			// Si le retour n'est pas VIDE
			if (!empty($BD_token))
			{
				// Vérifier si le cookie connectMPTickets a la bonne valeur
				if($BD_token === $_COOKIE['connectMPTickets'])
				{
					return true;
				}
				// Sinon supprimer les cookies
				else 
				{ 
					// supprimer les cookies
					delete_CookieAuthentication();
				}
			}
			else 
			{ 
				// supprimer les cookies
				delete_CookieAuthentication();
			}			
		}
		else { return false; }
	}

// **************************************************************************************************************
// **************************************** DELETE **************************************************************
// **************************************************************************************************************

	// Fonction supprimer les cookies de connexion
	function delete_CookieAuthentication()
	{
		// On se connecte à MySQL
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

		// Supprimer le tocken
		$query = 'UPDATE `T_Utilisateurs` SET `token_cookie` = NULL
			WHERE `T_Utilisateurs`.`Login` = "'.$_COOKIE['username'].'"';
		$result = mysqli_query($link, $query);

		// Termine le traitement de la requête
		include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");

		// supprimer la valeur des cookies
		unset($_COOKIE['username']);
		unset($_COOKIE['connectMPTickets']);
		
		
		$expire_cookie = time() - 1; // Mettre une date d'expiration antérieur pour supprimer les cookies
		$path_cookie = "/"; // Répertoir où le cookie peut être utilisé
		$domain_cookie = null; // Domaine où le cookie peut être disponible
		$secure_cookie = false; // Connexion doit être faite en HTTPS
		$httponly_cookie = true; // Uniquement possible de le récupérer avec une requête HTTP
		
		$value = $_COOKIE['username'];
		setcookie('username', $value, $expire_cookie, $path_cookie, $domain_cookie, $secure_cookie, $httponly_cookie);
		
		$value = $_COOKIE['connectMPTickets'];
		setcookie('connectMPTickets', $value, $expire_cookie, $path_cookie, $domain_cookie, $secure_cookie, $httponly_cookie);
	}
	
?>