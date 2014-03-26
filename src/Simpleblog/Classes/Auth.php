<?php
namespace Simpleblog\Classes;
use Simpleblog\Model\User as User;

class Auth
{
	private $username;
	private $connection;

	public function __construct(\PDO $connection) {
		if (!isset($_SESSION)) {
			session_start();
		}

		$this->connection = $connection;
		$this->username = isset($_SESSION['username']) 
			? $_SESSION['username']
			: null;
	}

	public function loggedIn()
	{
	    if (isset($this->username)) {
	    	return true;
	    } else {
	    	return false;
	    }
	}

	public function isAdmin()
	{
		$user = User::findByUsername($this->connection, $this->username);
		if ($user && $user->getPrivledge() === 'admin') {
			return true;
		} else {
			return false;
		}
	}

}