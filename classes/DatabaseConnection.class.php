<?php

class DatabaseConnection extends PDO
{
	public $connection;

	public function __construct($config)
	{
		try {
			$connection = new PDO('mysql:host='.$config['database']['host'].';dbname='.$config['database']['database'], 
				$config['database']['username'], 
				$config['database']['password']);

			$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$this->connection = $connection;
			return $connection;
		} catch (PDOException $e){
			Logger::log($e->getMessage());
		}
	}

	public function getConnection()
	{
		return $connection;
	}

}