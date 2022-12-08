<?php

$input = file(__DIR__ . '/7input.txt');
$tree = [];

foreach($input as $line) {
  $data = explode(' ', trim($line));
    if($data[0] == '$') {
      switch (trim($line)) {
        case '$ cd /':
          $path = '/>';
          break;
        case '$ cd ..': 
          $path = substr($path, 0, strrpos(trim($path), '>', -2) - strlen($path)+1);
          break;
        case '$ ls': 
          continue 2;
        default: 
          $path .= $data[2] . '>';
          break;
        }
    } elseif($data[0] != 'dir') {
			$directories = $path;
       for($i = substr_count($directories, '>'); $i > 0; $i--) { 
        if($directories != ' ' && $directories != null && $directories != '') {
          if (!isset($tree[$directories])) {
          	$tree[$directories] = 0;
          }

          $tree[$directories] += intval($data[0]);
        }

        $directories = substr($directories, 0, strrpos(trim($directories), '>', -2) - strlen($directories) + 1);
       }
    }
}

$discSpace = 70000000;
$maxSize = 100000;
$minSize = 30000000;
$totalSize = 0;
$toDelete = [ 
	'size' => ''
];

foreach($tree as $dir => $size) {
    if($dir !== '/') {
        if ($size <= $maxSize) {
            $totalSize += $size;
        }
        if((
        	((($discSpace - $tree['/>']) + $size) >= $minSize) && $size < $toDelete['size']) 
        	|| $toDelete['size'] == '') {
            $toDelete['size'] = $size;
        }
    }
}

echo "Part1: $totalSize \n"; 
echo "Part2: " . $toDelete['size'] . " \n";