<?php
namespace Simpleblog\Model;
use Simpleblog\Classes\Logger;

class User extends Model
{
	/**
	 * name of database table used by User
	 * 
	 * @var string
	 */
	protected static $table = 'users';

	/**
	 * @var string
	 */
	public $username;

	/**
	 * hashed using php 5.5 password_hash function
	 * 
	 * @var string
	 */
	private $hashedPassword;

	/**
	 * @var string
	 */
	public $email;

	/**
	 * privledge level, admin or user
	 * 
	 * @var string
	 */
	public $privledge;

	/**
	 * create a User instance from supplied data
	 * if the data contains a $password then hash it and store
	 * as $hashedPassword
	 * 
	 * @param PDO   $connection
	 * @param array $data info required for User instance
	 */
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

	/**
	 * insert a new User into the database
	 * 
	 * @return true|false indicates whether User was successfully inserted
	 *
	 * @throws Exception if User fails to insert - routes to errorController
	 */
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

	/**
	 * allows Users to be searched by username instead of id
	 * 
	 * @param  PDO    $connection
	 * @param  string $username
	 * @return User|false 	new User instance or false
	 */
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

	/**
	 * updates info for an User that already exsists in the database
	 * 
	 * @return PDOStatement|false indicates whether User was successfully updated
	 *
	 * @throws Exception if User fails to update - routes to errorController
	 */
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

	/**
	 * getter for $hashedPassword
	 * 
	 * @return string 
	 */
	public function getHashedPassword()
	{
		return $this->hashedPassword;
	}

	/**
	 * getter for $privledge
	 * 
	 * @return string indicates a users privledge level (admin or user)
	 */
	public function getPrivledge()
	{
		return $this->privledge;
	}

}