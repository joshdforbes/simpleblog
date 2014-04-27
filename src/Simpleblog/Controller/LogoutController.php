<?php

namespace Simpleblog\Controller;
use Simpleblog\Classes\Auth as Auth;


class LogoutController extends BaseController
{
	/**
	 * calls BaseController constructor
	 * @param Request $request    
	 * @param PDO     $connection 
	 */
	public function __construct(Request $request, \PDO $connection)
	{
		parent::__construct($request, $connection);		
	}

	/**
	 * default action - logs the user out and redirects to root
	 * 
	 * @return void
	 */
	public function indexAction()
	{
		$auth = new Auth($this->connection);
		if ($auth->loggedIn()) {
			$_SESSION = array();
    		session_destroy();
		}
		$this->response->addHeader('Location: /');
		$this->response->send(); 
	}
}