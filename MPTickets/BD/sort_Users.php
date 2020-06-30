<?php

// Filtre de base
// Reinitialiser les variables
	$sort_Prenom='ASC';
	$sort_Nom='ASC';
	$sort_Login='ASC';
	$sort_Email='ASC';
	$sort_Departement='ASC';
	$sort_Droit='ASC';


// Ticket plus r�cent en premier
// S'il n'y a pas de param�tre dans l'URL
if(isset($_GET['sort']) && isset($_GET['col']))
{
	// Savoir le trie est égale à DESC
	if($_GET['sort'] == 'DESC')
	{
		$sort = 'DESC';

		// Inverser pour mettre dans les liens
		$linkSort = 'ASC';
	}
	// Sinon le trie est �gale � ASC
	else 
	{
		$sort = 'ASC';

		// Inverser pour mettre dans les liens
		$linkSort = 'DESC';
	}

	// Trouver sur quelle colonne faire le filtre
	switch ($_GET['col']) 
	{
		case 'Prenom':
		$sort_col = 'U.Prenom';

		// Changer le lien pour inverser le tri
		$sort_Prenom = $linkSort;
		break;


		case 'Nom':
		$sort_col = 'U.Nom';

		// Changer le lien pour inverser le tri
		$sort_Nom = $linkSort;
		break;


		case 'Login':
		$sort_col = 'U.Login';

		// Changer le lien pour inverser le tri
		$sort_Login = $linkSort;
		break;


		case 'Email':
		$sort_col = 'U.Email';
	
		// Changer le lien pour inverser le tri
		$sort_Email = $linkSort;
		break;


		case 'Departement':
		$sort_col = 'D.Departement';

		// Changer le lien pour inverser le tri
		$sort_Departement = $linkSort;
		break;


		case 'Droit':
		$sort_col = 'DR.Niveau_droit';

	}	
}
// Si les variables ne sont pas déclarées
else 
{
	$sort_col = 'U.Prenom'; 
	$sort = 'ASC';
}


?>