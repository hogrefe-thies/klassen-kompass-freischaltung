<?php
$PHP_SELF = $_SERVER['PHP_SELF'];
require("verbindung.php");
$show = FALSE;
if(isset($_POST['sernr'])) {
	$sernr = $_POST['sernr'];
} else {
	$sernr = "";
}
if(isset($_POST['macadr'])) {
	$macadr = $_POST['macadr'];
} else {
	$macadr= "";
}
if(isset($_GET['s'])) {
	$s = $_GET['s'];
} else {
	$s = "";
}
if(isset($_GET['m'])) {
	$m = $_GET['m'];
} else {
	$m = "";
}

$rand = "744c06c862e1c79b8a8476c387825b20459b5311234543291e6fcefc0c3bc3fe1a86cdfed6f6a615fcedbcab64964925983856555e";
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">

<head>
	<title>Freischaltung KlassenKompass</title>
	<meta http-equiv="content-type"
		content="text/html;charset=utf-8" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
</head>

<body>
	<form action="<?php echo "$PHP_SELF"; ?>" method="POST" name="sernr" id="sernr">
		<p>Bitte Seriennummer und</p>
		<p><input type="text" name="sernr" id="sernr" size="40" maxlength="40" value="<?php echo "$s"; ?>" /></p>
		<p>Hardwarecode eingeben</p>
		<p><input type="text" name="macadr" id="macadr" size="40" maxlength="40" value="<?php echo "$m"; ?>" /></p>
		<p>Dann OK</p>
		<p><input type="submit" name="submitbutton1" id="submitbutton1" value="OK" /></p>
	</form>
<?php
# echo "<form action=\"$PHP_SELF\" method=\"POST\" name=\"sernr\" id=\"sernr\">";
# echo "<p>Bitte Seriennummer und</p>";
# echo "<p><input type=\"betreff\" name=\"sernr\" id=\"sernr\" size=\"40\" maxlength=\"40\" value=\"$s\" /></p>";
# echo "<p>Hardwarecode eingeben</p>";
# echo "<form action=\"$PHP_SELF\"  method=\"POST\" name=\"macadr\" id=\"macadr\"></p>";
# echo "<p><input type=\"betreff\" name=\"macadr\" id=\"macadr\" size=\"40\" maxlength=\"40\" value=\"$m\" /></p>";
# echo "<p>Dann OK</p>";
# echo "<p><input type=\"submit\" name=\"submitbutton1\" id=\"submitbutton1\" value=\"OK\" /></p>";
# echo "</form>";

if ($sernr != "" && $macadr != "")
{
	$result = $mysqli->query("SELECT * FROM Freischaltung WHERE seriennr = $sernr");

	$mac_daba = "";
	$sernr_daba = "";
	while ($result2 = $result->fetch_assoc())
	{
  		$mac_daba =  $result2['macadr'];
		$sernr_daba =  $result2['seriennr'];
//		echo "mac_daba: ";
//		echo $mac_daba;
//		echo "sernr_daba: ";
//		echo $sernr_daba;
 	}
	if ($mac_daba != $macadr && $mac_daba != "")
	{
		echo "Diese Seriennummer ist bereits vergeben! Bei Problemen oder Fragen, </p>
		schicken Sie bitte eine email an freischaltung@transferinstitut.de ";
	}

	else if ($mac_daba == $macadr && $sernr_daba == $sernr)
	{
		echo " Ihre Freischaltungsnummer lautet: ";
		$macadrINT = hexdec($macadr);
		$sernr1 = substr($sernr, 0, 5);
		$sernr2 = substr($sernr, 5, 5);
		$teil2 = $sernr1 + $macadrINT;
		$freicode1 = (string)$sernr2;
		$freicode2 = (string)$teil2;
		$freicode = "$freicode1$freicode2";
		$sub1 = substr($freicode, 0, 2);
		$sub2 = substr($freicode, 2, 2);
		$sub3 = substr($freicode, 4, 2);
		$sub4 = substr($freicode, 6, 2);
		$sub5 = substr($freicode, 8, 2);
		$int1 = (integer)($sub1);
		$int2 = (integer)($sub2);
		$int3 = (integer)($sub3);
		$int4 = (integer)($sub4);
		$int5 = (integer)($sub5);
		$verschlu1 = substr($rand, $int1, 1);
		$verschlu2 = substr($rand, $int2, 1);
		$verschlu3 = substr($rand, $int3, 1);
		$verschlu4 = substr($rand, $int4, 1);
		$verschlu5 = substr($rand, $int5, 1);

		$finalcode = "$verschlu1$verschlu2$verschlu3$verschlu4$verschlu5";
		echo $finalcode;
	}

	else if ($mac_daba == "")
	{


		if ($sernr != $sernr_daba)
		{
			echo "Bitte geben Sie eine gültige Seriennummer ein!";
		}

		else
		{

			echo " Vielen Dank! ";
			echo " Ihr Freischaltungscode lautet: ";
//			echo hexdec($macadr);

			$macadrINT = hexdec($macadr);
//			echo $macadrINT;

			$sernr1 = substr($sernr, 0, 5);
			$sernr2 = substr($sernr, 5, 5);
			$teil2 = $sernr1 + $macadrINT;
			$teil1 = $sernr2;

			$freicode1 = (string)$teil1;
			$freicode2 = (string)$teil2;
			$freicode = "$freicode1$freicode2";

//			echo $freicode;

			$sub1 = substr($freicode, 0, 2);
			$sub2 = substr($freicode, 2, 2);
			$sub3 = substr($freicode, 4, 2);
			$sub4 = substr($freicode, 6, 2);
			$sub5 = substr($freicode, 8, 2);

//			echo "sub3: </p>";
//			echo $sub3;

			$int1 = (integer)($sub1);
			$int2 = (integer)($sub2);
			$int3 = (integer)($sub3);
			$int4 = (integer)($sub4);
			$int5 = (integer)($sub5);

//			echo "int3: </p>";
//			echo $int3;

			$verschlu1 = substr($rand, $int1, 1);
			$verschlu2 = substr($rand, $int2, 1);
			$verschlu3 = substr($rand, $int3, 1);
			$verschlu4 = substr($rand, $int4, 1);
			$verschlu5 = substr($rand, $int5, 1);

//			echo "veschlu3: </p>";
//			$echo $verschlu3;

			$finalcode = "$verschlu1$verschlu2$verschlu3$verschlu4$verschlu5";
			echo $finalcode;
			$mysqli->query("UPDATE Freischaltung SET macadr = '$macadr', status = 2 WHERE seriennr = '$sernr'");
		}
	}
	mysqli_free_result($result);
}
?>
	<a href="liste/liste.php">zur Liste</a>
</body>
</html>

