<html><body bgcolor=#113300 style="color:#FFFFFF">

<?php
$input = fopen("input_01.txt", "r") or die("Unable to open file!");
// Output one line until end-of-file
$richestElf1 = 0;
$richestElf2 = 0;
$richestElf3 = 0;
$currentElf = 0;
while(!feof($input)) {
	$line = str_replace("\r\n", "", fgets($input));
	if ($line == "") {
		if ($currentElf > $richestElf1) {
			$richestElf3 = $richestElf2;
			$richestElf2 = $richestElf1;
			$richestElf1 = $currentElf;
		}
		else if ($currentElf > $richestElf2) {
			$richestElf3 = $richestElf2;
			$richestElf2 = $currentElf;
		}
		else if ($currentElf > $richestElf3) {
			$richestElf3 = $currentElf;
		}
		$currentElf = 0;
	}
	else {
		$currentElf += (int) $line;
	}
}
echo $richestElf1 + $richestElf2 + $richestElf3;
fclose($input);
?> 

</body></html>