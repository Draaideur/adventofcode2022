<html><body bgcolor=#113300 style="color:#FFFFFF">

<?php
$input = fopen("input_10.txt", "r") or die("Unable to open file!");

$x = 1;
$cycleNr = 0;
$answer = 0;
while (!feof($input)) {
	$line = str_replace("\r\n", "", fgets($input));
	if ($line == "noop") {
		cycle($x, $cycleNr, $answer);
	}
	else {
		$line = explode(" ", $line);
		cycle($x, $cycleNr, $answer);
		$x += (int)$line[1];
		cycle($x, $cycleNr, $answer);
	}
}

function cycle($x, &$cycleNr, &$answer) {
	$cycleNr += 1;
	if ($cycleNr > 40) {
		$cycleNr -= 40;
		echo "<br>";
	}
	if ($x - 1 <= $cycleNr && $x + 1 >= $cycleNr) {
		echo "#";
	}
	else {
		echo "_";
	}
}


fclose($input);
?> 

</body></html>