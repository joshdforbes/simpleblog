<?php
namespace Simpleblog\Database;

use Simpleblog\Classes\Logger;

class DatabaseConnection
{
	/**
	 * database connection
	 * 
	 * @var PDO
	 */
	private static $connection;

	/**
	 * attempt to connect to the database specified by the settings
	 * in a config file.
	 * 
	 * @param array $config contains settings for database connection
	 *
	 * @throws PDOException If connection fails then write to log file
	 */
	private function __construct($config)
	{
		try {
			$connection = new \PDO('mysql:host='.$config['database']['host'].';dbname='.$config['database']['database'], 
				$config['database']['username'], 
				$config['database']['password']);

			$connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			self::$connection = $connection;
		} catch (\PDOException $e){
			Logger::log($e->getMessage());
		}
	}

	/**
	 * singleton for connection. Either gets the current connection or creates
	 * a connection if it doesn't already exist. 
	 * 
	 * @param  array $config contains settings for database connection
	 * @return DatabaseConnection  returns a database connection
	 */
	public static function getConnection($config)
	{
		if (!self::$connection) {
			new DatabaseConnection($config);
		}
		return self::$connection;
	}

}