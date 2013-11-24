<?php 
include '../config.php';
include '../classes/Logger.class.php';
include '../classes/DatabaseConnection.class.php';

$dbh = new DatabaseConnection($config);
