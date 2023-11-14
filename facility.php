<?php

// Path to Ubersmith API Configuration file
require_once __DIR__ .'/config.inc.php';

// Path to class file
require_once dirname(__FILE__) .'/class.uber_api_client.php'; // include the Ubersmith API Client

// Token Authentication
$api_client = new uber_api_client($config['domain'], $config['api_username'], $config['api_token']);

// To open and read through CSV file provided for import
$filename = 'csv/fac1.csv'; // Name of my CSV file
$fh = fopen($filename, 'r');
if ($fh !== false) {
    while (($row = fgetcsv($fh)) !== FALSE) {
        $fac_code = $row[0];
        $fac_name = $row[1];
        $fac_address = $row[2];
        $fac_city = $row[3];
        $fac_state = $row[4];
        $fac_zip = $row[5];
        $fac_country = $row[6];

        try {
            // Facility variables
            $result = $api_client->call('device.facility_add',array(
                'fac_code' => $fac_code,
                'fac_name' => $fac_name,
                'fac_address' => $fac_address,
                'fac_city' => $fac_city,
                'fac_state' => $fac_state,
                'fac_zip' => $fac_zip,
                'fac_country' => $fac_country

            ));

            echo 'Success!';

        } catch (Exception $e) {
            print 'Error: Device  ' . $client . $e->getMessage() .' ('. $e->getCode() .')'. "\n";

        }


    }
}
