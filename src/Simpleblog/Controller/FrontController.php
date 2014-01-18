<?php
namespace Simpleblog\Controller;
use Simpleblog\Classes\Logger;

class FrontController
{
	protected $controller;
	protected $action;
	protected $parameters;

	public function __construct()
	{
		$this->parseRequest();
	}

	public function parseRequest()
	{
		$request = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
		$request = preg_replace('/[^0-9a-zA-Z]/', '', $request);

		$controller = isset($request[0]) ? ucwords(array_shift($request)) . 
			'Controller' : 'HomeController';
		$action = isset($request[0]) ? array_shift($request) : 'index';
		$parameters = isset($request[0]) ? array_shift($request) : null;

		if (isset($parameters)) echo 'yes';
	}
}