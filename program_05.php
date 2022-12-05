<html><body bgcolor=#113300 style="color:#FFFFFF">

<?php
$input = fopen("input_05.txt", "r") or die("Unable to open file!");

$craneType = 9001;

$line = str_replace("\r\n", "", fgets($input));
$stacks = array();
for ($i = 0; $i < (strlen($line) + 1) / 4; $i++) {
	$stacks[$i] = array();
}
while($line[1] != '1') {
	for ($i = 0; $i < count($stacks); $i++) {
		if ($line[1 + ($i * 4)] != ' ') {
			$stacks[$i][count($stacks[$i])] = $line[1 + ($i * 4)];
		}
	}
	$line = str_replace("\r\n", "", fgets($input));
}
for ($i = 0; $i < count($stacks); $i++) {
	$stacks[$i] = array_reverse($stacks[$i]);
	echo implode(",", $stacks[$i]) . "<br>";
}
echo "<br>";

$line = str_replace("\r\n", "", fgets($input));

while (!feof($input)) {
	$line = str_replace("\r\n", "", fgets($input));
	$line = str_replace("move ", "", $line);
	$line = str_replace(" from ", ",", $line);
	$line = str_replace(" to ", ",", $line);
	$inputSplit = explode(",", $line);
	$stackFrom = (int)$inputSplit[1] - 1;
	$stackTo = (int)$inputSplit[2] - 1;
	if ($craneType == 9000) {
		for ($i = 0; $i < (int)$inputSplit[0]; $i++) {
			$stacks[$stackTo][count($stacks[$stackTo])] = $stacks[$stackFrom][count($stacks[$stackFrom]) - 1];
			array_pop($stacks[$stackFrom]);
		}
	}
	else if ($craneType == 9001) {
		for ($i = 0; $i < (int)$inputSplit[0]; $i++) {
			$stacks[$stackTo][count($stacks[$stackTo])] = $stacks[$stackFrom][count($stacks[$stackFrom]) - (int)$inputSplit[0] + $i];
		}
		for ($i = 0; $i < (int)$inputSplit[0]; $i++) {
			array_pop($stacks[$stackFrom]);
		}
	}
}
echo "<br><br>";
for ($i = 0; $i < count($stacks); $i++) {
	echo implode(",", $stacks[$i]) . "<br>";
}

fclose($input);
?> 

</body></html>