<?php

class DatabaseConnection
{
	private static $connection;

	private function __construct($config)
	{
		try {
			$connection = new PDO('mysql:host='.$config['database']['host'].';dbname='.$config['database']['database'], 
				$config['database']['username'], 
				$config['database']['password']);

			$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			self::$connection = $connection;
		} catch (PDOException $e){
			Logger::log($e->getMessage());
		}
	}

	public static function getConnection($config)
	{
		if (!self::$connection) {
			new DatabaseConnection($config);
		}
		return self::$connection;
	}

}