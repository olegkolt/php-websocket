<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

use WebSocket\Client;

require(__DIR__ . '/../vendor/autoload.php');

$clients = array();
$testClients = 5;
$testMessages = 6;
for($i = 0; $i < $testClients; $i++)
{
	$clients[$i] = new Client;
	$clients[$i]->connect('127.0.0.1', 8000, '/demo', 'foo.lh');
}
usleep(5000);

$payload = json_encode(array(
	'action' => 'echo',
	'data' => 'dos'
));

for($i = 0; $i < $testMessages; $i++)
{
	$clientId = rand(0, $testClients-1);
	$clients[$clientId]->sendData($payload);
	usleep(5000);
}
usleep(5000);