<?php
include 'config.php';
require 'vendor/autoload.php';

$connection = Simpleblog\Database\DatabaseConnection::getConnection($config);

// $testArray = array(
//     'id' => 2,
//     'author_id' => 1,
//     'date' => date('Ymd'),
//     'title' => 'Updated',
//     'content' => 'Again all the things'
// );

// $newPost = new Simpleblog\Model\Article($connection, $testArray);
// $newPost->save();

$request = new Simpleblog\Controller\Request;
$router = new Simpleblog\Controller\Router($request);
$router->route();

echo $request->getController();





