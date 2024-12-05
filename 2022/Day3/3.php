<?php 

$alphabet = '0abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$position = 0;

// Part 1
foreach (file('./3input.txt') as $line) {
	$line = trim($line);
	//echo "Line: $line - ";
	$strArray = str_split($line, floor(strlen($line)/2));
	$common = implode(
		array_unique(
			array_intersect(
				str_split($strArray[0]), 
				str_split($strArray[1])
			)
		));
	//echo "Common: $common \n";
	$position += strpos($alphabet, $common);
}

echo "Part1: $position \n";

$input = file('./3input.txt');

$position2 = 0;
foreach(array_chunk($input, 3) as $group) {
	
		$common = implode(
		array_unique(
			array_intersect(
				str_split(trim($group[0])), 
				str_split(trim($group[1])),
				str_split(trim($group[2])),
			)
		));
		$position2 += strpos($alphabet, $common);
}

echo "Part2: $position2 \n";