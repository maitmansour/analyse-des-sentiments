<?php

$full_data=[];
$words=[];
$index=1;
$train_limit=0;
$file = fopen('data/task1-train.csv', 'r');
while (($line = fgetcsv($file,0,"\t")) !== FALSE) {
	if (count($line)==3) {
		array_push($full_data, $line);
	}
  }
fclose($file);
$train_limit=count($full_data)-1;

$file = fopen('data/task1-testGold.csv', 'r');
while (($line = fgetcsv($file,0,"\t")) !== FALSE) {
	if (count($line)==3) {
		array_push($full_data, $line);
	}
  }
fclose($file);

$tmp_contents="";
foreach ($full_data as $keyFD => $valueFD) {
	$tmp_words=explode(" ", $valueFD[1]);

	switch ($valueFD[2]) {
		case 'objective':
			$label="0";
			break;
		case 'positif':
			$label="1";
			break;
		case 'negative':
			$label="2";
			break;
		case 'mixte':
			$label="3";
			break;
		default:
			continue;
	}

	$tmp_pair="";
	foreach ($tmp_words as $key => $value) {
		if (isset($words[$value])) {
			$index_word=$words[$value];
		}else{
			$words[$value]=$index;
			$index_word=$index;
			$index++;
		}

		$tmp_repetition=0;
		foreach ($tmp_words as $keyTmp => $valueTmp) {
			if ($value==$valueTmp) {
				$tmp_repetition++;
			}
		}

		$tmp_pair.=$index_word.":".$tmp_repetition." ";

	}

	$tmp_contents.=$label." ".substr($tmp_pair, 0,-1)."\0";
	if($keyFD==$train_limit){
		echo file_put_contents("/var/www/html/analyse-des-sentiments/output/train.svm",$tmp_contents);
		$tmp_contents="";
	}
}

		echo file_put_contents("/var/www/html/analyse-des-sentiments/output/test.svm",$tmp_contents);
