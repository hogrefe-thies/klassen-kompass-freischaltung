<?php
	$PHP_SELF = $_SERVER['PHP_SELF'];
	require("verbindung.php");
	$show = FALSE;

	updateDB($_POST, $mysqli);

	$result = $mysqli->query("SELECT * FROM Freischaltung WHERE seriennr = " . $_GET['id']);
	echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">

<head>
	<title>&Auml;ndern einer Seriennummer KlassenKompass</title>
	<meta http-equiv="content-type"
		content="text/html;charset=utf-8" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<style type="text/css">
		span.free { color: #00ff00; }
		span.pending { color: #0000ff; }
		span.out { color: #ff0000; }
		td.head { background-color: #e1e1e1; }
		td select { width: 100%; }
	</style>
</head>

<body>
<form name="edit" method="post" action="edit.php?id=<?php echo $_GET['id']; ?>">
	<table border="1">
		<thead>
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
				<td class="head">Seriennummer</td>
				<td>
					<input type="text" name="sernr" value="<?php echo $sernr_daba; ?>" />
				</td>
			</tr>
			<tr>
				<td class="head">Hardwarecode</td>
				<td>
					<input type="text" name="macadr" value="<?php echo $macadr_daba; ?>" />
				</td>
			</tr>
			<tr>
				<td class="head">Kunde</td>
				<td>
					<input type="text" name="customer" value="<?php echo $customer_daba; ?>" />
				</td>
			</tr>
			<tr>
				<td class="head">Status</td>
				<td>
					<select name="status">
						<option value="0"<?php if($status_daba == 0) echo " selected=\"selected\""; ?>>Frei</option>
						<option value="1"<?php if($status_daba == 1) echo " selected=\"selected\""; ?>>Wartet</option>
						<option value="2"<?php if($status_daba == 2) echo " selected=\"selected\""; ?>>Belegt</option>
					</select>
					<!--<input type="text" name="status" value="<?php echo $status_daba; ?>" />-->
				</td>
			</tr>
<?php
	}
	mysqli_free_result($result);
?>
		</tbody>
	</table>
	<button type="button" onclick="location.href='liste.php'">&lt; Zur&uuml;ck</button>
	<button type="reset">Verwerfen</button>
	<input type="submit" name="save" value="Speichern" />
</form>
</body>
</html>
