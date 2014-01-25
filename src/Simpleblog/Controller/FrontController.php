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

	
}