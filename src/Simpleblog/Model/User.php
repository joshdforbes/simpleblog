<?php
namespace Simpleblog\Model;
use Simpleblog\Classes\Logger;

class User extends Model
{
	protected static $table = 'users';
	public $username;
	private $hashedPassword;
	public $email;
	public $privledge;

	public function __construct(\PDO $connection, array $data)
	{
		parent::__construct($connection, $data);

		$this->username = (string) $data['username'];
		$this->hashedPassword = isset($data['password']) 
			? password_hash((string) $data['password'], PASSWORD_BCRYPT)
			: (string) $data['hashedPassword'];
		$this->email = (string) $data['email'];
		$this->privledge = (string) $data['privledge'];
	}

	public function insert()
	{
		try {
			$query = $this->connection->prepare("INSERT INTO ".self::$table."(username, hashedPassword, email, privledge) VALUES (:username, :hashedPassword, :email, :privledge)");
			$query->bindParam(':username', $this->username);
			$query->bindParam(':hashedPassword', $this->hashedPassword);
			$query->bindParam(':email', $this->email);
			$query->bindParam(':privledge', $this->privledge);
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
			$query = $connection->prepare("SELECT * from ".self::$table." WHERE username = :username LIMIT 1");
			$query->bindParam(':username', $username);
			$query->execute();

			return ($query->rowCount() === 1)
				? new self($connection, $query->fetch(\PDO::FETCH_ASSOC))
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
				? true
				: false;
		} catch (\PDOException $e) {
			Logger::log($e->getMessage());
			Throw new \Exception('databaseError');
			return false;
		}
	}

	public function update()
	{
		try {
			$query = $this->connection->prepare("UPDATE ".self::$table." SET hashedPassword=:hashedPassword, email=:email, privledge=:privledge WHERE id=:id");
			$query->bindParam(':hashedPassword', $this->hashedPassword);
			$query->bindParam(':email', $this->email);
			$query->bindParam(':privledge', $this->privledge);
			$query->bindParam(':id', $this->id);

			return $query->execute();
		} catch (\PDOException $e) {
			Logger::log($e->getMessage());
			Throw new \Exception('databaseError');
			return false;
		}
	}

	public function getHashedPassword()
	{
		return $this->hashedPassword;
	}

	public function getPrivledge()
	{
		return $this->privledge;
	}

}