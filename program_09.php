<html><body bgcolor=#113300 style="color:#FFFFFF">

<?php
$input = fopen("input_09.txt", "r") or die("Unable to open file!");

$lines = array();
$x = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
$y = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
$visitedSpots = array();
array_push($visitedSpots, $x[9] . "," . $y[9]);

while (!feof($input)) {
	$line = str_replace("\r\n", "", fgets($input));
	$lineParts = explode(" ", $line);
	$xdir = 0;
	$ydir = 0;
	if ($lineParts[0] == "U") {
		$ydir = 1;
	}
	if ($lineParts[0] == "D") {
		$ydir = -1;
	}
	if ($lineParts[0] == "R") {
		$xdir = 1;
	}
	if ($lineParts[0] == "L") {
		$xdir = -1;
	}
	$steps = (int)$lineParts[1];
	for ($i = 0; $i < $steps; $i++) {
		$x[0] += $xdir;
		$y[0] += $ydir;
		for ($p = 1; $p <= 9; $p++) {
			if (abs($x[$p - 1] - $x[$p]) + abs($y[$p - 1] - $y[$p]) > 2) {
				if ($x[$p - 1] - $x[$p] > 0) {
					$x[$p] += 1;
				}
				else if ($x[$p - 1] - $x[$p] < 0) {
					$x[$p] -= 1;
				}
				if ($y[$p - 1] - $y[$p] > 0) {
					$y[$p] += 1;
				}
				else if ($y[$p - 1] - $y[$p] < 0) {
					$y[$p] -= 1;
				}
			}
			else {
				if ($x[$p - 1] - $x[$p] > 1) {
					$x[$p] += 1;
				}
				else if ($x[$p - 1] - $x[$p] < -1) {
					$x[$p] -= 1;
				}
				if ($y[$p - 1] - $y[$p] > 1) {
					$y[$p] += 1;
				}
				else if ($y[$p - 1] - $y[$p] < -1) {
					$y[$p] -= 1;
				}
			}
		}
		array_push($visitedSpots, $x[9] . "," . $y[9]);
	}
}

echo count(array_unique($visitedSpots)) . "<br>";
#echo "[" . implode("]<br>[", $visitedSpots) . "]";

fclose($input);
?> 

</body></html>