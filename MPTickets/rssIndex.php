<?xml version="1.0" encoding="UTF-8" ?> <!-- Laisse à la première ligne sinon le il ne reconnait pas comme fichier XML -->

<?php
	header('Content-Type: application/rss+xml');

	// Importer les fonctions
	include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/FonctionPHP-SQL.php");

	// Récuperer les 5 derniers tickets
	$tickets = import_LastTickets();
?>

<rss version="2.0">
	<channel>
		<title>MPTickets</title>
		<description>Flux RSS de MPTickets - Derniers tickets résolus</description>
		<?php while($rows = mysqli_fetch_row($tickets)) { ?>
			<item>
				<title><?php echo $rows[2]; ?></title>
				<description><?php echo substr($rows[3].'/n'.$rows[4], 0, 1000).'...'; ?></description>
				<pubDate><?php echo date(DATE_RSS, strtotime($rows[1])); ?></pubDate>
			</item>
		<?php } ?>
	</channel>
</rss>