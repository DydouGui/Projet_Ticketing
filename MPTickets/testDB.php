<?php
include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/connectToDB.php");

// Création et envoi de la requête
$query = "SELECT * FROM T_Tickets";
$result = mysqli_query($link,$query);

// Recuperation des resultats
if (!$result) {
	echo "Aucun enregistrement ne correspond\n";
	}
else
{
	echo "<table>";
while($row = mysqli_fetch_row($result))
	{
		$ID = $row[0];
		$Nom = $row[1];
		$Descr = $row[2];
		echo "<tr>
		<td>$ID</td>
		<td>$Nom</td>
		<td>$Descr</td>
		</tr>";
	}
echo"</table>";
}

include($_SERVER['DOCUMENT_ROOT']."/MPTickets/BD/closeDB.php");
?>