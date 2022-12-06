<html><body bgcolor=#113300 style="color:#FFFFFF">

<?php
$input = fopen("input_06.txt", "r") or die("Unable to open file!");

$line = str_replace("\r\n", "", fgets($input));

for ($i = 4; $i < strlen($line); $i++) {
	$foundDuplicate = false;
	for ($a = $i; $a > $i - 14; $a--) {
		for ($b = $a - 1; $b > $i - 14; $b--) {
			if ($line[$a] == $line[$b]) {
				$foundDuplicate = true;
				$i = $b + 13;
				break;
			}
		}
		if ($foundDuplicate) {
			break;
		}
	}
	if (!$foundDuplicate) {
		echo $i + 1;
		break;
	}
}

fclose($input);
?> 

</body></html>