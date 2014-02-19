<?php
include 'config.php';
require 'vendor/autoload.php';

$connection = Simpleblog\Database\DatabaseConnection::getConnection($config);

$request = new Simpleblog\Controller\Request;

$router = new Simpleblog\Controller\Router($request);
$router->route();

$dispatcher = new Simpleblog\Controller\Dispatcher($request, $connection);
$dispatcher->dispatch();










