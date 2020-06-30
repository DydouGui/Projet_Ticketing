<?php

$dbname='MPTicket';
$dbuser='MPTicket';
$dbpass='R0ge1r0-M0dule151';
$dbhost='localhost';

// Connexion au serveur
$link=mysqli_connect($dbhost, $dbuser, $dbpass) or die("Erreur de connexion au serveur base de données "." | ".$dbhost." | ".$dbuser." | ".$dbpass);

mysqli_select_db($link, $dbname) or die("Base de données pas trouvée");

?>