<html><body bgcolor=#113300 style="color:#FFFFFF">

<?php
$input = fopen("input_03.txt", "r") or die("Unable to open file!");
$totalPriority = 0;
while(!feof($input)) {
	$bag1 = array_fill(0, 53, false);
	$bag2checkedWith1 = array_fill(0, 53, false);

	$line = str_replace("\r\n", "", fgets($input));
	for ($i = 0; $i < strlen($line); $i++) {
		$priority = ord($line[$i]) - 96;
		if ($priority < 1) {
			$priority = $priority + 96 - 64 + 26;
		}
		$bag1[$priority] = true;
	}

	$line = str_replace("\r\n", "", fgets($input));
	for ($i = 0; $i < strlen($line); $i++) {
		$priority = ord($line[$i]) - 96;
		if ($priority < 1) {
			$priority = $priority + 96 - 64 + 26;
		}
		$bag2checkedWith1[$priority] = $bag1[$priority] && true;
	}

	$line = str_replace("\r\n", "", fgets($input));
	for ($i = 0; $i < strlen($line); $i++) {
		$priority = ord($line[$i]) - 96;
		if ($priority < 1) {
			$priority = $priority + 96 - 64 + 26;
		}
		if ($bag2checkedWith1[$priority]) {
			$totalPriority += $priority;
			break;
		}
	}
}
echo $totalPriority;
fclose($input);
?> 

</body></html>