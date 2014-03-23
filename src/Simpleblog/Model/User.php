<?php
namespace Simpleblog\Model;
use Simpleblog\Classes\Logger;

class User extends Model
{
	protected static $table = 'users';
	public $username;
	public $hashedPassword;
	public $salt;
	public $email;

	public function __construct(\PDO $connection, array $data)
	{
		parent::__construct($connection, $data);

		$this->username = $data['username'];
		$this->hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
		$this->email = $data['email'];
	}

	public function insert()
	{
		try {
			$query = $this->connection->prepare("INSERT INTO ".self::$table."(username, hashedPassword, email) VALUES (:username, :hashedPassword, :email)");
			$query->bindParam(':username', $this->username);
			$query->bindParam(':hashedPassword', $this->password);
			$query->bindParam(':email', $this->email);
			$query->execute();

			$this->id = $this->connection->lastInsertId();

			return true;
		} catch (\PDOException $e) {
			Logger::log($e->getMessage());
			Throw new \Exception('databaseError');
			return false;
		}
	}

	public static function findByUsername(\PDO $connection, $username)
	{
		try {
			$query = $connection->prepare("SELECT * from ".static::$table." WHERE username = :username LIMIT 1");
			$query->bindParam(':username', $username);
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

	public function isUniqueUsername($username)
	{
		try {
			$query = $connection->prepare("SELECT * from ".static::$table." WHERE username = :username LIMIT 1");
			$query->bindParam(':username', $username);
			$query->execute();

			return ($query->rowCount() === 1)
				? true;
				: false;
		} catch (\PDOException $e) {
			Logger::log($e->getMessage());
			Throw new \Exception('databaseError');
			return false;
		}

	}