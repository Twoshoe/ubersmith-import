<?php

// Path to Ubersmith API Configuration file
require_once __DIR__ .'/config.inc.php';

// Path to class file
require_once dirname(__FILE__) .'/class.uber_api_client.php'; // include the Ubersmith API Client

// Token Authentication
$api_client = new uber_api_client($config['domain'], $config['api_username'], $config['api_token']);

