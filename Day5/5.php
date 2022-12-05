<?php 

$input_lines = file(__DIR__.'/5input.txt');
$stacks = [
  1 => strrev('JHGMZNTF'),
  2 => strrev('VWJ'),
  3 => strrev('GVLJBTH'),
  4 => strrev('BPJNCDVL'),
  5 => strrev('FWSMPRG'),
  6 => strrev('GHCFBNVM'),
  7 => strrev('DHGMR'),
  8 => strrev('HNMVZD'),
  9 => strrev('GNFH'),
];

$stacks2 = $stacks;

foreach ($input_lines as $line) {
	preg_match('/^move (\d+) from (\d+) to (\d+)$/', $line, $output_array);
	if (count($output_array) < 4) continue;
	$count = $output_array[1];
	$stack_from = $output_array[2];
	$stack_to = $output_array[3];
	$move = substr($stacks[$stack_from], 0, $count);

	$stacks[$stack_from] = substr($stacks[$stack_from],$count);
	$stacks[$stack_to] = strrev($move).$stacks[$stack_to];

	//Part2
	$move = substr($stacks2[$stack_from], 0, $count);
	$stacks2[$stack_from] = substr($stacks2[$stack_from], $count);
	$stacks2[$stack_to] = $move . $stacks2[$stack_to];
	
}

$top1 = '';
foreach($stacks as $stack) {
	$top1 .= substr($stack,0,1);
}
echo "Part1: $top1";

$top2 = '';
foreach($stacks2 as $stack) {
	$top2 .= substr($stack,0,1);
}
echo "\nPart2: $top2";