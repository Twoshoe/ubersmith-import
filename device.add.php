<?php

// Path to Ubersmith API Configuration file
require_once __DIR__ .'/config.inc.php';

// Path to class file
require_once dirname(__FILE__) .'/class.uber_api_client.php'; // include the Ubersmith API Client

// Token Authentication
$api_client = new uber_api_client($config['domain'], $config['api_username'], $config['api_token']);

// To open and read through CSV file provided for import
$filename = 'devices.csv'; // Name of my CSV file
$fh = fopen($filename, 'r');
if ($fh !== false) {
    while (($row = fgetcsv($fh)) !== FALSE) {
        $dev_desc = $row[0];
        $label = $row[1];
        $type_id = $row[2];
        //Device Assignment, likely added later? Requires Device_ID
        //$device_ip = $row[3],
        // Also looking to get parent info here, but would need Device_ID
        //$parent = $row[4],


        try {

            $result = $api_client->call('device.add',array(
                'dev_desc' => $dev_desc,
                'type_id' => $type_id,
                'label' => $label
                //'parent' => $parent,
                //'device.ip_assignment_add' => $device_ip, // No coma for the final entry?
            ));

            echo 'Success!';

        } catch (Exception $e) {
            print 'Error: Device  ' . $client . $e->getMessage() .' ('. $e->getCode() .')'. "\n";

        }


    }
}
