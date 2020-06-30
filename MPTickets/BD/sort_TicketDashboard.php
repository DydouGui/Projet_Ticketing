<?php

// Filtre de base
// Reinitialiser les variables
	$sort_id_ticket='ASC';
	$sort_Categorie='ASC';
	$sort_Priorite='ASC';
	$sort_Status='ASC';
	$sort_Demandeur='ASC';
	$sort_Impact='ASC';
	$sort_DatePB='ASC';

// Ticket plus récent en premier
// S'il n'y a pas de paramètre dans l'URL
if(isset($_GET['sort']) && isset($_GET['col']))
{
	// Savoir le trie est égale à DESC
	if($_GET['sort'] == 'DESC')
	{
		$sort = 'DESC';

		// Inverser pour mettre dans les liens
		$linkSort = 'ASC';
	}
	// Sinon le trie est égale à ASC
	else 
	{
		$sort = 'ASC';

		// Inverser pour mettre dans les liens
		$linkSort = 'DESC';
	}

	// Trouver sur quelle colonne faire le filtre
	switch ($_GET['col']) 
	{
		case 'id_ticket':
		$sort_col = 'T.id_ticket';


		// Changer le lien pour inverser le tri
		$sort_id_ticket = $linkSort;
		break;

		case 'Categorie':
		$sort_col = 'C.Categorie';

		// Changer le lien pour inverser le tri
		$sort_Categorie = $linkSort;
		break;

		case 'Priorite':
		$sort_col = 'P.id_priorite';

		// Changer le lien pour inverser le tri
		$sort_Priorite = $linkSort;
		break;

		case 'Status':
		$sort_col = 'S.Status';

		// Changer le lien pour inverser le tri
		$sort_Status = $linkSort;
		break;

		case 'Demandeur':
		$sort_col = 'T.Utilisateur_demandeur';

		// Changer le lien pour inverser le tri
		$sort_Demandeur = $linkSort;
		break;

		case 'Impact':
		$sort_col = 'I.id_impact';

		// Changer le lien pour inverser le tri
		$sort_Impact = $linkSort;
		break;

		case 'DatePB':
		$sort_col = 'T.Date_Probleme';

		// Changer le lien pour inverser le tri
		$sort_DatePB = $linkSort;
		break;
	}	
}
// Si les variables ne sont pas déclarées
else 
{
	$sort_col = 'T.id_ticket'; 
	$sort = 'DESC';
}


?>