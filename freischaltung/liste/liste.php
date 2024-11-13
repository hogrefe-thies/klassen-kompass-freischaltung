<?php
	$PHP_SELF = $_SERVER['PHP_SELF'];
	
	require("verbindung.php");
	$show = FALSE;
	if (isset($_GET['status'])) {
		$query = "SELECT * FROM Freischaltung WHERE status = '".$_GET['status']."'";
		switch($_GET['status']) {
			case 0: $infotext = "Noch ###rowcount### freie Seriennummern"; break;
			case 1: $infotext = "Noch ###rowcount### wartende Seriennummern"; break;
			case 2: $infotext = "Schon ###rowcount### belegte Seriennummern"; break;
		}
	}
	else {
		$query = "SELECT * FROM Freischaltung";
		$infotext = "Insgesamt ###rowcount### Seriennummern";
	}
	$result = $mysqli->query($query);
	$rowcount = mysqli_num_rows($result);
	$infotext = str_replace("###rowcount###", $rowcount , $infotext);
	echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">

<head>
	<title>Freie Seriennummern KlassenKompass</title>
	<meta http-equiv="content-type"
		content="text/html;charset=utf-8" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<style type="text/css">
		span.free { color: #00ff00; }
		span.pending { color: #0000ff; }
		span.out { color: #ff0000; }
	</style>
</head>

<body>
	<a href="/freischaltung/index.html">&lt;&lt; home</a><br />
	<p class="info"><?php echo $infotext; ?>:</p>
	<p class="subnavi">
		<a href="<?php echo $PHP_SELF; ?>">alle</a>
		<a href="<?php echo $PHP_SELF; ?>?status=0">freie</a>
		<a href="<?php echo $PHP_SELF; ?>?status=1">wartende</a>
		<a href="<?php echo $PHP_SELF; ?>?status=2">belegte</a>
	</p>
	<table border="1">
		<thead>
			<th>Seriennummer</th>
			<th>Hardwarecode</th>
			<th>Kunde</th>
			<th>Status</th>
			<th>&Auml;ndern</th>
			<th>Freischalten</th>
		</thead>
		<tbody>
<?php

	while ($result2 = $result->fetch_assoc()) {
		$sernr_daba =  $result2['seriennr'];
		$macadr_daba =  $result2['macadr'];
		$customer_daba =  $result2['customer'];
		$status_daba =  $result2['status'];
		$statustext_daba = "unknown";
		switch($status_daba) {
			case 0: $statustext_daba = "<span class=\"free\">Frei</span>"; break;
			case 1: $statustext_daba = "<span class=\"pending\">Wartet</span>"; break;
			case 2: $statustext_daba = "<span class=\"out\">Belegt</span>"; break;
		}
?>
			<tr>
				<td><?php echo $sernr_daba; ?></td>
				<td><?php echo $macadr_daba; ?></td>
				<td><?php echo $customer_daba; ?></td>
				<td><?php echo $statustext_daba; ?></td>
				<td><a href="edit.php?id=<?php echo $sernr_daba; ?>">&auml;ndern</a></td>
				<td><a href="../freischaltung.php?s=<?php echo $sernr_daba; ?>">freischalten</a></td>
		</tr>
<?php
	}
	mysqli_free_result($result);
?>
		</tbody>
	</table>
</body>
</html>
