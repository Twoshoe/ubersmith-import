#!/usr/bin/env php

<?php

require_once __DIR__ . '/api.php';

function main() {
    $result = api("device.list");
    $head = reset($result);

    if ($head) {
        print_r($head);
    }

    // Opens a new file
    $fh = fopen("csv/devices.csv", 'w');
    if (!$fh) {
        echo "Failed to open file.\n";
        exit(1);
    }
    
    $columns = array_keys($head);
    fputcsv($fh, $columns);
    foreach ($result as $dev_id => $value) {
        fputcsv($fh, $result[$dev_id]);
    }

    fclose($fh);
}

main();

