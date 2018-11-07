<?php

$full_data=[];
$words=[];
$file = fopen('data/task1-train.csv', 'r');
while (($line = fgetcsv($file,0,"\t")) !== FALSE) {
	if (count($line)==3) {
		array_push($full_data, $line);
	}
  }
fclose($file);

$file = fopen('data/task1-testGold.csv', 'r');
while (($line = fgetcsv($file,0,"\t")) !== FALSE) {
	if (count($line)==3) {
		array_push($full_data, $line);
	}
  }
fclose($file);

foreach ($full_data as $key => $value) {
	$tmp_words=explode(" ", $value[1]);
	$words=array_merge($words,$tmp_words);
}
$unique_values = array_count_values($words);

var_dump($unique_values); die;