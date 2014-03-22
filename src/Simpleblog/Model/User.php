<?php
namespace Simpleblog\Model;
use Simpleblog\Classes\Logger;

class User extends Model
{
	protected static $table = 'users';
	public $username;
	public $password;
	public $salt;
	public $email;

	public function __construct(\PDO $connection, array $data)
	{
		parent::__construct($connection, $data);

		$this->salt = 

		$this->username = $data['username'];
		$this->password = password_hash($data['password'], PASSWORD_DEFAULT);
		$this->email = $data['email'];
	}

	public function insert()
	{
		try {
			$query = $this->connection->prepare("INSERT INTO ".self::$table."(username, password, email) VALUES (:username, :password, :email)");
			$query->bindParam(':username', $this->username);
			$query->bindParam(':password', $this->password);
			$query->bindParam(':email', $this->email);
			$query->execute();

			$this->id = $this->connection->lastInsertId();

			return true;
		} catch (\PDOException $e) {
			Logger::log($e->getMessage());
			return false;
		}
	}