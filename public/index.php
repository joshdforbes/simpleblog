<?php 
include '../config.php';
include '../classes/Logger.class.php';
include '../classes/DatabaseConnection.class.php';
include '../classes/Article.class.php';

$connection = DatabaseConnection::getConnection($config);
var_dump(Article::getById($connection, 1));
