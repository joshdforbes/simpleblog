<?php
namespace Simpleblog\Model;

use Simpleblog\Classes\Logger;

/**
 * Parent class for Models in the Simpleblog framework
 */
abstract class Model
{
	/**
	 * The connection used by the model
	 * 
	 * @var PDO
	 */
	protected $connection;

	/**
	 * The id of a single record in the model
	 * 
	 * @var string
	 */
	public $id;

	/**
	 * Create a new model instance
	 * 
	 * @param PDO   $connection
	 * @param array $data used to create child model
	 */
	public function __construct(\PDO $connection, array $data)
	{
		$this->connection = $connection;
		$this->id = isset($data['id']) 
			? (int) $data['id']
			: null;
	}

	/**
	 * searches database for a record that matches specified id
	 * 
	 * @param  PDO    $connection
	 * @param  string $id
	 * @return Model|false new Model instance or false
	 *
	 * @throws Exception routes to errorController calling databaseErrorAction
	 */
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
			Throw new \Exception('databaseError');
			return false;
		}
	}

	/**
	 * searches database and returns all instances of child Model
	 * 
	 * @param  PDO     $connection
	 * @param  string  $orderBy defaults to date DESC
	 * @param  integer $starting indicates where to start returning records, defaults to first record
	 * @param  integer $ending indicates where to stop returning records, defaults to five
	 * @return Model|false returns an array of Model instances or false
	 *
	 * @throws Exception routes to errorController calling databaseErrorAction
	 */
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
			Throw new \Exception('databaseError');
			return false;
		}
	}

	/**
	 * calls either insert() or update() depending on whether the record already exists in the database (determined by id)
	 *
	 * @return Model
	 */
	public function save()
	{
		if (is_null($this->id)) {
			$this->insert();
		} else {
			$this->update();
		}

		return $this;
	}

	/**
	 * implemented by child class
	 * 
	 * @abstract
	 */
	public abstract function insert();

	/**
	 * implemented by child class
	 * 
	 * @abstract
	 */
	public abstract function update();

	/**
	 * removes this instance of the Model from the database
	 * @return true|false 
	 *
	 * @throws Exception routes to errorController calling databaseErrorAction
	 */
	public function delete()
	{
		try {
			$query = $this->connection->prepare("DELETE FROM ".static::$table." WHERE id=:id LIMIT 1");
			$query->bindParam(':id', $this->id);

			return $query->execute();
		} catch (PDOException $e) {
			Logger::log($e->getMessage());
			Throw new \Exception('databaseError');
			return false;
		}

	}

}