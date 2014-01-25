<?php
namespace Simpleblog\Controller;
use Simpleblog\Classes\Logger;

class FrontController
{
	protected $request;
	protected $controller;
	protected $action;
	protected $parameters;

	public function __construct($request)
	{
		$this->request = $request;
		$this->parseRequest();
	}

	public function parseRequest()
	{
		$request = explode('/', trim($this->request, '/'));
		$request = preg_replace('/[^0-9a-zA-Z]/', '', $request);

		$controller = isset($request[0]) ? array_shift($request) : 'HomeController';
		$action = isset($request[0]) ? array_shift($request) : 'default';
		print_r($request);
		$parameters = isset($request[0]) ? array_shift($request) : $_POST;


	}
}