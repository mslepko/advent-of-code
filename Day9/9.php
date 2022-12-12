<?php

$input = file(__DIR__ . '/9input.txt');

$H = [0, 0];
$T = [0, 0];
$visited = [];

foreach ($input as $line) {
	$line = trim($line);
	list($direction, $steps) = explode(' ', $line);
	//var_dump($direction, $steps);
	for ($i=1; $i <= $steps; $i++) {
		switch ($direction):
			case 'U': $H[1]++; break;
			case 'D': $H[1]--; break;
			case 'L': $H[0]--; break;
			case 'R': $H[0]++; break;
		endswitch;
		
		$moveX = $H[0] - $T[0];
		$moveY = $H[1] - $T[1];
		//var_dump($moveX, $moveY);

		// move tail X
		if (abs($moveX) >= 2) {
			$T[0] += $moveX > 0 ? 1 : -1;
			if (abs($moveY) >= 1) {
				$T[1] += $moveY > 0 ? 1 : -1;
			} 
		}

		// move tail Y
		if (abs($moveY) >= 2) {
			$T[1] += $moveY > 0 ? 1 : -1;
			if (abs($moveX) >= 1) {
				$T[0] += $moveX > 0 ? 1 : -1;
			} 
		}

		array_push($visited, $T[0] . ',' . $T[1]);
	}
}

echo "Part 1: " . count(array_unique($visited)), "\n";

// Part 2
$knots = array_fill(0, 10, [0, 0]);
$visited2 = [];
foreach ($input as $line) {
	$line = trim($line);
	list($direction, $steps) = explode(' ', $line);
	//var_dump($direction, $steps);
	for ($i=1; $i <= $steps; $i++) {
		switch ($direction):
			case 'U': $knots[0][1]++; break;
			case 'D': $knots[0][1]--; break;
			case 'L': $knots[0][0]--; break;
			case 'R': $knots[0][0]++; break;
		endswitch;
		
		for($k = 1; $k <= 9; $k++) {
			$moveX = $knots[$k-1][0] - $knots[$k][0];
			$moveY = $knots[$k-1][1] - $knots[$k][1];
			//var_dump($moveX, $moveY);

			// move tail X
			if (abs($moveX) == 2) {
				$knots[$k][0] += $moveX > 0 ? 1 : -1;
				if (abs($moveY) == 1) {
					$knots[$k][1] += $moveY > 0 ? 1 : -1;
				} 
			}

			// move tail Y
			if (abs($moveY) == 2) {
				$knots[$k][1] += $moveY > 0 ? 1 : -1;
				if (abs($moveX) == 1) {
					$knots[$k][0] += $moveX > 0 ? 1 : -1;
				} 
			}
		}

		array_push($visited2, $knots[9][0] . ',' . $knots[9][1]);
	}
}

echo "Part2: " . count(array_unique($visited2)), "\n";

