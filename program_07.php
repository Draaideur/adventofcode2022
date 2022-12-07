<html><body bgcolor=#113300 style="color:#FFFFFF">

<?php
$input = fopen("input_07.txt", "r") or die("Unable to open file!");

$fileTree = array("/");
$navigation = array();
while (!feof($input)) {
	$line = str_replace("\r\n", "", fgets($input));
	echo $line . "<br>";
	if ($line[0] == '$') {
		if ($line == "$ cd /") {
			$navigation = array();
			echo "> reset nav <br>";
			continue;
		}
		if ($line == "$ cd ..") {
			array_pop($navigation);
			echo "> nav popped: [" . implode(",", $navigation) . "]<br>";
			continue;
		}
		if (str_starts_with($line, "$ cd ")) {
			$line = str_replace("$ cd ", "", $line);
			$currentDir =& getCurrentDirArray($fileTree, $navigation);
			$pushed = false;
			for ($d = 1; $d < count($currentDir); $d++) {
				if (gettype($currentDir[$d]) == "array" && $currentDir[$d][0] == $line) {
					array_push($navigation, $d);
					$pushed = true;
				}
			}
			if ($pushed == false) {
				echo "!!!! didn't find the dir to cd to !!!!<br>";
			}
			echo "> nav pushed: [" . implode(",", $navigation) . "]<br>";
			continue;
		}
		if ($line == "$ ls") {
			echo "> do nothing <br>";
			continue;
		}
	}
	else {
		$toPush = 0;
		if (str_starts_with($line, "dir ")) {
			$toPush = array(str_replace("dir ", "", $line));
		}
		else {
			$toPush = explode(" ", $line)[0];
		}
		$dir =& getCurrentDirArray($fileTree, $navigation);
		array_push($dir, $toPush);
		echo "> pushed <br>";
	}
}

fclose($input);

$mem = 999999999;
echo "total size: " . getDirSize($fileTree, $mem) . "<br>";
echo "mem: " . $mem;

function getDirSize(&$dir, &$mem) {
	$size = 0;
	for ($i = 0; $i < count($dir); $i++) {
		if (gettype($dir[$i]) == "array") {
			$size += getDirSize($dir[$i], $mem);
		}
		else {
			$size += (int)$dir[$i];
		}
	}
	if ($size >= 30000000 - (70000000 - 41412830) && $size < $mem) {
		$mem = $size;
	}
	return $size;
}

function &getCurrentDirArray(&$tree, $nav) {
	$currentDir =& $tree;
	for ($i = 0; $i < count($nav); $i++) {
		$currentDir =& $currentDir[$nav[$i]];
	}
	return $currentDir;
}
?> 

</body></html>