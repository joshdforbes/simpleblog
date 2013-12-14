<?php
namespace Simpleblog\Model;

use Simpleblog\Classes\Logger;

abstract class Model
{
	protected $connection;
	protected $id;

	public function __construct(\PDO $connection, array $data)
	{
		$this->connection = $connection;
		$this->id = isset($data['id']) 
			? (int) $data['id']
			: null;
	}

	public static function find(\PDO $connection, $id)
	{
		try {
			$query = $connection->prepare("SELECT * from ".static::$table." WHERE id = :id LIMIT 1");
			$query->bindParam(':id', $id);
			$query->execute();

			return ($query->rowCount() === 1)
				? new static($connection, $query->fetch(\PDO::FETCH_ASSOC))
				: false;
		} catch (\PDOException $e) {
			Logger::log($e->getMessage());
			return false;
		}
	}

	public static function findAll(\PDO $connection, $orderBy = "date DESC", $starting = 0, $ending = 5)
	{
		try {
			$query = $connection->prepare("SELECT * FROM ".static::$table." ORDER BY :orderBy LIMIT :starting, :ending");
			$query->bindParam(':orderBy', $orderBy);
			$query->bindParam(':starting', $starting, \PDO::PARAM_INT);
			$query->bindParam(':ending', $ending, \PDO::PARAM_INT);
			$query->execute();

			while ($result = $query->fetch(\PDO::FETCH_ASSOC) ) {
      			$result = new static($connection, $result);
      			$results[] = $result;
    		}

    		return (count($results) > 1)
    			? $results
    			: false;
		} catch (\PDOException $e) {
			Logger::log($e->getMessage());
			return false;
		}
	}

	public function save()
	{
		if (is_null($this->id)) {
			$this->insert();
		} else {
			$this->update();
		}
	}

	public abstract function insert();

	public abstract function update();

	public abstract function delete();
}