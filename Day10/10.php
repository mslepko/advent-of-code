<?php

//$input = file(__DIR__ . '/10test.txt');
$input = file(__DIR__ . '/10input.txt');

$x = 1;
$cycle = 1;
$sum = 0;

$sprite = array_fill(0, 6, array_fill(0, 40, '.'));

//die(var_dump(count($sprite)));

function checkCycle($cycle, $x) {
	if ($cycle == 20 || (($cycle-20) % 40) == 0) {
		//echo "$cycle x $x = " . $cycle*$x, "\n";
		return intval($cycle*$x);
	}

	return 0;	
}

function drawCycle($cycle, $x) {
	global $sprite;
	$row = floor(($cycle-1) / 40);
	$position = ($cycle - (40*$row)) -1;
	//echo "Cycle: $cycle - X: $x - Row: $row - Pos: $position\n";
	//echo "Row: $row - Pos: $position\n";
	if ($position == $x || $position == $x-1 || $position == $x+1) {
		$sprite[$row][$position] = '#';
	}
}

foreach($input as $line) {
	$line = trim($line);
	$args = explode(' ', $line);
	$operation = $args[0];
	if ($operation == 'addx') {
		// 2 cycles
		$value = $args[1];
		for($z = 0; $z <= 1; $z++) {
			drawCycle($cycle, $x);
			if ($z == 1) {
				$x += $value;
			}
			//echo "Val: $value\n";
			$cycle++;
			$sum += checkCycle($cycle, $x);
		}
	} elseif ($operation == 'noop') {
		// 1 cycle does nothing
		drawCycle($cycle, $x);
		$cycle++;
		$sum += checkCycle($cycle, $x);
	}
}

echo "Part1: $sum\n";

//Part 2
echo "Part2\n";

echo implode('', $sprite[0]), "\n";
echo implode('', $sprite[1]), "\n";
echo implode('', $sprite[2]), "\n";
echo implode('', $sprite[3]), "\n";
echo implode('', $sprite[4]), "\n";
echo implode('', $sprite[5]), "\n";