<?php

$full_data=[];

$file = fopen('data/task1-train.csv', 'r');
while (($line = fgetcsv($file,0,"\t")) !== FALSE) {
	if (count($line)==3) {
		array_push($full_data, $line);
	}
  }
fclose($file);

var_dump($full_data); die;