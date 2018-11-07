<?php

$file = fopen('data/task1-train.csv', 'r');
while (($line = fgetcsv($file)) !== FALSE) {
   print_r($line);
}
fclose($file);