<?php
namespace Simpleblog\Controller;

class Router 
{
	private $request;

	public function __construct(Request $request)
	{
		$this->request = $request->getUri();
		$this->parseRequest();
	}

	public function parseRequest()
	{
		$request = explode('/', trim($this->request, '/'));
		$request = preg_replace('/[^0-9a-zA-Z]/', '', $request);

		$controller = isset($request[0]) ? array_shift($request) : 'HomeController';
		$action = isset($request[0]) ? array_shift($request) : 'default';
		$parameters = isset($request[0]) ? $request : array();
	}
}