<?php

$mysqlhost="localhost:3306"; // MySQL-Host angeben
$mysqluser="root"; // MySQL-User angeben
$mysqlpwd=""; // Passwort angeben
$mysqldb="DB424098_2"; // Gewuenschte Datenbank angeben

$mysqli = new mysqli($mysqlhost, $mysqluser, $mysqlpwd, $mysqldb);

function updateDB($postArray, $connection) {
	if(isset($postArray['save'])) {
		if($postArray['save'] == "Speichern") {
			$query = "UPDATE freischaltung SET macadr = '".$postArray['macadr']."', customer = '".$postArray['customer']."', status = '".$postArray['status']."' WHERE seriennr = '".$postArray['sernr']."'";
			$result = $connection->query($query);
			#echo "<p>done update with $query</p>";
		}
	}
}

?>
