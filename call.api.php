#!/usr/bin/env php

<?php

switch ($argc) {
    case 1:
        echo "Missing API call\n";
        exit(1);
        break;
    case 2:
        echo "Calling function without arguments\n";
        api($argv[1]);
        break;
    case 3:
        echo "Calling function with CSV\n";
        // Import custom CSV library
        require_once __DIR__ . '/csv.inc.php';
        api_with_csv($argv[1], $csv);
        break;
}

function api($api_name) {
    // Import Authentication
    require_once __DIR__ . '/auth.inc.php';

    try {
        $result = $api_client->call($api_name);
        echo "Success\n";
        print_r($result);
        return $result;
    } catch (Exception $e) {
        print 'Error: Device  ' . $client . $e->getMessage() .' ('. $e->getCode() .')'. "\n";
    }
}

function api_with_csv($api_name, $csv_data) {
    // Import Authentication
    require_once __DIR__ . '/auth.inc.php';

    $row = null;
    foreach ($csv_data as $row) {
        try {
            $result = $api_client->call($api_name, $row);
            echo "Success\n";
            print_r($result);
        } catch (Exception $e) {
         print 'Error: Device  ' . $client . $e->getMessage() .' ('. $e->getCode() .')'. "\n";
        }
    }
}
