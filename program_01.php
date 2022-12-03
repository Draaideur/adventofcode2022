<html><body bgcolor=#113300 style="color:#FFFFFF">

<?php
$input = fopen("input_01.txt", "r") or die("Unable to open file!");
$richestElf = 0;
$currentElf = 0;
while(!feof($input)) {
	$line = str_replace("\r\n", "", fgets($input));
	if ($line == "") {
		if ($currentElf > $richestElf) {
			$richestElf = $currentElf;
		}
		$currentElf = 0;
	}
	else {
		$currentElf += (int) $line;
	}
}
echo $richestElf;
fclose($input);
?> 

</body></html>