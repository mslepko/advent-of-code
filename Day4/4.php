<?php

$input = file(__DIR__ . "/4input.txt");

$fullyContains = 0;
$overlaps = 0;

foreach($input as $line) {
	$pairs = explode(',', trim($line));
	$range1 = explode('-', $pairs[0]);
	$range2 = explode('-', $pairs[1]);
	$pair1 = range($range1[0], $range1[1]);
	$pair2 = range($range2[0], $range2[1]);
	echo "Pair1: $pairs[0] - Pair2: $pairs[1] \n";
	
	if (
		empty(array_diff($pair1, $pair2)) 
		|| empty(array_diff($pair2, $pair1))
		) {
		$fullyContains++;
	}

	if (
		!empty(array_intersect($pair1, $pair2)) 
		|| !empty(array_intersect($pair2, $pair1))
		) {
		$overlaps++;
	}
}

echo "Part1 - $fullyContains \n";
echo "Part2 - $overlaps \n";