<html><body bgcolor=#113300 style="color:#FFFFFF">

<?php
$input = fopen("input_03.txt", "r") or die("Unable to open file!");
// Output one line until end-of-file
$totalPriority = 0;
while(!feof($input)) {
	$line = str_replace("\r\n", "", fgets($input));
	$bag1 = array_fill(0, 53, false);
	$bag2 = array_fill(0, 53, false);
	for ($i = 0; $i < strlen($line); $i++) {
		$priority = ord($line[$i]) - 96;
		if ($priority < 1) {
			$priority = $priority + 96 - 64 + 26;
		}
		if ($i < strlen($line) / 2) {
			$bag1[$priority] = true;
		}
		else {
			if ($bag1[$priority] == true) {
				$totalPriority += $priority;
				break;
			}
		}
	}
}
echo $totalPriority;
fclose($input);
?> 

</body></html>