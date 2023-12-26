<?php

$filename = $argv[2];
$contents = file($filename);
if ($contents === false) {
    exit(1);
}

// Dictionary to allow the header to stay in csv's
$rows = array_map('str_getcsv', $contents);
$header = array_shift($rows);
$csv = array();
foreach ($rows as $row) {
    $csv[] = array_combine($header, $row);
}

