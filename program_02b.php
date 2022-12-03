<html><body bgcolor=#113300 style="color:#FFFFFF">

<?php
$input = fopen("input_02.txt", "r") or die("Unable to open file!");
// Output one line until end-of-file
$totalScore = 0;
while(!feof($input)) {
	$line = str_replace("\r\n", "", fgets($input));
	$opponent = $line[0];
	$us = $line[2];
	if ($us == 'X') {
		$totalScore += 0;
		if ($opponent == 'A') {
			$totalScore += 3;
		}
		else if ($opponent == 'B') {
			$totalScore += 1;
		}
		else if ($opponent == 'C') {
			$totalScore += 2;
		}
	}
	else if ($us == 'Y') {
		$totalScore += 3;
		if ($opponent == 'A') {
			$totalScore += 1;
		}
		else if ($opponent == 'B') {
			$totalScore += 2;
		}
		else if ($opponent == 'C') {
			$totalScore += 3;
		}
	}
	else if ($us == 'Z') {
		$totalScore += 6;
		if ($opponent == 'A') {
			$totalScore += 2;
		}
		else if ($opponent == 'B') {
			$totalScore += 3;
		}
		else if ($opponent == 'C') {
			$totalScore += 1;
		}
	}
}
echo $totalScore;
fclose($input);
?> 

</body></html>