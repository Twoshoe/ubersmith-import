#!/usr/bin/env php

<?php

require_once __DIR__ . '/csv.inc.php';

# TODO:
# Add getopt support
# Add a --csv <filename> option with getopt
# If the --csv option is set, fopen the file and replace references to STDOUT with that file handle

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
		$data = read_csv($argv[2]);
        api_with_csv($argv[1], $data);
        break;
}

function api($api_name) {
    // Import Authentication
    require_once __DIR__ . '/auth.inc.php';

    try {
        $result = $api_client->call($api_name);
        echo "Success\n";
        print_r($result);
		# $handle = fopen(__DIR__ . "/csv/${filename}.csv", "w");
		$headers = array_keys(flatten($result));
		fputcsv(STDOUT, $headers);
		foreach ($result as $r) {
			/*print_r(flatten($r));*/
			fputcsv(STDOUT, array_values(flatten($r)));
		}
		# fclose($handle);
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

function flatten(array $array) {
	$return = array();
	array_walk_recursive($array, function($a,$b) use (&$return) {
		$return[$b] = $a;
	}
	);
	return $return;
}
