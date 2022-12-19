<html><body bgcolor=#113300 style="color:#FFFFFF">

<?php
$input = fopen("input_15.txt", "r") or die("Unable to open file!");

$targetY = 2000000;
$blockedRegions = array();
$unBlockedLocations = array();
while (!feof($input)) {
	$line = str_replace("\r\n", "", fgets($input));
	$line = str_replace("Sensor at x=", "", $line);
	$line = str_replace(", y=", ";", $line);
	$line = str_replace(": closest beacon is at x=", ";", $line);
	$line = str_replace(", y=", ";", $line);
	$linex = explode(";", $line);
	$sx = (int)$linex[0];
	$sy = (int)$linex[1];
	$bx = (int)$linex[2];
	$by = (int)$linex[3];
	echo "[" . $sx . "," . $sy . "] -> [" . $bx . "," . $by . "]<br>";
	$dist = abs($sx - $bx) + abs($sy - $by);
	$widthAtTargetY = $dist - abs($sy - $targetY);
	if ($widthAtTargetY >= 0) {
		if ($by == $targetY) {
			array_push($unBlockedLocations, $by);
		}
		$newRegion = array($sx - $widthAtTargetY, $sx + $widthAtTargetY);
echo count($blockedRegions) . "c<br>";
		AddRegion($blockedRegions, $newRegion);
echo count($blockedRegions) . "c<br>";
	}
}

$count = 0;
echo count($blockedRegions) . "c<br>";
for ($i = 0; $i < count($blockedRegions); $i++) {
	$count += $blockedRegions[$i][1] - $blockedRegions[$i][0] + 1;
	echo "result: [" . $blockedRegions[$i][0] . "," . $blockedRegions[$i][1] . "]<br>";
}
echo "count: " . $count . "<br>";
echo "unblocked locations: " . count(array_unique($unBlockedLocations)) . "<br>";
echo "full answer: " . $count - count(array_unique($unBlockedLocations));

function AddRegion(&$blockedRegions, $newRegion) {
	$hasMerged = -1;
	for ($i = 0; $i < count($blockedRegions); $i++) {
		if ($blockedRegions[$i][1] >= $newRegion[0] && $blockedRegions[$i][0] <= $newRegion[1]) {
			echo "merge! " . $blockedRegions[$i][0] . "," . $blockedRegions[$i][1] . "<br>";
			echo "with! " . $newRegion[0] . "," . $newRegion[1] . "<br>";
			$blockedRegions[$i] = array(min($blockedRegions[$i][0], $newRegion[0]), max($blockedRegions[$i][1], $newRegion[1]));
			$hasMerged = $i;
			break;
		}
	}
	if ($hasMerged == -1) {
		array_push($blockedRegions, $newRegion);
	}
	else {
		$bup = $blockedRegions[$hasMerged];
		array_splice($blockedRegions, $hasMerged, 1);
		AddRegion($blockedRegions, $bup);
	}
}

fclose($input);
?> 

</body></html>