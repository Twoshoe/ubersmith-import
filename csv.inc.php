<?php

function read_csv($filename) {
	$contents = file($filename);
	if ($contents === false) {
		return null;
	}

	$rows = array_map('str_getcsv', $contents);
	$header = array_shift($rows);
	$csv = array();

	foreach ($rows as $row) {
		$csv[] = array_combine($header, $row);
	}

	return $csv;
}
