<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

use WebSocket\Server;

require(__DIR__ . '/../vendor/autoload.php');


$server = new Server('127.0.0.1', 8000, false);

// server settings:
$server->setMaxClients(100);
$server->setMaxConnectionsPerIp(100);
$server->setMaxRequestsPerMinute(2000);
$server->setCheckOrigin(false);

// Hint: Status application should not be removed as it displays usefull server informations:
$server->registerApplication('status', \WebSocket\Application\StatusApplication::getInstance());
$server->registerApplication('demo', \WebSocket\Application\DemoApplication::getInstance());

$server->run();