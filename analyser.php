<?php

$full_data=[];
$words=[];
$index=1;

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

	switch ($value[2]) {
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
		/*echo $tmp_pair;
			if ($index==40) {
			die;
		}*/

	}

	//$words=array_merge($words,$tmp_words);

	echo $label." ".$tmp_pair."<br>";
			if ($index==2) {
			die;
		}

}
