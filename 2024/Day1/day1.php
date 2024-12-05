<?php

$day1Input = file_get_contents('day1.txt');
$lines = explode("\n", trim($day1Input));

$leftList = [];
$rightList = [];

foreach ($lines as $line) {
    list($left, $right) = preg_split('/\s+/', trim($line));
    $leftList[] = (int)$left;
    $rightList[] = (int)$right;
}

function calculateTotalDistance($leftList, $rightList) {
    sort($leftList);
    sort($rightList);

    $totalDistance = 0;

    for ($i = 0; $i < count($leftList); $i++) {
        $totalDistance += abs($leftList[$i] - $rightList[$i]);
    }

    return $totalDistance;
}

$totalDistance = calculateTotalDistance($leftList, $rightList);

echo "Part 1. Total Distance: " . $totalDistance . "\n";

function calculateTotalSimilarityScore($leftList, $rightList) {
    $rightCount = array_count_values($rightList);

    $totalSimilarityScore = 0;

    foreach ($leftList as $number) {
        if (isset($rightCount[$number])) {
            $totalSimilarityScore += $number * $rightCount[$number];
        }
    }

    return $totalSimilarityScore;
}

$totalSimilarityScore = calculateTotalSimilarityScore($leftList, $rightList);
echo "Part 2. Total Similarity Score: " . $totalSimilarityScore . "\n";
