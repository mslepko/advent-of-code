<?php
/*
Scoring
  0, // loss
  3, // draw
  6, // win

$opponent1 = [
 'A' => 1, //Rock
 'B' => 2, //Paper
 'C' => 3, //Scissors
];



*/

include_once './2rounds.php';

$opponent2 = [
 'X' => 1, //Rock
 'Y' => 2, //Paper
 'Z' => 3, //Scissors
];

$names = [
 'A' => 'Rock',
 'B' => 'Paper',
 'C' => 'Scissors',
 'X' => 'Rock',
 'Y' => 'Paper',
 'Z' => 'Scissors',
];

$winSolution = [
  'A' => 'Y',
  'B' => 'Z',
  'C' => 'X',
];

$drawSolution = [
  'A' => 'X',
  'B' => 'Y',
  'C' => 'Z',
];

$loseSolution = [
  'A' => 'Z',
  'B' => 'X',
  'C' => 'Y',
];

$myPoints = 0;

// Part 1
/*
foreach ($rounds as $round) {
	
	$o1 = key($round);
	$o2 = $round[$o1];

	$result = "$names[$o1] vs $names[$o2] : ";

	if (array_key_exists($o1, $winSolution) && $winSolution[$o1] == $o2) {
		//win
		$myPoints += 6;
		$result .= 'win';
	} elseif (array_key_exists($o1, $drawSolution) && $drawSolution[$o1] == $o2) {
		//draw
		$myPoints += 3;
		$result .= 'draw';
	} else {
		//lost
		$result .= 'lost';
	}
	$myPoints += $opponent2[$o2];
	echo $result, "\n";
} 

echo "Final score: $myPoints";
*/

// Part 2
/*
X = lose
Y = draw
Z = win
*/
foreach ($rounds as $round) {
	$o1 = key($round);
	$o2 = $round[$o1];

	if ($o2 == 'Z') {
		//win
		$myMove = $winSolution[$o1];
		$myPoints += 6;
	} elseif ($o2 == 'Y') {
		//draw
		$myMove = $drawSolution[$o1];
		$myPoints += 3;
	} else {
		//lose
		$myMove = $loseSolution[$o1];
	}

	echo "$names[$o1] vs $names[$myMove] \n";

	$myPoints += $opponent2[$myMove];
}

echo "Final score: $myPoints";