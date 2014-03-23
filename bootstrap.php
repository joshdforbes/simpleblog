<?php
include 'config.php';
require 'vendor/autoload.php';

$connection = Simpleblog\Database\DatabaseConnection::getConnection($config);

$request = new Simpleblog\Controller\Request;

$router = new Simpleblog\Controller\Router($request);
$router->route();
$dispatcher = new Simpleblog\Controller\Dispatcher($request, $connection);

try {
	$dispatcher->init();
	$dispatcher->dispatch();
} catch (\Exception $e) {
	$dispatcher->setController('error');
	$dispatcher->setAction($e->getMessage());
	$dispatcher->setParameters((array)$e);
	$dispatcher->dispatch();
}	













