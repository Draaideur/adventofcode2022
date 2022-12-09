<html><body bgcolor=#113300 style="color:#FFFFFF">

<?php
$input = fopen("input_08.txt", "r") or die("Unable to open file!");

$lines = array();
while (!feof($input)) {
	$line = str_replace("\r\n", "", fgets($input));
	array_push($lines, $line);
}

fclose($input);

$visibleTrees = array();
for ($x = 0; $x < strlen($lines[0]); $x++) {
	$highest2 = -1;
	$highest1 = -1;
	for ($y = 0; $y < count($lines); $y++) {
		if ((int)$lines[$y][$x] > $highest1) {
			array_push($visibleTrees, $x . "," . $y);
			$highest1 = (int)$lines[$y][$x];
		}
		if ((int)$lines[count($lines) - 1 - $y][$x] > $highest2) {
			array_push($visibleTrees, $x . "," . (count($lines) - 1 - $y));
			$highest2 = (int)$lines[count($lines) - 1 - $y][$x];
		}
	}
}
for ($y = 0; $y < count($lines); $y++) {
	$highest2 = -1;
	$highest1 = -1;
	for ($x = 0; $x < strlen($lines[0]); $x++) {
		if ((int)$lines[$y][$x] > $highest1) {
			array_push($visibleTrees, $x . "," . $y);
			$highest1 = (int)$lines[$y][$x];
		}
		if ((int)$lines[$y][strlen($lines[0]) - 1 - $x] > $highest2) {
			array_push($visibleTrees, (strlen($lines[0]) - 1 - $x) . "," . $y);
			$highest2 = (int)$lines[$y][strlen($lines[0]) - 1 - $x];
		}
	}
}

$visibleTrees = array_unique($visibleTrees);
echo "visible trees: " . count($visibleTrees) . "<br>";

$bestTreeScore = 0;
for ($x = 0; $x < strlen($lines[0]); $x++) {
	for ($y = 0; $y < count($lines); $y++) {
		$treeLength = (int)$lines[$y][$x];
		$treeScore = 0;
		$dis1 = 0;
		$dis2 = 0;
		$dis3 = 0;
		$dis4 = 0;
		for ($xx = $x - 1; $xx >= 0; $xx--) {
			$dis1++;
			if ((int)$lines[$y][$xx] >= $treeLength) {
				break;
			}
		}
		for ($xx = $x + 1; $xx < strlen($lines[0]); $xx++) {
			$dis2++;
			if ((int)$lines[$y][$xx] >= $treeLength) {
				break;
			}
		}
		for ($yy = $y - 1; $yy >= 0; $yy--) {
			$dis3++;
			if ((int)$lines[$yy][$x] >= $treeLength) {
				break;
			}
		}
		for ($yy = $y + 1; $yy < count($lines); $yy++) {
			$dis4++;
			if ((int)$lines[$yy][$x] >= $treeLength) {
				break;
			}
		}
		$treeScore = $dis1 * $dis2 * $dis3 * $dis4;
		if ($treeScore > $bestTreeScore) {
			$bestTreeScore = $treeScore;
		}
	}
}

echo "best tree score: " . $bestTreeScore;

?> 

</body></html>