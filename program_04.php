<html><body bgcolor=#113300 style="color:#FFFFFF">

<?php
$input = fopen("input_04.txt", "r") or die("Unable to open file!");
$totalContainedElves = 0;
$totalOverlappingPairs = 0;
while(!feof($input)) {
	$line = str_replace("\r\n", "", fgets($input));
	$inputSplit = explode(",", $line);
	$elves = [explode("-", $inputSplit[0]), explode("-", $inputSplit[1])];
	if (($elves[0][0] <= $elves[1][0] && $elves[0][1] >= $elves[1][1]) || ($elves[1][0] <= $elves[0][0] && $elves[1][1] >= $elves[0][1])) {
		$totalContainedElves += 1;
	}
	if (($elves[0][0] <= $elves[1][1] && $elves[0][1] >= $elves[1][0]) || ($elves[1][0] <= $elves[0][1] && $elves[1][1] >= $elves[0][0])) {
		$totalOverlappingPairs += 1;
	}
}
echo "Fully contained elves: " . $totalContainedElves . "<br>";
echo "Overlapping pairs: " . $totalOverlappingPairs;
fclose($input);
?> 

</body></html>