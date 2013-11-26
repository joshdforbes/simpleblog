<?php 
include '../config.php';
include '../classes/Logger.class.php';
include '../classes/DatabaseConnection.class.php';
include '../classes/Article.class.php';

$connection = new DatabaseConnection($config);
var_dump(Article::getById($connection->connection, 1));
