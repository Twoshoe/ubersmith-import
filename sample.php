<?php

// Path to Ubersmith API Configuration file
require_once __DIR__ .'/config.inc.php';

require_once dirname(__FILE__) .'/class.uber_api_client.php';

$api_client = new uber_api_client($config['domain'], $config['api_username'], $config['api_token']);

try {
	$result = $client->call('client.get',array(
		'client_id' => 1001,
	));
	
	print_r($result);
} catch (Exception $e) {
	print 'Error: '. $e->getMessage() .' ('. $e->getCode() .')';
}

// end of script