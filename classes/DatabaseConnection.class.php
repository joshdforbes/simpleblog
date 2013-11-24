<?php

class DatabaseConnection
{
	private $conn;

	public function __construct($config)
	{
		try {
			$conn = new PDO('mysql:host='.$config['database']['host'].';dbname='.$config['database']['database'], 
				$config['database']['username'], 
				$config['database']['password']);

			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$this->conn = $conn;
			return $conn;
		} catch (PDOException $e){
			Logger::log($e->getMessage());
		}
	}

	public function getConn()
	{
		return $conn;
	}

}