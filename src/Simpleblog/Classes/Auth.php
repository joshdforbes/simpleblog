<?php
namespace Simpleblog\Classes;

class Auth
{
	public function __construct() {}

	public static function hashPassword($password)
	{
		return password_hash($password, PASSWORD_BCRYPT);
	}

	public function login($username, $password)
	{

	}

	public function checkLogin($password, $hashedPassword)
	{
	    if (password_verify($password, $hashPassword)) {
        	/* Valid */
    	} else {
        	/* Invalid */
    	}
	}

}