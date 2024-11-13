<?php
$MAX = 2003;
$seed = 9002010000;
$forth = 147;
$cursor = 3;
$result = array();
for($i=0; $i<$MAX; $i++) {
	$cursor = ($cursor + $forth) % $MAX;
	$result[] = $seed + $cursor;
}
#print_r($result);
foreach($result as $serial) {
	echo "$serial;\n";
}
?>
