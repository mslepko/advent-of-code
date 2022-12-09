<?php

$input = file(__DIR__ . '/8input.txt');
$length = count($input);

$grid = [];
for($i=0; $i<$length; $i++) {
	$row = trim($input[$i]);
	$grid[$i] = str_split($row);
}

/**
 * 
 * 
 * $direction = true|false (true => to bottom, to right, false => to top, to left)
 */
function getTreesHeight($start, $stop, $col, 
	$direction = true, $rows = false) {
	global $grid;
	$trees = [];

	for($start; 
		$direction ? $start < $stop : $start >= $stop; 
		$direction ? $start++ : $start--) {
		
		if ($rows) {
			$height = intval($grid[$col][$start]);
		} else {
			$height = intval($grid[$start][$col]);
		}
		//echo "Z: $start = k: $col = $height\n";
		array_push($trees, $height);
	}
	return max($trees);
}

// Left column + right column
$visible = 2*$length;

// top row - 2 elements in left and right column
$visible += count(array_keys($grid[0])) - 2;

// bottom row - 2 elements in left and right column
$visible += count(array_keys($grid[$length-1])) - 2;

$gridColumns = count($grid[0]);
$gridRows = count(array_keys($grid));

for ($j=1; $j<$gridColumns-1; $j++) {
	for($k=1; $k<$gridRows-1; $k++) {
		$treeSize = $grid[$j][$k];
		//echo "$j x $k = $treeSize\n";
		//echo "Tree size: $treeSize\n";
		//checking from tree to top
		$maxHeightTop = getTreesHeight($j-1, 0, $k, false);
		//echo "Max to top: $maxHeightTop\n";
		if ($treeSize > $maxHeightTop) {
			$visible++;
			continue;
		}
		// // from tree to bottom
		$maxHeightBottom = getTreesHeight($j+1, $gridRows, $k, true);
		//echo "Max to bottom: $maxHeightBottom\n";
		if ($treeSize > $maxHeightBottom) {
			$visible++;
			continue;
		}

		//from tree to left
		$maxHeightLeft = getTreesHeight($k-1, 0, $j, false, true);
		//echo "Max to left: $maxHeightLeft\n";
		if ($treeSize > $maxHeightLeft) {
			$visible++;
			continue;
		}

		// from tree to right
		$maxHeightRight = getTreesHeight($k+1, $gridColumns, $j, true, true);
		//echo "Max to right: $maxHeightRight\n";
		if ($treeSize > $maxHeightRight) {
			$visible++;
			continue;
		}
	}
}

echo "Part: $visible trees are visible\n";

// Part2
function getTreesCount($treeHeight, $start, $stop, $col, 
	$direction = true, $rows = false) {
	global $grid;
	$sees = 0;

	for($start; 
		$direction ? $start < $stop : $start >= $stop; 
		$direction ? $start++ : $start--) {
		
		if ($rows) {
			$height = intval($grid[$col][$start]);
		} else {
			$height = intval($grid[$start][$col]);
		}
		//echo "Z: $start = k: $col = $height\n";
		if ($height >= $treeHeight) {
			$sees++;
			break;
		} else {
			$sees++;
		}
	}
	return $sees;
}

$scenic = [];

for ($j=1; $j<$gridColumns-1; $j++) {
	for($k=1; $k<$gridRows-1; $k++) {
		$treeSize = $grid[$j][$k];
		$seeTop = getTreesCount($treeSize, $j-1, 0, $k, false);
		$seeBottom = getTreesCount($treeSize, $j+1, $gridRows, $k, true);
		$seeLeft = getTreesCount($treeSize, $k-1, 0, $j, false, true);
		$seeRight = getTreesCount($treeSize, $k+1, $gridColumns, $j, true, true);

		//echo "Tree: $treeSize\n";
		//echo "Top: $seeTop - B: $seeBottom - L: $seeLeft - R: $seeRight\n";
		array_push($scenic, ($seeTop * $seeBottom * $seeLeft * $seeRight));
	}
}

echo "Part2: max scenic score is ", max($scenic), "\n";